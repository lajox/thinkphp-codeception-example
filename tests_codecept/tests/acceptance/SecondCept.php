<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/login');
$I->fillField('Username','john');
$I->fillField('Password','secret');
$I->click('Login');
$I->see('Hello john');
