<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\View;
use Tests\TestCase;

/**
 * Bug condition exploration test for the Community Board Delete/Edit authorization defect.
 *
 * Bugfix spec: .kiro/specs/community-board-delete-authorization
 *
 * Property 1: Bug Condition - Delete/Edit Gated by Config Allowlist
 *   For the logged-in user, the (fixed) view SHALL show Delete/Edit if and only if the
 *   normalized $user['mail'] is present in config('community.delete_authorized_emails')
 *   (trim + lowercase compare); an absent/null 'mail' key is treated as NOT authorized
 *   and must raise no PHP notice/error.
 *
 * This test encodes the EXPECTED (fixed) behavior. It is EXPECTED TO FAIL on the current
 * unfixed view, where visibility is gated by isset($commName) (posting history) rather
 * than the email allowlist.
 *
 * Validates: Requirements 2.1, 2.2, 2.3, 2.5
 */
class CommunityBoardDeleteAuthorizationTest extends TestCase
{
    /**
     * The allowlist the fix will place in config/community.php. We set it here at runtime
     * so the test is self-contained and does not depend on that config file existing yet
     * (config/community.php is created in a later task). This also lets the test encode
     * the target isAuthorized() decision from the design.
     */
    private const ALLOWLIST = [
        'cjzarsuelo@megawide.com.ph',
        'jbarte@megawide.com.ph',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the allowlist the fixed view will read from.
        config(['community.delete_authorized_emails' => self::ALLOWLIST]);
    }

    /**
     * The target authorization decision from the design:
     *   isAuthorized(user) = normalized user['mail'] IN normalized allowlist
     *   absent/null 'mail' => false
     */
    private function isAuthorized(array $user): bool
    {
        if (! array_key_exists('mail', $user) || $user['mail'] === null) {
            return false;
        }

        $normalized = array_map(
            fn ($email) => strtolower(trim($email)),
            self::ALLOWLIST
        );

        return in_array(strtolower(trim($user['mail'])), $normalized, true);
    }

    /**
     * Render the community board partial with the given view data and return the HTML.
     */
    private function renderBoard($community, $commName, array $user): string
    {
        return View::make('pages.community_board_page', [
            'community' => $community,
            'commName' => $commName,
            'user' => $user,
        ])->render();
    }

    /**
     * A single content-card board item (no image) so it renders through the content branch.
     *
     * The view emits data-id="{{$communityData}}", so the item must stringify to JSON the
     * same way an Eloquent Community_Board model does in production.
     */
    private function boardWithOneItem()
    {
        return collect([
            new CommunityBoardItemStub([
                'id' => 1,
                'title' => 'Sample Title',
                'content' => 'Sample content body',
                'image' => null,
                'link' => null,
            ]),
        ]);
    }

    /**
     * Detect whether the rendered HTML exposes the Delete/Edit controls.
     * The Delete anchor calls deleteCommBoard(...) and the Edit anchor carries the
     * communityBtnEdit class; both live inside the same @if gate.
     */
    private function showsDeleteEdit(string $html): bool
    {
        return str_contains($html, 'deleteCommBoard(') && str_contains($html, 'communityBtnEdit');
    }

    /**
     * Case: Poster, NOT authorized. $commName set, email not in allowlist.
     * Expected (fixed): NO Delete/Edit. Unfixed: shows them (bug).
     */
    public function test_poster_not_authorized_hides_delete_edit(): void
    {
        $user = ['mail' => 'randomemployee@megawide.com.ph', 'displayName' => 'Random Employee'];
        $commName = (object) ['user_name' => 'Random Employee']; // isset($commName) === true

        $html = $this->renderBoard($this->boardWithOneItem(), $commName, $user);

        $this->assertSame(
            $this->isAuthorized($user),
            $this->showsDeleteEdit($html),
            'A poster whose email is NOT in the allowlist must not see Delete/Edit.'
        );
    }

    /**
     * Case: Authorized, never posted. cjzarsuelo@megawide.com.ph, $commName null.
     * Expected (fixed): Delete/Edit shown. Unfixed: hidden (bug).
     */
    public function test_authorized_never_posted_shows_delete_edit(): void
    {
        $user = ['mail' => 'cjzarsuelo@megawide.com.ph', 'displayName' => 'CJ Zarsuelo'];
        $commName = null; // never posted

        $html = $this->renderBoard($this->boardWithOneItem(), $commName, $user);

        $this->assertSame(
            $this->isAuthorized($user),
            $this->showsDeleteEdit($html),
            'An authorized user who never posted must still see Delete/Edit.'
        );
    }

    /**
     * Case: Authorized and posted. jbarte@megawide.com.ph, $commName set.
     * Old and new gate agree -> Delete/Edit shown. Control case.
     */
    public function test_authorized_and_posted_shows_delete_edit(): void
    {
        $user = ['mail' => 'jbarte@megawide.com.ph', 'displayName' => 'J Barte'];
        $commName = (object) ['user_name' => 'J Barte'];

        $html = $this->renderBoard($this->boardWithOneItem(), $commName, $user);

        $this->assertSame(
            $this->isAuthorized($user),
            $this->showsDeleteEdit($html),
            'An authorized user who has posted must see Delete/Edit.'
        );
    }

    /**
     * Edge case: $user has no 'mail' key. Expected (fixed): NO Delete/Edit and no error.
     * Unfixed: decides on $commName only (here set) -> shows them (bug), and the fixed
     * check must be null-safe.
     */
    public function test_missing_mail_key_hides_delete_edit_without_error(): void
    {
        $user = ['displayName' => 'No Mail User']; // no 'mail' key
        $commName = (object) ['user_name' => 'No Mail User']; // isset($commName) === true

        $html = $this->renderBoard($this->boardWithOneItem(), $commName, $user);

        $this->assertFalse(
            $this->isAuthorized($user),
            'A user with no mail key must be treated as not authorized.'
        );
        $this->assertSame(
            $this->isAuthorized($user),
            $this->showsDeleteEdit($html),
            'A user with no mail key must not see Delete/Edit and must not raise a PHP error.'
        );
    }
}

/**
 * Minimal stand-in for a Community_Board row. Exposes properties via magic access and
 * stringifies to JSON so the view's data-id="{{$communityData}}" attribute renders like
 * a real Eloquent model does (models cast to their JSON representation when echoed).
 */
class CommunityBoardItemStub
{
    private array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    public function __toString(): string
    {
        return json_encode($this->attributes);
    }
}
