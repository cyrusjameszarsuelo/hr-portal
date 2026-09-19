# Bugfix Requirements Document

## Introduction

The Community Board on the HR Portal (`resources/views/pages/community_board_page.blade.php`,
rendered as part of the `pages.human_resources` screen) shows a **Delete** button
(and an accompanying **Edit** button) for each board item. Delete/Edit visibility is
currently gated by `@if(isset($commName))`, where `$commName` is set in
`HumanResourceController` to the first `Community_Board` row whose `user_name` matches
the logged-in user's Microsoft 365 display name.

The effect is an authorization defect: **any employee who has ever posted a single item
to the board is shown Delete/Edit controls for every item on the board**, not just their
own — and conversely, the intent to restrict deletion to specific authorized staff is not
met. The check is based on "has this person posted before" rather than "is this person
authorized to delete."

The desired behavior is to display the Delete button (and its paired Edit button) only
when the logged-in user's email address matches an allowlist of authorized emails. The
allowlist must live in a Laravel config file so it can be edited later without touching
Blade or controller code. The logged-in email is obtained from the Microsoft Graph
mechanism already used across the app (`$user = MsGraph::get('me')`, read in Blade as
`$user['mail']`).

Initial authorized emails:
- `cjzarsuelo@megawide.com.ph`
- `jbarte@megawide.com.ph`

The two occurrences of the Delete/Edit controls in the Blade view (in the image/video
branch and in the content branch) must both use the same authorization check, and the
surrounding markup should be refactored cleanly without introducing errors or changing
any unrelated behavior.

## Bug Analysis

### Current Behavior (Defect)

Delete/Edit visibility is driven by whether the logged-in user has ever posted to the
board (`isset($commName)`), not by whether they are authorized to delete.

1.1 WHEN a logged-in user has previously posted at least one community board item (so `$commName` is set) THEN the system displays the Delete and Edit buttons on every community board item, including items the user did not create and regardless of whether the user is an authorized deleter.

1.2 WHEN a logged-in authorized user (e.g. `cjzarsuelo@megawide.com.ph`) has never posted a community board item (so `$commName` is null) THEN the system hides the Delete and Edit buttons, incorrectly denying them delete rights.

1.3 WHEN determining Delete/Edit visibility THEN the system relies on a value derived from the user's Microsoft 365 display name (`user_name`) rather than the user's email address, so authorization cannot be reliably or centrally controlled.

1.4 WHEN the set of people allowed to delete needs to change THEN the system requires editing the Blade view / controller logic because there is no config-driven allowlist.

### Expected Behavior (Correct)

Delete/Edit visibility is driven by a config-based email allowlist checked against the
logged-in user's Microsoft 365 email.

2.1 WHEN a logged-in user's email (`$user['mail']`) is present in the configured authorized-email allowlist THEN the system SHALL display the Delete and Edit buttons on community board items.

2.2 WHEN a logged-in user's email is NOT present in the configured authorized-email allowlist THEN the system SHALL hide the Delete and Edit buttons, regardless of whether that user has previously posted to the board.

2.3 WHEN determining Delete/Edit visibility THEN the system SHALL base the decision on the user's email address obtained via the Microsoft Graph mechanism (`$user['mail']`), not on the user's display name or on `$commName`.

2.4 WHEN the list of authorized deleters needs to change THEN the system SHALL allow adding or removing emails by editing a Laravel config file only (e.g. `config/community.php`), with no changes required to the Blade view or controller logic.

2.5 WHEN both occurrences of the Delete/Edit controls are rendered (the image/video branch and the content branch) THEN the system SHALL apply the same config-driven authorization check consistently in both places.

### Unchanged Behavior (Regression Prevention)

3.1 WHEN any logged-in user views the community board THEN the system SHALL CONTINUE TO display all community board items (images, videos, and content cards) with their title, content, View button, and Link button (when a link exists) exactly as before.

3.2 WHEN the community board has no items THEN the system SHALL CONTINUE TO display the "No Data Found." message.

3.3 WHEN a user is authorized and clicks Delete THEN the system SHALL CONTINUE TO open the existing delete confirmation modal and delete the item via the existing `deleteCommBoard` / destroy flow.

3.4 WHEN a user is authorized and clicks Edit or Add to Board THEN the system SHALL CONTINUE TO open the existing add/edit modal and save via the existing store/update flow.

3.5 WHEN any of the other admin-gated screens that read `$user['mail']` (e.g. announcements, job vacancies, new hires, surveys) are rendered THEN the system SHALL CONTINUE TO behave exactly as before, since this fix is scoped to the community board Delete/Edit visibility only.

## Bug Condition and Properties

### Bug Condition

The bug condition identifies inputs (the logged-in user) for which the current code
produces the wrong Delete/Edit visibility.

```pascal
FUNCTION isBugCondition(user)
  INPUT: user  // the logged-in Microsoft 365 user
  OUTPUT: boolean

  // hasPosted(user): true when a Community_Board row exists with user_name = user.displayName
  //                  (i.e. the current isset($commName) gate is true)
  // isAuthorized(user): true when user.mail is in the configured allowlist

  // The current gate (hasPosted) disagrees with the correct gate (isAuthorized)
  // in either direction:
  //   - posted but not authorized  -> buttons wrongly shown
  //   - authorized but never posted -> buttons wrongly hidden
  RETURN hasPosted(user) <> isAuthorized(user)
END FUNCTION
```

### Property: Fix Checking

For every user where the old and new gates disagree, the fixed view must show
Delete/Edit strictly according to the allowlist.

```pascal
// Property: Fix Checking - Authorization by config allowlist
FOR ALL user WHERE isBugCondition(user) DO
  showDeleteEdit ← renderCommunityBoard'(user)   // F' = fixed view
  ASSERT showDeleteEdit = isAuthorized(user)
END FOR
```

Concretely:
- `isAuthorized(user)` is true iff `user['mail']` is contained in the allowlist from
  `config/community.php`.
- Counterexample under current code: a user who posted once but whose email is not in the
  allowlist currently sees Delete on all items; after the fix the buttons are hidden.
- Counterexample under current code: `cjzarsuelo@megawide.com.ph` who never posted
  currently sees no Delete button; after the fix the buttons are shown.

### Property: Preservation Checking

For every user where the allowlist decision matches what the old gate happened to produce,
and for all board content rendering, the fixed view behaves identically to the original.

```pascal
// Property: Preservation Checking
FOR ALL user WHERE NOT isBugCondition(user) DO
  ASSERT renderCommunityBoard(user) = renderCommunityBoard'(user)   // F = F'
END FOR
```

This preserves all non-authorization rendering (items list, empty-state message,
View/Link buttons, modals, and the delete/edit action flows) for every user, and keeps
Delete/Edit visibility identical for users whose authorization status already agreed with
the old `isset($commName)` gate.

**Key definitions:**
- **F** — the current view logic gating Delete/Edit on `isset($commName)`.
- **F'** — the fixed view logic gating Delete/Edit on the config-driven email allowlist,
  applied consistently to both occurrences.
