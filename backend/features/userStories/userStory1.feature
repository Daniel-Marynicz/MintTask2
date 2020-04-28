@ui
Feature: User Story 1
  As a user, I want to see an option to either sign in or sign up,
  so I can access application with my account
  Acceptance criteria:
  - User should see sign in screen with input data fields for 1)
  Username 2) Password
  - User should see an option to Sign-up if they don't have an
  account created - clicking on this option will route user to the
  Sign-in screen
  - User with disabled account should not sign in
  - Signed in User should be redirect to restricted part of
  application
  - Signed in User should see logout option

  Scenario: User should see sign in screen with input data fields for 1) Username 2) Password
    Given I am on homepage
    Then the "username" field should exist
    And the "password" field should exist

  Scenario: User should see an option to Sign-up if they don't have an account created
            - clicking on this option will route user to the Sign-in screen
    Given I am on homepage
    Then I should see "Sign-up"
    And I follow "Sign-up"
    Then I should be on "/register"

  Scenario Outline: User should not see an option Sign-up if user is logged
    Given there are following users:
      | username   | password      | roles        |
      | <username> | some-password | [ROLE_USER]  |
    Given I am logged in as "<username>"
    And I am on homepage
    Then I should not see "Sign-up"

    Examples:
      | username        |
      | some-user       |
      | some-other-user |

  Scenario Outline: User with disabled account should not sign in
    Given there are following users:
      | username   | password     | enabled |
      | <username> | <password>   | 0       |
    Then I am on homepage
    And I fill in the following:
      | username | <username> |
      | password | <password> |
    And I press "Sign in"
    Then I should see "Username could not be found."
    Examples:
      | username        | password |
      | some-user       | sadasd   |
      | some-other-user | paasasd  |

  Scenario Outline: Signed in User should be redirect to restricted part of application
    Given there are following users:
      | username   | password     |
      | <username> | <password>   |
    Then I am on homepage
    And I fill in the following:
      | username | <username> |
      | password | <password> |
    And I press "Sign in"
    Then I should be on "/dashboard"
    Examples:
      | username        | password |
      | some-user       | sadasd   |
      | some-other-user | paasasd  |

  Scenario: Signed in User should see logout option
    Given there are following users:
      | username      |
      | some-user-123 |
    When I am logged in as "some-user-123"
    And I am on "/dashboard"
    Then I should see "Logout"
