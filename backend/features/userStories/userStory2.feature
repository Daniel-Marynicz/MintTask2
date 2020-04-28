@ui
Feature: User Story 2
  As a signed in User, I want to see paginated list of all
  application users, where I can disable each application account.
  Acceptance criteria
  - User should see paginated list with maximum 10 rows with
  columns 1) username and 2) action
  - User should see disable button which is active for enabled
  users, and disabled for disabled users.
  - User should be able to paginate over the list
  Background:
    Given there are following users:
      | username | enabled |
      | user01   |  1      |
      | user02   |  0      |
      | user03   |  1      |
      | user04   |  1      |
      | user05   |  1      |
      | user06   |  1      |
      | user07   |  1      |
      | user08   |  1      |
      | user09   |  1      |
      | user10   |  1      |
      | user11   |  1      |
      | user12   |  1      |
      | user13   |  1      |
      | user14   |  1      |
      | user15   |  1      |
      | user16   |  1      |
      | user17   |  1      |
      | user18   |  1      |
      | user19   |  1      |
      | user20   |  1      |
      | user21   |  1      |
      | user22   |  1      |
      | user23   |  1      |
      | user24   |  1      |
      | user25   |  1      |
      | user26   |  1      |
      | user27   |  1      |
      | user28   |  1      |
      | user29   |  1      |
      | user30   |  1      |
      | user31   |  1      |
      | user32   |  1      |
      | user33   |  1      |
      | user34   |  1      |
      | user35   |  1      |
      | user36   |  1      |
      | user37   |  1      |
      | user38   |  1      |
      | user39   |  1      |
      | user40   |  1      |
    Scenario:  User should see paginated list with maximum 10 rows with  columns 1) username and 2) action
      Given I am logged in as "user01"
      And I am on "/admin/user/"
      Then I should see 2 columns in the "table" table
      And I should see 10 rows in the "table" table
      And the columns schema of the "table" table should match:
        | columns  |
        | Username |
        | Action   |

    Scenario: User should see disable button which is active for enabled users, and disabled for disabled users.
      Given I am logged in as "user01"
      And I am on "/admin/user/"
      Then the data in the "3" row of the "table" table should match:
        | col1     | col2              |
        | user03   | show edit Disable |
      And the data in the "2" row of the "table" table should match:
        | col1     | col2              |
        | user02   | show edit Enable  |
    Scenario: User should be able to paginate over the list
      Given I am logged in as "user01"
      And I am on "/admin/user/"
      Then the data of the "table" table should match:
      | Username | Action             |
      | user01   | show edit Disable  |
      | user02   | show edit Enable   |
      | user03   | show edit Disable  |
      | user04   | show edit Disable  |
      | user05   | show edit Disable  |
      | user06   | show edit Disable  |
      | user07   | show edit Disable  |
      | user08   | show edit Disable  |
      | user09   | show edit Disable  |
      | user10   | show edit Disable  |
      Then I follow "2"
      And I should be on "/admin/user/?page=2"
      Then the data of the "table" table should match:
        | Username | Action             |
        | user11   | show edit Disable  |
        | user12   | show edit Disable  |
        | user13   | show edit Disable  |
        | user14   | show edit Disable  |
        | user15   | show edit Disable  |
        | user16   | show edit Disable  |
        | user17   | show edit Disable  |
        | user18   | show edit Disable  |
        | user19   | show edit Disable  |
        | user20   | show edit Disable  |
      Then I follow ">"
      And I should be on "/admin/user/?page=3"
      Then the data of the "table" table should match:
        | Username | Action             |
        | user21   | show edit Disable  |
        | user22   | show edit Disable  |
        | user23   | show edit Disable  |
        | user24   | show edit Disable  |
        | user25   | show edit Disable  |
        | user26   | show edit Disable  |
        | user27   | show edit Disable  |
        | user28   | show edit Disable  |
        | user29   | show edit Disable  |
        | user30   | show edit Disable  |
      Then I follow ">>"
      And I should be on "/admin/user/?page=4"
      Then the data of the "table" table should match:
        | Username | Action             |
        | user31   | show edit Disable  |
        | user32   | show edit Disable  |
        | user33   | show edit Disable  |
        | user34   | show edit Disable  |
        | user35   | show edit Disable  |
        | user36   | show edit Disable  |
        | user37   | show edit Disable  |
        | user38   | show edit Disable  |
        | user39   | show edit Disable  |
        | user40   | show edit Disable  |
      Then I follow "<<"
      And I should be on "/admin/user/?page=1"
      Then the data of the "table" table should match:
        | Username | Action             |
        | user01   | show edit Disable  |
        | user02   | show edit Enable   |
        | user03   | show edit Disable  |
        | user04   | show edit Disable  |
        | user05   | show edit Disable  |
        | user06   | show edit Disable  |
        | user07   | show edit Disable  |
        | user08   | show edit Disable  |
        | user09   | show edit Disable  |
        | user10   | show edit Disable  |

