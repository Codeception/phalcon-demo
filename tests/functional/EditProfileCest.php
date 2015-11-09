<?php

use User\Functional\UserSteps;

class EditProfileCest
{
    public function editAProfile(FunctionalTester $I, UserSteps $userSteps)
    {
        $userSteps->loginAsFirstUser();

        $I->click('Profile');
        $I->dontSeeInFormFields('#profileForm', ['name' => 'John Doe']);

        $I->fillField('name', 'John Doe');
        $I->click('Update');

        $I->click('Log Out');
        $I->see('Goodbye John Doe!');
    }
}

