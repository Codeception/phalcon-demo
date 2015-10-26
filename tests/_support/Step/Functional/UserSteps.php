<?php

namespace Step\Functional;

class UserSteps extends \FunctionalTester
{

    public function amRegularUser()
    {
        $I = $this;

        $id = $I->haveRecord('PhalconDemo\Models\Users', [
            'username' => 'i_regular',
            'password' => 'password',
            'name'     => 'Regular User',
            'email'    => 'i_regular@phalcon-demo.local',
            'active'   => 'Y'
        ]);

        $I->haveInSession('auth', [
            'id'   => $id,
            'name' => 'Regular User'
        ]);

        return $id;
    }
}
