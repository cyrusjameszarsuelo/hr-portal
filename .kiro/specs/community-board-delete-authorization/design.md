# Community Board Delete Authorization Bugfix Design

## Overview

The Community Board partial (`resources/views/pages/community_board_page.blade.php`,
included by `pages.human_resources`) currently gates its **Delete** and **Edit** controls
with `@if(isset($commName))`. `$commName` is set in `HumanResourceController::index()` to
the first `Community_Board` row whose `user_name` matches the logged-in user's Microsoft
365 **display name**. This is an authorization defect: visibility is driven by "has this
person ever posted to the board" rather than "is this person authorized to delete." As a
result, anyone who has posted once sees Delete/Edit on **every** item, and an authorized
person who has never posted sees no controls at all.

The fix replaces both `isset($commName)` gates with a single config-driven authorization
check against an email allowlist. The allowlist lives in a new Laravel config file
(`config/community.php`) so it can be maintained without editing Blade or controller code.
The logged-in email is read from the Microsoft Graph user object already passed into the
view as `$user['mail']`. A single boolean, `$canDeleteCommBoard`, is computed once at the
top of the partial and reused in both control blocks.

The change is deliberately narrow: only the two Delete/Edit gates change. All other
rendering — the items list, empty-state message, View button, Link button, and every
modal and action flow — is preserved byte-for-byte.

## Glossary

- **Bug_Condition (C)**: The condition that triggers the bug — the logged-in user's
  posted-status (`isset($commName)`) disagrees with their true authorization status
  (email present in the allowlist), so Delete/Edit is shown or hidden incorrectly.
- **Property (P)**: The desired behavior — Delete/Edit is shown if and only if the
  logged-in user's email is in the configured allowlist.
- **Preservation**: All non-authorization rendering (items, empty-state, View/Link
  buttons, modals, delete/edit action flows) and the visibility decision for users whose
  authorization already agreed with the old gate must remain unchanged.
- **`$user`**: The Microsoft 365 user object from `MsGraph::get('me')`, passed to the view
  via `->withUser($user)` in `HumanResourceController::index()`. `$user['mail']` holds the
  user's email; the key may be absent or the value null.
- **`$commName`**: Legacy value — the first `Community_Board` row matching the user's
  display name. Currently the sole gate for Delete/Edit; it is no longer used for
  authorization after this fix. It remains passed from the controller and untouched.
- **`$community`**: The full collection of `Community_Board` rows rendered on the board.
- **`$canDeleteCommBoard`**: New Blade-local boolean computed once from the config
  allowlist and `$user['mail']`; controls Delete/Edit visibility in both branches.
- **allowlist**: `config('community.delete_authorized_emails')` — an array of authorized
  email addresses defined in `config/community.php`.

## Bug Details

### Bug Condition

The bug manifests when the logged-in user's board posting history (the current
`isset($commName)` gate) does not match whether they are actually authorized to delete
(email in the allowlist). The gate either shows Delete/Edit to an unauthorized poster or
hides Delete/Edit from an authorized non-poster.

**Formal Specification:**
```
FUNCTION isBugCondition(user)
  INPUT: user of type MsGraphUser   // the logged-in Microsoft 365 user
  OUTPUT: boolean

  // hasPosted(user): true when a Community_Board row exists with
  //                  user_name = user.displayName  (i.e. isset($commName) is true)
  // isAuthorized(user): true when normalize(user.mail) is in the
  //                     normalized config allowlist

  RETURN hasPosted(user) <> isAuthorized(user)
END FUNCTION
```

Where `isAuthorized(user)` is the target behavior of the fixed view:
```
FUNCTION isAuthorized(user)
  INPUT: user of type MsGraphUser
  OUTPUT: boolean

  IF user has no 'mail' key OR user['mail'] is null THEN
    RETURN false
  END IF

  RETURN normalize(user['mail']) IN normalize(config('community.delete_authorized_emails'))
  // normalize = trim + lowercase for case-insensitive comparison
END FUNCTION
```

### Examples

- **Poster, not authorized (buttons wrongly shown):** A regular employee posted one item.
  `$commName` is set, so today they see Delete/Edit on **all** items. Their email is not in
  the allowlist. Expected: no Delete/Edit. Actual (bug): Delete/Edit shown everywhere.
- **Authorized, never posted (buttons wrongly hidden):** `cjzarsuelo@megawide.com.ph` has
  never posted, so `$commName` is null and they see no Delete/Edit. Expected: Delete/Edit
  shown. Actual (bug): Delete/Edit hidden.
- **Authorized and posted (agrees — no bug):** `jbarte@megawide.com.ph` posted before;
  `$commName` set and email in allowlist. Old and new gate both show controls. Unchanged.
- **Edge case — user object missing `mail`:** `$user` has no `'mail'` key. Expected:
  no Delete/Edit and no PHP error/notice. The check must be null-safe.

## Expected Behavior

### Preservation Requirements

**Unchanged Behaviors:**
- All community board items (images, videos, and content cards) continue to render with
  their title, content, View button, and Link button (when a link exists) exactly as before.
- The empty-state "No Data Found." message continues to display when `$community` is empty.
- The delete confirmation modal (`#deleteCommModal`) and the `deleteCommBoard(id)` /
  destroy flow continue to work when an authorized user clicks Delete.
- The add/edit modal (`#addToBoardModal`), the "Add to Board" button, and the store/update
  flow continue to work when an authorized user clicks Edit or Add to Board.
- Delete/Edit visibility for users whose authorization status already agreed with the old
  `isset($commName)` gate is unchanged.
- Every other admin-gated screen that reads `$user['mail']` (announcements, job vacancies,
  new hires, surveys, etc.) is completely unaffected.

**Scope:**
All inputs that do NOT involve the community-board Delete/Edit authorization gate should be
completely unaffected by this fix. This includes:
- Any board content rendering (images, videos, content cards, titles, View/Link buttons).
- The empty-state message and all modals.
- Any other page or partial in the application.

**Note:** The actual expected correct visibility behavior is defined in the Correctness
Properties section (Property 1). This section focuses on what must NOT change.

## Hypothesized Root Cause

Based on the bug analysis, the cause is well-understood (this is a logic/authorization
defect rather than an elusive runtime bug):

1. **Wrong authorization signal**: The gate uses `isset($commName)` — a proxy for "has
   posted before" — instead of an authorization decision. `$commName` is computed from the
   user's **display name** (`user_name`), which cannot be centrally controlled.

2. **No config-driven allowlist**: There is no `config/community.php`; the authorized set
   cannot be edited without touching Blade/controller code.

3. **Duplicated gate**: The same `isset($commName)` check appears in two places (the
   image/video branch and the content branch), so any correct behavior must be applied
   consistently in both.

4. **Missing null-safety consideration**: A correct email-based check must tolerate a
   `$user` object without a `'mail'` key (or a null value) without raising a PHP notice.

## Correctness Properties

Property 1: Bug Condition - Delete/Edit Gated by Config Allowlist

_For any_ logged-in user where the bug condition holds (isBugCondition returns true), the
fixed view SHALL show the Delete and Edit controls if and only if the user's email
(`$user['mail']`) is present in the configured allowlist
(`config('community.delete_authorized_emails')`), using a normalized (trimmed,
case-insensitive) comparison, and SHALL raise no error when `$user['mail']` is absent or
null (treating that case as not authorized).

**Validates: Requirements 2.1, 2.2, 2.3, 2.5**

Property 2: Preservation - Board Rendering and Non-Bug Visibility

_For any_ logged-in user where the bug condition does NOT hold (isBugCondition returns
false), the fixed view SHALL produce the same rendered output as the original view,
preserving all board item rendering, the empty-state message, the View/Link buttons, all
modals, the delete/edit action flows, and the Delete/Edit visibility decision itself.

**Validates: Requirements 3.1, 3.2, 3.3, 3.4, 3.5**

## Fix Implementation

### Changes Required

Assuming our root cause analysis is correct, two files change: a new config file and the
Blade partial. No controller change is required because `$user` is already passed to the
view and inherited by the `@include`d partial.

**File 1 (new)**: `config/community.php`

Create a config file returning an array with a `delete_authorized_emails` key, seeded with
the two initial addresses. This is the single place future maintainers edit.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Community Board — Authorized Delete/Edit Emails
    |--------------------------------------------------------------------------
    |
    | Microsoft 365 email addresses allowed to see and use the Delete/Edit
    | controls on the Community Board. Add or remove entries here only; no
    | Blade or controller changes are required.
    |
    */

    'delete_authorized_emails' => [
        'cjzarsuelo@megawide.com.ph',
        'jbarte@megawide.com.ph',
    ],

];
```

**File 2**: `resources/views/pages/community_board_page.blade.php`

**Change 1 — Compute the authorization boolean once (top of partial):**
Add a Blade `@php` block near the top of the partial (before the item loop) that computes
`$canDeleteCommBoard` null-safely with a normalized comparison:

```blade
@php
    $authorizedEmails = array_map(
        fn ($email) => strtolower(trim($email)),
        config('community.delete_authorized_emails', [])
    );
    $currentEmail = strtolower(trim($user['mail'] ?? ''));
    $canDeleteCommBoard = $currentEmail !== '' && in_array($currentEmail, $authorizedEmails, true);
@endphp
```

Notes:
- `$user['mail'] ?? ''` provides null-safety when the `mail` key is missing or null.
- `array_map` + `strtolower(trim())` on both sides gives a case-insensitive, whitespace-
  tolerant comparison; `in_array(..., true)` is a strict compare on already-normalized
  strings.
- `config('community.delete_authorized_emails', [])` defaults to an empty array if the
  config is somehow missing, so the expression never errors.

**Change 2 — Replace the image/video branch gate:**
Replace `@if(isset($commName))` (the block wrapping the Delete/Edit anchors in the
image/video branch) with `@if($canDeleteCommBoard)`. The Delete and Edit anchor markup
inside is preserved verbatim; only the condition changes.

**Change 3 — Replace the content branch gate:**
Replace the second `@if(isset($commName))` (in the content-card branch) with
`@if($canDeleteCommBoard)`. Again, the inner Delete/Edit markup is preserved verbatim.

**Change 4 — Leave everything else untouched:**
No change to the "Add to Board" button, the View button, the Link button, the empty-state
block, any modal (`#addToBoardModal`, `#deleteCommModal`, `#getCommunityData`), or any JS
flow (`deleteCommBoard`, `communityBtnEdit`, `communityBtnView`).

**Change 5 (none)**: `HumanResourceController` is intentionally not modified. `$commName`
continues to be passed (harmless, now unused for authorization) to keep the diff minimal
and avoid touching unrelated controller logic. Optionally it could be removed later, but
that is out of scope for this fix.

## Testing Strategy

### Validation Approach

The testing strategy follows a two-phase approach: first, demonstrate the bug on the
unfixed view (Delete/Edit visibility keyed on posting history, not authorization), then
verify the fix gates strictly on the config allowlist while preserving all other rendering.
Because the affected logic lives in a Blade partial gated by a computed boolean, tests
target the boolean's decision function and the rendered output.

### Exploratory Bug Condition Checking

**Goal**: Surface counterexamples that demonstrate the bug BEFORE implementing the fix.
Confirm or refute the root cause (visibility driven by `isset($commName)` rather than an
email allowlist). If refuted, we re-hypothesize.

**Test Plan**: Render the community board (or evaluate the visibility condition) for users
in each of the four example categories and assert Delete/Edit visibility. Run against the
UNFIXED view to observe the incorrect visibility.

**Test Cases**:
1. **Poster / not authorized**: User with a matching `$commName` but email not in the
   allowlist — unfixed view shows Delete/Edit on all items (will fail expected behavior).
2. **Authorized / never posted**: `cjzarsuelo@megawide.com.ph` with `$commName` null —
   unfixed view hides Delete/Edit (will fail expected behavior).
3. **Authorized / posted**: `jbarte@megawide.com.ph` with `$commName` set — unfixed and
   fixed agree (control case).
4. **Edge case — missing `mail`**: `$user` without a `mail` key — unfixed view decides on
   `$commName` only; the goal is to confirm the fixed check is null-safe (no PHP notice).

**Expected Counterexamples**:
- Delete/Edit shown for a poster whose email is not authorized.
- Delete/Edit hidden for an authorized user who never posted.
- Possible causes: gate uses posting history (`isset($commName)`), no config allowlist,
  authorization derived from display name rather than email.

### Fix Checking

**Goal**: Verify that for all inputs where the bug condition holds, the fixed view produces
the expected behavior (Delete/Edit visible iff email is in the allowlist).

**Pseudocode:**
```
FOR ALL user WHERE isBugCondition(user) DO
  showDeleteEdit := renderCommunityBoard_fixed(user)   // $canDeleteCommBoard
  ASSERT showDeleteEdit = isAuthorized(user)
END FOR
```

### Preservation Checking

**Goal**: Verify that for all inputs where the bug condition does NOT hold, the fixed view
produces the same result as the original view.

**Pseudocode:**
```
FOR ALL user WHERE NOT isBugCondition(user) DO
  ASSERT renderCommunityBoard_original(user) = renderCommunityBoard_fixed(user)
END FOR
```

**Testing Approach**: Property-based testing is recommended for preservation checking
because:
- It generates many user/authorization combinations automatically across the input domain.
- It catches edge cases (empty allowlist, differently-cased emails, whitespace, missing
  `mail`) that manual unit tests might miss.
- It provides strong guarantees that non-authorization rendering is unchanged for all users.

**Test Plan**: Observe the UNFIXED view's output for board content (items, empty-state,
View/Link buttons, modals) and for users whose authorization matched the old gate, then
write tests asserting that output is identical after the fix.

**Test Cases**:
1. **Board content preservation**: Observe that items, titles, content, View button, and
   Link button render correctly on the unfixed view, then verify unchanged after the fix.
2. **Empty-state preservation**: Observe "No Data Found." renders for an empty board on the
   unfixed view, then verify unchanged after the fix.
3. **Agreeing-visibility preservation**: For an authorized poster and an unauthorized
   non-poster, confirm Delete/Edit visibility matches the old gate before and after.
4. **Other-screen preservation**: Confirm announcements/job-vacancies/new-hires/surveys
   screens that read `$user['mail']` behave identically after the fix.

### Unit Tests

- Test `isAuthorized`/`$canDeleteCommBoard` logic: email in allowlist → true; email not in
  allowlist → false.
- Test case-insensitive and whitespace-tolerant matching (e.g. `CJZarsuelo@Megawide.com.ph`
  and `  cjzarsuelo@megawide.com.ph  ` both match).
- Test null-safety: `$user` without `mail`, `$user['mail']` null, empty allowlist → false
  and no error.
- Test that a matching config email renders both Delete and Edit controls in each branch.

### Property-Based Tests

- Generate random emails and random allowlists; assert visibility equals
  `normalized(email) ∈ normalized(allowlist)` for both Blade branches.
- Generate random board item collections; assert that item/View/Link rendering and the
  empty-state message are unaffected by the authorization decision (preservation).
- Generate users with/without a `mail` key and varied casing/whitespace; assert no error
  and correct visibility across many scenarios.

### Integration Tests

- Render `/human-resources` as an authorized user (email in allowlist) and assert Delete
  and Edit controls appear on community board items; exercise the delete confirmation modal
  and `deleteCommBoard`/destroy flow and the add/edit modal store/update flow.
- Render `/human-resources` as an unauthorized user (including one who has posted before)
  and assert Delete/Edit controls are absent while items, View/Link buttons, and the
  empty-state still render.
- Toggle the config allowlist (add/remove an email) and confirm visibility follows the
  config with no Blade/controller changes.
