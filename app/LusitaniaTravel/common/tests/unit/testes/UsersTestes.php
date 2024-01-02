<?php

namespace common\tests\unit\testes;

use common\models\Profile;
use common\models\User;

/**
 *
 * UserTestes test
 */

class UsersTestes extends \Codeception\Test\Unit {

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
        //TERMINAR
    }

}
