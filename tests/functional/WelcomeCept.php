<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('see working welcome page of the site');
$I->amOnPage('/');
$I->seeInTitle('Phalcon Demo Application | Welcome');
$I->see("This is a Phalcon Demo Application. Please don't provide us any personal information. Thanks!");
$I->see('Log In/Sign Up');
