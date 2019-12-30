<?php

class ModeratorCest
{
    public function _before(MixtureTester $I)
    {
    }

    // tests
    public function tryToTest(MixtureTester $I)
    {
    }

    public function login(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);

        // logs moderator in
        $I->assertTrue(true);
    }

    /**
     * @depends login
     */
    public function banUser(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);

        // bans user
        $I->assertTrue(true);
    }

    /**
     * @example(url="/", title="Welcome")
     * @example(url="/info", title="Info")
     * @example(url="/about", title="About Us")
     * @example(url="/contact", title="Contact Us")
     */
    public function staticPages(AcceptanceTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['title'], 'h1');
        $I->seeInTitle($example['title']);
    }


    /**
     * @dataProvider pageProvider
     */
    public function staticPagesAgain(AcceptanceTester $I, \Codeception\Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['title'], 'h1');
        $I->seeInTitle($example['title']);
    }

    /**
     * @return array
     */
    protected function pageProvider() // alternatively, if you want the function to be public, be sure to prefix it with `_`
    {
        return [
            ['url'=>"/", 'title'=>"Welcome"],
            ['url'=>"/info", 'title'=>"Info"],
            ['url'=>"/about", 'title'=>"About Us"],
            ['url'=>"/contact", 'title'=>"Contact Us"]
        ];
    }
}
