<?php

namespace common\tests\functional;

//use tests\codeception\functional\FunctionalTester;


use common\fixtures\ProfileFixture;
use common\fixtures\UserFixture;

class LoginCest{

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

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

    public function trySubmitFormNameInvalido(\FunctionalTester $I){
        $nomeIvalido = 'nome_invalido';

        $I->amOnPage('backend/site/login');
        $I->see('Login');

        $I->fillField('input[name="User[name]"]', $nomeIvalido);
        $I->fillField('input[name="User[password]"]', 'password_aleatoria');

        $I->submitForm('#login-form', []);

        //$I->see('Name is not a valid.');
        $I->seeCurrentUrlEquals('backend/site/login');
        $I->dontSeeElement('.success-message');
    }

    public function trySubmitFormPasswordInvalida(\FunctionalTester $I){ //Terminar e fazer tambem para password errada
        $passwordInvalida = 'password_invalida';

        $I->amOnPage('backend/site/login');
        $I->see('Login');

        $I->fillField('input[name="User[name]"]', 'nome_aleatorio');
        $I->fillField('input[name="User[password]"]', $passwordInvalida);

        $I->submitForm('#login-form', []);

        //$I->see('Password is not a valid.');
        $I->seeCurrentUrlEquals('backend/site/login');
        $I->dontSeeElement('.success-message');
    }

    public function _after(\FunctionalTester $I){ //Serve para reverter todas as alteracoes depois dos testes serem executados

        $I->haveFixtures([
            'profile' => UserFixture::class,
        ]);
    }

}