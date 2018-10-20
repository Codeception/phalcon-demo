<?php

class SessionCest
{
    public function testSession(FunctionalTester $I)
    {
        $I->assertTrue($I->grabServiceFromContainer('session')->getTrue());
    }
}
