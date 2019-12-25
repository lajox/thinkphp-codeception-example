<?php
$I = new FunctionalTester($scenario);
$I->amOnPage('/');
$I->click('Login');
$I->fillField('Username', 'Miles');
$I->fillField('Password', 'Davis');
$I->click('Enter');
$I->see('Hello, Miles', 'h1');
