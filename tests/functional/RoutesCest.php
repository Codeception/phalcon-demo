<?php

class RoutesCest
{
    public function openPageByRoute(FunctionalTester $I)
    {
        $I->amOnRoute('front.contact');
        $I->see('Contact Us');
        $I->see('Send us a message and let us know how we can help.');
        $I->seeCurrentUrlEquals('/contact-us');
    }

    public function routesWithTrailingSlashes(FunctionalTester $I)
    {
        $I->amOnPage('/contact-us////////');
        $I->see('Contact Us');
        $I->seeCurrentRouteIs('front.contact');
    }
}
