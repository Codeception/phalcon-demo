<?php

namespace User\Functional;

use FunctionalTester;

/**
 * Class UserSteps
 *
 * @package User\Functional
 */
class UserSteps
{
    /**
     * @var FunctionalTester
     */
    protected $tester;

    protected $formFields = [
        'email'    => 'i_regular@phalcon-demo.local',
        'password' => 'password',
        'username' => 'Regular User',
        'name'     => 'i_regular',
        'active'   => 'Y',
    ];

    public function __construct(FunctionalTester $I)
    {
        $this->tester = $I;
    }

    /**
     * @return int
     */
    public function createUser()
    {
        $I = $this->tester;

        return $I->haveRecord('PhalconDemo\Models\Users', $this->formFields);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function loginAsFirstUser()
    {
        $I = $this->tester;

        $I->amOnPage('/login');
        $this->fillFormFields([
            'email'    => 'demo@phalconphp.com',
            'password' => 'phalcon'
        ]);
        $I->click('Login');
        $I->amOnPage('/session/start');
    }

    protected function fillFormFields(array $data)
    {
        foreach ($data as $field => $value) {
            if (!isset($this->formFields[$field])) {
                throw new \Exception("Form field  $field does not exist");
            }

            $this->tester->fillField($field, $value);
        }
    }
}
