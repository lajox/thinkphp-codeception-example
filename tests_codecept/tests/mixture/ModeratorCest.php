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
}
