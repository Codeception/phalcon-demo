<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('perform login as first user');

$I->haveInSession('auth', [
    'id'   => 1,
    'name' => 'Phalcon Demo'
]);

$I->amOnPage('/');
$I->see('Invoices');
$I->see('Log Out');
