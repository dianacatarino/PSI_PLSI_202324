<?php

namespace common\tests\functional;

//use tests\codeception\functional\FunctionalTester;


class LoginCest{

    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('backend/site/login'); //confirmar a rota
    }

    public function tryLogin(\FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('Username' , 'admin');
        $I->fillField('Password' , 'admin123');
        $I->click('Enter');

        //Asserção
        $I->seeCurrentUrlEquals('/admin/dashboard'); //confirmar a rota

    }

}