# Implementation Plan

- [x] 1. Write bug condition exploration test
  - **Property 1: Bug Condition** - Delete/Edit Gated by Config Allowlist
  - **CRITICAL**: This test MUST FAIL on the unfixed view - failure confirms the bug exists
  - **DO NOT attempt to fix the test or the code when it fails**
  - **NOTE**: This test encodes the expected behavior - it will validate the fix when it passes after implementation
  - **GOAL**: Surface counterexamples that demonstrate visibility is driven by posting history (`isset($commName)`) rather than the email allowlist
  - **Scoped PBT Approach**: This is a deterministic authorization defect - scope the property to the four concrete design example categories plus generated email/allowlist pairs
  - Add a test file (e.g. `tests/Feature/CommunityBoardDeleteAuthorizationTest.php`) that renders `resources/views/pages/community_board_page.blade.php` (or evaluates the visibility condition) for each category with the required view data (`$community`, `$commName`, `$user`)
  - Encode the target decision from the design: `isAuthorized(user)` = normalized `$user['mail']` is in `config('community.delete_authorized_emails')` (trim + lowercase compare); absent/null `mail` → not authorized
  - Assert Delete/Edit visibility equals `isAuthorized(user)` for the design's example cases:
    - Poster / not authorized: `$commName` set, email NOT in allowlist → expect NO Delete/Edit
    - Authorized / never posted: `cjzarsuelo@megawide.com.ph`, `$commName` null → expect Delete/Edit shown
    - Authorized / posted: `jbarte@megawide.com.ph`, `$commName` set → expect Delete/Edit shown
    - Edge case — missing `mail` key: `$user` has no `mail` → expect NO Delete/Edit and no PHP notice/error
  - Run test on UNFIXED code (`php artisan test --filter=CommunityBoardDeleteAuthorization`)
  - **EXPECTED OUTCOME**: Test FAILS (this is correct - the unfixed gate shows Delete/Edit to any poster and hides it from authorized non-posters)
  - Document counterexamples found (e.g., "Delete/Edit shown for a poster whose email is not in the allowlist"; "Delete/Edit hidden for `cjzarsuelo@megawide.com.ph` who never posted")
  - Mark task complete when the test is written, run, and the failure is documented
  - _Requirements: 2.1, 2.2, 2.3, 2.5_

- [x] 2. Write preservation property tests (BEFORE implementing fix)
  - **Property 2: Preservation** - Board Rendering and Non-Bug Visibility
  - **IMPORTANT**: Follow observation-first methodology - record the UNFIXED view's output first, then assert it is unchanged
  - Observe on the UNFIXED view and capture as assertions:
    - Board items render with title, content, View button, and Link button (when a link exists)
    - The empty-state "No Data Found." message renders when `$community` is empty
    - The modals (`#addToBoardModal`, `#deleteCommModal`, `#getCommunityData`) and the "Add to Board" button render
    - Delete/Edit visibility for the "authorized and posted" agreeing case (`jbarte@megawide.com.ph`, `$commName` set) shows controls both before and after
  - Write property-based tests capturing observed patterns from the Preservation Requirements:
    - Generate random board item collections; assert item/View/Link rendering and the empty-state message are unaffected by the authorization decision
    - Generate random emails and random allowlists; assert visibility equals `normalized(email) ∈ normalized(allowlist)` for BOTH Blade branches (image/video and content-card)
    - Generate users with varied casing/whitespace and with/without a `mail` key; assert no error
  - Run tests on UNFIXED code
  - **EXPECTED OUTCOME**: Tests PASS (this confirms baseline rendering and the agreeing-visibility case to preserve)
  - Mark task complete when tests are written, run, and passing on unfixed code
  - _Requirements: 3.1, 3.2, 3.3, 3.4, 3.5_

- [x] 3. Fix for Community Board Delete/Edit authorization

  - [x] 3.1 Create the config allowlist file
    - Create `config/community.php` returning an array with a `delete_authorized_emails` key seeded with `cjzarsuelo@megawide.com.ph` and `jbarte@megawide.com.ph`
    - This is the single place future maintainers edit; no Blade/controller changes required to update the allowlist
    - _Bug_Condition: isBugCondition(user) — posted-status disagrees with allowlist authorization_
    - _Expected_Behavior: isAuthorized(user) reads normalized emails from config('community.delete_authorized_emails')_
    - _Preservation: config-only maintenance; no other files affected_
    - _Requirements: 1.1, 1.2, 2.4_

  - [x] 3.2 Add the `$canDeleteCommBoard` @php block to the partial
    - In `resources/views/pages/community_board_page.blade.php`, add a `@php` block near the top (before the item loop) that computes `$canDeleteCommBoard` null-safely
    - Normalize both sides with `strtolower(trim(...))`; use `config('community.delete_authorized_emails', [])` default and `$user['mail'] ?? ''` for null-safety; treat empty email as not authorized; use strict `in_array(..., true)` on normalized strings
    - _Bug_Condition: isBugCondition(user) from design_
    - _Expected_Behavior: expectedBehavior(result) — $canDeleteCommBoard = normalized mail ∈ normalized allowlist; false when mail absent/null_
    - _Preservation: computed once; does not alter any other view data_
    - _Requirements: 2.1, 2.2, 2.3, 2.5_

  - [x] 3.3 Replace both `isset($commName)` gates with `$canDeleteCommBoard`
    - Replace the `@if(isset($commName))` gate in the image/video branch (around line 50) with `@if($canDeleteCommBoard)`, preserving the inner Delete/Edit anchor markup verbatim
    - Replace the second `@if(isset($commName))` gate in the content-card branch (around line 71) with `@if($canDeleteCommBoard)`, preserving the inner Delete/Edit anchor markup verbatim
    - Leave the "Add to Board" button, View button, Link button, empty-state block, all modals, and all JS flows (`deleteCommBoard`, `communityBtnEdit`, `communityBtnView`) untouched
    - Do NOT modify `HumanResourceController` — `$commName` continues to be passed (now unused for authorization) to keep the diff minimal
    - _Bug_Condition: isBugCondition(user) from design_
    - _Expected_Behavior: expectedBehavior(result) — both branches gate on $canDeleteCommBoard consistently_
    - _Preservation: inner markup and all non-gate rendering preserved byte-for-byte_
    - _Requirements: 2.1, 2.2, 3.1, 3.2, 3.3, 3.4, 3.5_

  - [x] 3.4 Verify bug condition exploration test now passes
    - **Property 1: Expected Behavior** - Delete/Edit Gated by Config Allowlist
    - **IMPORTANT**: Re-run the SAME test from task 1 - do NOT write a new test
    - The test from task 1 encodes the expected behavior; when it passes it confirms visibility follows the allowlist
    - Run `php artisan test --filter=CommunityBoardDeleteAuthorization`
    - **EXPECTED OUTCOME**: Test PASSES (confirms the bug is fixed — controls show iff email is authorized, null-safe for missing `mail`)
    - _Requirements: 2.1, 2.2, 2.3, 2.5_

  - [x] 3.5 Verify preservation tests still pass
    - **Property 2: Preservation** - Board Rendering and Non-Bug Visibility
    - **IMPORTANT**: Re-run the SAME tests from task 2 - do NOT write new tests
    - Run the preservation property tests from step 2
    - **EXPECTED OUTCOME**: Tests PASS (confirms items, empty-state, View/Link buttons, modals, action flows, and agreeing-visibility cases are unchanged)
    - Confirm no regressions after the fix
    - _Requirements: 3.1, 3.2, 3.3, 3.4, 3.5_

- [x] 4. Checkpoint - Ensure all tests pass
  - Run the full relevant suite (`php artisan test`) and confirm both the bug condition test and preservation tests pass
  - Ensure all tests pass; ask the user if questions arise
