<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new User\Functional\UserSteps($scenario);

$I->wantTo('edit a profile');

$userId = $I->amRegularUser();
$I->amOnPage('/login');

$I->fillField('email',    'demo@phalconphp.com');
$I->fillField('password', 'phalcon');
$I->click('Login');

$I->amOnPage('/session/start');

$I->click('Profile');

$I->dontSeeInFormFields('#profileForm', [
    'name' => 'John Doe'
]);

$I->fillField('name', 'John Doe');
$I->click('Update');

$I->see('Your profile information was updated successfully');

$I->click('Log Out');
$I->see('Goodbye John Doe!');

