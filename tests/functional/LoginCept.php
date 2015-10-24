<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('login as regular user');

$I->amOnPage('/');
$I->click('Log In/Sign Up');
$I->seeInCurrentUrl('/session/index');

$I->see('Log In', "//*[@id='login-header']");
$I->see("Don't have an account yet?", "//*[@id='signup-header']");

$I->fillField('email',    'demo@phalconphp.com');
$I->fillField('password', 'phalcon');

$I->click('Login');
$I->seeInCurrentUrl('/session/start');

$I->see('Welcome Phalcon Demo');
$I->seeLink('Log Out');
