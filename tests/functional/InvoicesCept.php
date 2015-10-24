<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('open invoices page and see invoices there');

$I->haveInSession('auth', [
    'id'   => 1,
    'name' => 'Phalcon Demo'
]);

$I->amOnPage('/');
$I->click('Invoices');
$I->seeInCurrentUrl('/invoices/index');
$I->see('Your Invoices');
