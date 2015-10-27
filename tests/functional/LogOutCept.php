<?php
/**
 * @var \Codeception\Scenario $scenario
 */

$I = new FunctionalTester($scenario);

$I->wantTo('logout from site');

$I->haveInSession('auth', [
    'id'   => 1,
    'name' => 'Phalcon Demo'
]);

$I->amOnPage('/');
$I->click('Log Out');
$I->see('Goodbye Phalcon Demo!');
$I->seeInCurrentUrl('/session/end');
