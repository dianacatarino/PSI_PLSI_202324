<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    /**
     * Testa o login com credenciais válidas
     *
     * @param FunctionalTester $I
     */
    public function loginUserWithValidCredentials(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('Sign In');

        $I->amOnRoute('/site/index');
    }

    /**
     * Testa o login com credenciais inválidas
     *
     * @param FunctionalTester $I
     */
    public function loginUserWithInvalidCredentials(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'senha_incorreta');
        $I->click('Sign In');

        // Ajuste para refletir uma condição de login mal-sucedido
        $I->see("Senha incorreta. Por favor, tente novamente.", ".alert-danger");
        $I->dontSeeLink('Signup'); // Não deve haver link de Signup se o login falhar
    }

    public function loginUserWithInvalidUsername(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');
        $I->fillField('LoginForm[username]', 'erau_invalido');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('Sign In');

        $I->dontSeeLink('Signup'); // Não deve haver link de Signup se o login falhar
    }
}
