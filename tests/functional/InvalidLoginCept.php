<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('login with invalid password and see banner');

$I->amOnPage('/');
$I->click('Log In/Sign Up');
$I->seeInCurrentUrl('/session/index');

$I->fillField('email',    'demo@phalconphp.com');
$I->fillField('password', 'invalid');

$I->click('Login');
$I->seeInCurrentUrl('/session/start');

$I->see('Wrong email/password');
$I->dontSee('Log Out');
