<?php 

class MixSomeCest
{
    public function _before(MixtureTester $I)
    {
    }

    // tests
    public function tryToTest(MixtureTester $I)
    {
    }

    /**
     *
     */
    protected function actionFirst(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @before actionFirst
     */
    public function actionSecond(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @before actionSecond
     * @after actionFourth
     */
    public function actionThird(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @after actionFifth
     */
    public function actionFourth(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @after actionSixth
     */
    public function actionFifth(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     *
     */
    public function actionSixth(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @group usergroup
     */
    public function actionLogin(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

    /**
     * @depends actionLogin
     * @group usergroup
     */
    public function actionUser(MixtureTester $I)
    {
        # debug输出一条信息
        $I->debugSection('CurrentMethod', __METHOD__);
        $I->assertTrue(true);
    }

}
