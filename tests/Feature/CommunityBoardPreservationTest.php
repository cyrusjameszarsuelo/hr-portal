<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\View;
use Tests\TestCase;

/**
 * Preservation tests for the Community Board Delete/Edit authorization bugfix.
 *
 * Bugfix spec: .kiro/specs/community-board-delete-authorization
 *
 * Property 2: Preservation - Board Rendering and Non-Bug Visibility
 *   For any logged-in user where the bug condition does NOT hold, the fixed view SHALL
 *   produce the same rendered output as the original view, preserving all board item
 *   rendering, the empty-state message, the View/Link buttons, all modals, the
 *   delete/edit action flows, and the Delete/Edit visibility decision for users whose
 *   authorization already agreed with the old gate.
 *
 *   Validates: Requirements 3.1, 3.2, 3.3, 3.4, 3.5
 *
 * ---------------------------------------------------------------------------------------
 * OBSERVATION-FIRST METHODOLOGY (why these particular assertions)
 * ---------------------------------------------------------------------------------------
 * These tests are written to establish the BASELINE on the UNFIXED view and are expected
 * to PASS on unfixed code. They therefore assert only invariants that are genuinely TRUE
 * on the unfixed view:
 *
 *   1. Board content rendering (item title/content, View button, Link button) is driven
 *      purely by the item data ($community), never by the authorization decision, so it
 *      is identical regardless of $commName / $user. -> Preserved.
 *   2. The "No Data Found." empty-state renders exactly when $community is empty. -> Preserved.
 *   3. The modals (#addToBoardModal, #deleteCommModal, #getCommunityData) and the
 *      "Add to Board" button are always emitted. -> Preserved.
 *   4. The "authorized AND posted" agreeing case (jbarte@megawide.com.ph with $commName
 *      set) shows Delete/Edit on BOTH the unfixed gate (isset($commName)) and the fixed
 *      gate (email in allowlist), so its visibility is preserved across the fix.
 *   5. Null-safety: varied casing/whitespace emails and users with/without a 'mail' key
 *      render without a PHP error. On the unfixed view this is trivially true (the view
 *      never reads $user['mail']); the fixed view must also stay error-free.
 *
 * DELIBERATELY NOT WRITTEN AS BASELINE TESTS:
 *   The design's "generate random emails and random allowlists; assert visibility equals
 *   normalized(email) in normalized(allowlist)" property is an ALLOWLIST-based visibility
 *   property. On the UNFIXED view, visibility follows isset($commName), NOT the allowlist,
 *   so that property FAILS on unfixed code. Writing it here as a passing baseline test
 *   would contradict observation-first methodology (we would be asserting behavior the
 *   unfixed view does not have). That allowlist-visibility property is the fix-checking
 *   property already encoded by CommunityBoardDeleteAuthorizationTest (Task 1), which is
 *   expected to FAIL now and PASS after the fix. To keep the preservation suite honest,
 *   what we assert generatively here instead is the AUTHORIZATION-INDEPENDENCE of board
 *   content: for randomly generated board collections and randomly generated
 *   users/allowlists, the item/View/Link rendering and the empty-state message are
 *   byte-stable regardless of the authorization inputs. That invariant is true on the
 *   unfixed view and must remain true after the fix.
 */
class CommunityBoardPreservationTest extends TestCase
{
    /**
     * The allowlist the fix will place in config/community.php. Seeded at runtime so the
     * suite is self-contained (config/community.php is created in a later task) and so the
     * generated-input tests can vary it freely.
     */
    private const ALLOWLIST = [
        'cjzarsuelo@megawide.com.ph',
        'jbarte@megawide.com.ph',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config(['community.delete_authorized_emails' => self::ALLOWLIST]);
    }

    // -----------------------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------------------

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
     * Does the rendered HTML expose the Delete/Edit controls?
     * The Delete anchor calls deleteCommBoard(...) and the Edit anchor carries the
     * communityBtnEdit class; both live inside the same @if gate.
     */
    private function showsDeleteEdit(string $html): bool
    {
        return str_contains($html, 'deleteCommBoard(') && str_contains($html, 'communityBtnEdit');
    }

    /**
     * Build a board collection of content-card items (image === null) from the given rows.
     */
    private function board(array $rows)
    {
        // Uses the same CommunityBoardItemStub render contract as Task 1 (stringifies to
        // JSON for the view's data-id="{{$communityData}}"). Declared at file scope below
        // so this suite runs self-contained under --filter=CommunityBoardPreservation.
        return collect(array_map(
            fn (array $attrs) => new CommunityBoardPreservationItemStub($attrs),
            $rows
        ));
    }

    // -----------------------------------------------------------------------------------
    // Observed baseline (concrete) assertions
    // -----------------------------------------------------------------------------------

    /**
     * Requirement 3.1: board items render with title, content, View button, and Link
     * button (when a link exists).
     */
    public function test_image_item_renders_title_content_view_and_link(): void
    {
        // OBSERVED: the View button (communityBtnView) lives ONLY in the image/video
        // branch (@if $communityData->image != null). So to observe View + Link + title
        // + content together, the item must carry an image.
        $board = $this->board([
            [
                'id' => 1,
                'title' => 'Team Outing',
                'content' => 'Photos from the annual outing.',
                'image' => 'https://example.com/photo.jpg',
                'link' => 'https://example.com/outing',
            ],
        ]);

        // A non-authorized, non-posting user: irrelevant to content rendering.
        $html = $this->renderBoard($board, null, ['mail' => 'nobody@megawide.com.ph']);

        $this->assertStringContainsString('Team Outing', $html, 'Item title must render.');
        $this->assertStringContainsString('Photos from the annual outing.', $html, 'Item content must render.');
        $this->assertStringContainsString('communityBtnView', $html, 'View button must render in the image branch.');
        $this->assertStringContainsString('https://example.com/outing', $html, 'Link button must render when a link exists.');
    }

    /**
     * Requirement 3.1: a content-card item (no image) renders its title and content and,
     * when a link exists, the Link button. OBSERVED: the content-card branch has no View
     * button (that control is image-branch only).
     */
    public function test_content_card_item_renders_title_content_and_link(): void
    {
        $board = $this->board([
            [
                'id' => 2,
                'title' => 'Content Card Title',
                'content' => 'Content card body text.',
                'image' => null,
                'link' => 'https://example.com/card',
            ],
        ]);

        $html = $this->renderBoard($board, null, ['mail' => 'nobody@megawide.com.ph']);

        $this->assertStringContainsString('Content Card Title', $html, 'Content-card title must render.');
        $this->assertStringContainsString('Content card body text.', $html, 'Content-card body must render.');
        $this->assertStringContainsString('https://example.com/card', $html, 'Content-card Link button must render when a link exists.');
    }

    /**
     * Requirement 3.1: when a content-card item has no link, the Link button is omitted
     * but the item still renders.
     */
    public function test_content_card_item_without_link_omits_link_button(): void
    {
        $board = $this->board([
            [
                'id' => 3,
                'title' => 'No Link Item',
                'content' => 'This item has no link.',
                'image' => null,
                'link' => null,
            ],
        ]);

        $html = $this->renderBoard($board, null, ['mail' => 'nobody@megawide.com.ph']);

        $this->assertStringContainsString('No Link Item', $html);
        $this->assertStringContainsString('This item has no link.', $html);
        // The content-card Link anchor is `class="btn btn-dark btn-sm">Link</a>`. With no
        // link, that anchor must not render.
        $this->assertStringNotContainsString('btn btn-dark btn-sm">Link</a>', $html, 'Link button must be absent when no link exists.');
    }

    /**
     * Requirement 3.2: the empty-state "No Data Found." message renders when $community
     * is empty.
     */
    public function test_empty_state_message_renders_when_board_is_empty(): void
    {
        $html = $this->renderBoard(collect([]), null, ['mail' => 'nobody@megawide.com.ph']);

        $this->assertStringContainsString('No Data Found.', $html, 'Empty-state message must render for an empty board.');
    }

    /**
     * Requirement 3.2: the empty-state message is absent when the board has items.
     */
    public function test_empty_state_message_absent_when_board_has_items(): void
    {
        $board = $this->board([
            ['id' => 3, 'title' => 'Has Item', 'content' => 'body', 'image' => null, 'link' => null],
        ]);

        $html = $this->renderBoard($board, null, ['mail' => 'nobody@megawide.com.ph']);

        $this->assertStringNotContainsString('No Data Found.', $html);
    }

    /**
     * Requirements 3.3, 3.4: the modals and the "Add to Board" button always render.
     */
    public function test_modals_and_add_button_always_render(): void
    {
        $board = $this->board([
            ['id' => 4, 'title' => 'Item', 'content' => 'body', 'image' => null, 'link' => null],
        ]);

        // Render for several kinds of user; the modals/button are structural and constant.
        foreach ([null, (object) ['user_name' => 'X']] as $commName) {
            $html = $this->renderBoard($board, $commName, ['mail' => 'anyone@megawide.com.ph']);

            $this->assertStringContainsString('id="addToBoardModal"', $html, 'Add/edit modal must render.');
            $this->assertStringContainsString('id="deleteCommModal"', $html, 'Delete confirmation modal must render.');
            $this->assertStringContainsString('id="getCommunityData"', $html, 'View-data modal must render.');
            $this->assertStringContainsString('id="addToBoard"', $html, '"Add to Board" button must render.');
        }
    }

    /**
     * Requirements 3.3, 3.4, 3.5: the "authorized AND posted" agreeing case
     * (jbarte@megawide.com.ph with $commName set) shows Delete/Edit. Both the unfixed gate
     * (isset($commName)) and the fixed gate (email in allowlist) agree here, so its
     * visibility is preserved across the fix.
     */
    public function test_authorized_and_posted_agreeing_case_shows_controls(): void
    {
        $board = $this->board([
            ['id' => 5, 'title' => 'Item', 'content' => 'body', 'image' => null, 'link' => null],
        ]);

        $user = ['mail' => 'jbarte@megawide.com.ph', 'displayName' => 'J Barte'];
        $commName = (object) ['user_name' => 'J Barte']; // isset($commName) === true

        $html = $this->renderBoard($board, $commName, $user);

        $this->assertTrue(
            $this->showsDeleteEdit($html),
            'The authorized-and-posted agreeing case must show Delete/Edit (preserved across the fix).'
        );
    }

    // -----------------------------------------------------------------------------------
    // Generative (property-based) assertions
    // -----------------------------------------------------------------------------------

    /**
     * Property (preservation): board content rendering is INDEPENDENT of the authorization
     * inputs. For randomly generated board collections and randomly generated
     * users/allowlists, every item's title, content, and View button render, and the
     * empty-state message appears exactly when the board is empty -- regardless of the
     * authorization decision.
     *
     * This invariant holds on the unfixed view and must remain true after the fix.
     *
     * Validates: Requirements 3.1, 3.2
     */
    public function test_property_board_content_rendering_is_authorization_independent(): void
    {
        $faker = \Faker\Factory::create();

        for ($iteration = 0; $iteration < 100; $iteration++) {
            // Randomly generate a board collection (possibly empty), mixing image-branch
            // items and content-card items.
            $count = $faker->numberBetween(0, 5);
            $rows = [];
            $imageItemCount = 0;
            for ($i = 0; $i < $count; $i++) {
                $hasImage = $faker->boolean();
                if ($hasImage) {
                    $imageItemCount++;
                }
                $rows[] = [
                    'id' => $faker->unique()->numberBetween(1, 1000000),
                    'title' => $faker->sentence(3),
                    'content' => $faker->sentence(6),
                    'image' => $hasImage ? $faker->imageUrl() : null,
                    'link' => $faker->boolean() ? $faker->url() : null,
                ];
            }
            $board = $this->board($rows);

            // Randomly generate authorization inputs (irrelevant to content rendering).
            $randomAllowlist = $faker->randomElements(
                [self::ALLOWLIST[0], self::ALLOWLIST[1], $faker->safeEmail()],
                $faker->numberBetween(0, 3)
            );
            config(['community.delete_authorized_emails' => $randomAllowlist]);

            $user = ['mail' => $faker->safeEmail()];
            $commName = $faker->boolean() ? (object) ['user_name' => $faker->name()] : null;

            $html = $this->renderBoard($board, $commName, $user);

            if ($count === 0) {
                $this->assertStringContainsString(
                    'No Data Found.',
                    $html,
                    'Empty board must render the empty-state regardless of authorization inputs.'
                );
                continue;
            }

            $this->assertStringNotContainsString('No Data Found.', $html);

            foreach ($rows as $row) {
                // The content-card branch echoes title/content verbatim (no truncation),
                // so assert those there. The image branch applies str_limit() truncation,
                // so we don't assert full title/content for image items.
                if ($row['image'] === null) {
                    $this->assertStringContainsString(
                        e($row['title']),
                        $html,
                        'Every content-card title must render regardless of authorization inputs.'
                    );
                    $this->assertStringContainsString(
                        e($row['content']),
                        $html,
                        'Every content-card content must render regardless of authorization inputs.'
                    );
                }

                // The Link URL is echoed verbatim in both branches when present.
                if ($row['link'] !== null) {
                    $this->assertStringContainsString(
                        $row['link'],
                        $html,
                        'A Link button must render when the item has a link, regardless of authorization inputs.'
                    );
                }
            }

            // The View button lives in the image branch only: one per image item.
            $this->assertSame(
                $imageItemCount,
                substr_count($html, 'communityBtnView'),
                'One View button must render per image-branch item, independent of authorization.'
            );
            $this->assertStringContainsString('id="addToBoardModal"', $html);
            $this->assertStringContainsString('id="deleteCommModal"', $html);
            $this->assertStringContainsString('id="getCommunityData"', $html);
        }

        // Restore the canonical allowlist for any following assertions.
        config(['community.delete_authorized_emails' => self::ALLOWLIST]);
    }

    /**
     * Property (null-safety / no-error preservation): rendering the board for users with
     * varied casing/whitespace emails, and for users with or without a 'mail' key, raises
     * no PHP error. On the unfixed view this is trivially true (the view never reads
     * $user['mail']); the fixed view must remain error-free too.
     *
     * Validates: Requirements 3.1, 3.5
     */
    public function test_property_rendering_never_errors_for_varied_or_missing_mail(): void
    {
        $faker = \Faker\Factory::create();

        $board = $this->board([
            ['id' => 1, 'title' => 'Item', 'content' => 'body', 'image' => null, 'link' => null],
        ]);

        for ($iteration = 0; $iteration < 100; $iteration++) {
            // Build a user that sometimes has no 'mail' key, sometimes null, sometimes a
            // messy-cased/whitespaced email.
            $mode = $faker->numberBetween(0, 3);
            switch ($mode) {
                case 0:
                    $user = ['displayName' => $faker->name()]; // no 'mail' key
                    break;
                case 1:
                    $user = ['mail' => null, 'displayName' => $faker->name()]; // null mail
                    break;
                case 2:
                    $email = $faker->safeEmail();
                    $user = ['mail' => '  ' . strtoupper($email) . '  ']; // whitespace + upper
                    break;
                default:
                    $user = ['mail' => $faker->safeEmail()];
                    break;
            }

            $commName = $faker->boolean() ? (object) ['user_name' => $faker->name()] : null;

            // The assertion is simply that rendering completes and returns a non-empty
            // string; any PHP notice/error would surface as a thrown exception / failed test.
            $html = $this->renderBoard($board, $commName, $user);

            $this->assertNotEmpty($html, 'Rendering must succeed and produce output for any user shape.');
            $this->assertStringContainsString('id="community_board_page"', $html, 'The board container must always render.');
        }
    }
}

/**
 * Minimal stand-in for a Community_Board row. Exposes properties via magic access and
 * stringifies to JSON so the view's data-id="{{$communityData}}" attribute renders like
 * a real Eloquent model does (models cast to their JSON representation when echoed).
 *
 * Named distinctly from the Task 1 stub so this suite is self-contained and cannot clash
 * on class redeclaration when both files are autoloaded together.
 */
class CommunityBoardPreservationItemStub
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

