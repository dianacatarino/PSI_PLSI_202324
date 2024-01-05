<?php

namespace common\tests\unit\models;

use common\models\Profile;
use common\models\User;
use Yii;

/**
 *
 * UserTestes test
 */

class UsersTest extends \Codeception\Test\Unit {

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */

    public function testGetProfile(){

        $profile = $this->getMockBuilder(Profile::class)->getMock();

        //Instância do User
        $user = new User();

        // Substituir o comportamento do método hasOne()
        $user->expects($this->once())
            ->method('hasOne')
            ->with(Profile::class, ['user_id' => 'id'])
            ->willReturn($profile);

        $result = $user->getProfile();

        // Verificar se o resultado é o mock da classe Profile
        $this->assertEquals($profile, $result);
    }


    public function testRemoverPasswordResetToken(){

        $user = new User();

        // Definição de um valor inicial para password_reset_token
        $user->password_reset_token = '12345';

        $user->removePasswordResetToken();

        $this->assertNull($user->password_reset_token);
    }

    public function testGenerateEmailVerificationToken(){

        $user = new User();

        $user->generateEmailVerificationToken();

        $token = $user->verification_token;

        $this->assertNotNull($token);
        $this->assertIsString($token);

        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9_-]+_\d+$/', $token);
        //Verifica se o token se apresenta no formate esperado
    }

    public function testgeneratePasswordResetToken(){

        $user = new User();

        $user->generatePasswordResetToken();

        //Ligação das duas tabelas
        $token = $user->password_reset_token;

        $this->assertNotNull($token); //Verificação se o token é nulo, se for nulo o teste irá falhar
        $this->assertIsString($token); //Verificação se o token é uma string, se não falha

        // Verificar se o token possui o formato que deve ter
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9_-]+_\d+$/', $token);
    }

    public function testGenerateAuthKey(){
        $user = new User();

        $user->generateAuthKey();

        $authKey = $user->auth_key;

        $this->assertNotNull($authKey);
        $this->assertIsString($authKey);

        $this->assertRegExp('/^[a-zA-Z0-9_-]+$/', $authKey);
    }

    public function testSetPassword(){

        $user = new User();

        // Definição da password
        $password = '12345';

        // Chamar o método para gerar o hash
        $user->setPassword($password);

        // Confirmação se foi gerado conforme o esperado
        $passwordHash = $user->password_hash;

        $this->assertNotNull($passwordHash);
        $this->assertIsString($passwordHash);

        $this->assertTrue(Yii::$app->security->validatePassword($password, $passwordHash));
    }

    public function testValidatePassword(){
        $user = new User();

        $password = '56789';
        $user->setPassword($password);

        $isValidPassword = $user->validatePassword($password);

        $this->assertTrue($isValidPassword);
    }

    public function testValidateAuthKey(){

        $user = new User();

        $authKey = 'chave_autenticacao';

        $user->method('getAuthKey')->willReturn($authKey);
        $isValidAuthKey = $user->validateAuthKey($authKey);

        $this->assertTrue($isValidAuthKey);
    }

    public function testGetAuthKey(){

        $expectedAuthKey = 'chave_autenticacao';

        $user = new User();

        $user->auth_key = $expectedAuthKey;
        $authKey = $user->getAuthKey();
        $this->assertEquals($expectedAuthKey, $authKey);
    }

    public function testGetId(){

        $chavePrimariaEsperada = 1;
        $user = new User();

        //Simula que o modelo tem um método getPrimaryKey() e tem de devolver o valor do $chavePrimariaEsperada
        $user->method('getPrimaryKey')->willReturn($chavePrimariaEsperada);

        $chavePrimaria = $user->getId();
        $this->assertEquals($chavePrimariaEsperada, $chavePrimaria);
    }

    public function testIsPasswordResetTokenValid(){

        $user = new User();

        $tokenValido = 'token_valido';
        $TokenExpirado = 'token_expirado';

        //Definido para meia hora
        $timestampValido = time() + 1800;
        $timestampExpirado = time() - 1800;

        // Simula a configuração quando expirado
        Yii::$app->params['user.passwordResetTokenExpire'] = 1800;

        // Tem de testar com o token vazio
        $this->assertFalse(User::isPasswordResetTokenValid(''));


        $this->assertTrue(User::isPasswordResetTokenValid($tokenValido . '_' . $timestampValido));
        $this->assertFalse(User::isPasswordResetTokenValid($TokenExpirado . '_' . $timestampExpirado));
    }


    public function testFindByVerificationToken(){

        //Tem de ser configuraod de yii2 para testes
        //atenção e alterar de acordo os diretorios de cada utilizador!!
        $config = require 'C:\wamp64\www\new_project\LusitaniaTravel\common\config\test.php';
        new \yii\console\Application($config);


        $user = new User();
        $user->verification_token = 'token_verificacao';
        $user->status = User::STATUS_INACTIVE;
        $user->save();

        $foundModel = User::findByVerificationToken('token_verificacao');

        $this->assertInstanceOf(SeuModelo::class, $foundModel);

        // Verificação dos atriubos obtidos da funcao com o que se espera
        $this->assertEquals('token_verificacao', $foundModel->verification_token);
        $this->assertEquals(User::STATUS_INACTIVE, $foundModel->status);
    }


    public function testFindByPasswordResetToken(){

        //Tem de ser configuraod de yii2 para testes
        //atenção e alterar de acordo os diretorios de cada utilizador!!
        $config = require 'C:\wamp64\www\new_project\LusitaniaTravel\common\config\test.php';
        new \yii\console\Application($config);

        // Criar um modelo de exemplo no banco de dados em memória
        $user = new User();
        $user->password_reset_token = 'token_reset';
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $foundModel = User::findByPasswordResetToken('token_de_reset');

        //Verificação
        $this->assertInstanceOf(User::class, $foundModel);

        $this->assertEquals('token_reset', $foundModel->password_reset_token);
        $this->assertEquals(User::STATUS_ACTIVE, $foundModel->status);
    }


    public function testFindByUsername(){

        //Tem de ser configuraod de yii2 para testes
        //atenção e alterar de acordo os diretorios de cada utilizador!!
        $config = require 'C:\wamp64\www\new_project\LusitaniaTravel\common\config\test.php';
        new \yii\console\Application($config);

        //Cria uma base de dados em memória e guarda o valor
        $username = 'username1';
        $user = new User();
        $user->username = $username;
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $foundModel = User::findByUsername($username);

        //Verificação
        $this->assertInstanceOf(User::class, $foundModel);

        $this->assertEquals($username, $foundModel->username);
        $this->assertEquals(User::STATUS_ACTIVE, $foundModel->status);
    }

    public function testFindIdentityByAccessTokenThrowsException(){

        $user = new User();

        $this->expectException(\yii\base\NotSupportedException::class);
        $user::findIdentityByAccessToken('token_exemplo');
    }

    public function testFindIdentity()
    {
        //Tem de ser configuraod de yii2 para testes
        //atenção e alterar de acordo os diretorios de cada utilizador!!
        $config = require 'C:\wamp64\www\new_project\LusitaniaTravel\common\config\test.php';
        new \yii\console\Application($config);

        //Atribui o ID = 1
        $id = 1;
        $user = new User();
        $user->id = $id;
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        $foundModel = User::findIdentity($id);
        $this->assertInstanceOf(User::class, $foundModel);

        // Verifica se os atributos do modelo correspondem ao que se espera
        $this->assertEquals($id, $foundModel->id);
        $this->assertEquals(User::STATUS_ACTIVE, $foundModel->status);
    }


}
