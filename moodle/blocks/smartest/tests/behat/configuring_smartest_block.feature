@block @block_smartest @core_block
Feature: Adding and configuring Smartest blocks
In order to have a Smartest block on a course page
As admin or teacher
I need to be able to create and delete Smartest blocks
I need to not be able to create additional Smartest blocks

  Background:
    Given the following "courses" exist:
    | fullname | shortname | format |
    | Course 1 | C1 | topics |
    | Course 2 | C2 | topics |
    And the following "users" exist:
    | username | firstname | lastname | email |
    | teacher1 | Terry1 | Teacher1 | teacher@example.com |
    | student1 | Sam1 | Student1 | student1@example.com |
    And the following "course enrolments" exist:
    | user | course | role |
    | teacher1 | C2 | editingteacher |
    | student1 | C2 | student |

  @javascript
  Scenario: Configuring the Smartest block as admin with Javascript on
    Given I log in as "admin"
    And I am on the "C1" Course page
    And I turn editing mode on
    And I add the "Smartest" block
    Then "block_smartest" "block" should exist
    And I configure the "block_smartest" block
    And I press "Save changes"
    Then "block_smartest" "block" should exist
    And I log out
    And I log in as "teacher1"
    And I am on the "C2" Course page
    And I turn editing mode on
    And I add the "Smartest" block
    Then "block_smartest" "block" should exist
    And I configure the "block_smartest" block
    And I press "Save changes"
    Then "block_smartest" "block" should exist
    And I log out
    And I log in as "student1"
    And I am on the "C2" Course page
    Then "block_smartest" "block" should exist
    And I log out
    And I log in as "admin"
    And I am on the "C1" Course page
    And I turn editing mode on
    Then the add block selector should not contain "Smartest" block

  Scenario: Configuring the Smartest block as admin with Javascript off
    Given I log in as "admin"
    And I am on the "C1" Course page
    And I turn editing mode on
    And I add the "Smartest" block
    Then "block_smartest" "block" should exist
    And I configure the "block_smartest" block
    And I press "Save changes"
    Then "block_smartest" "block" should exist
    And I log out
    And I log in as "teacher1"
    And I am on the "C2" Course page
    And I turn editing mode on
    And I add the "Smartest" block
    Then "block_smartest" "block" should exist
    And I configure the "block_smartest" block
    And I press "Save changes"
    Then "block_smartest" "block" should exist
    And I log out
    And I log in as "student1"
    And I am on the "C2" Course page
    Then "block_smartest" "block" should exist
