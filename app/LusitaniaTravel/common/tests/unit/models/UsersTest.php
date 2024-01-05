<?php

namespace common\tests\unit\models;

use common\fixtures\ProfileFixture;
use common\fixtures\UserFixture;
use common\models\Profile;
use common\models\User;
use Yii;
use yii\db\ActiveQuery;

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
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'profile' => [
                'class' => ProfileFixture::class,
                'dataFile' => codecept_data_dir() . 'profile.php'
            ],
        ];
    }

    public function testCriarUserComDadosCorretos()
    {
        // Dados de exemplo para criar um usuário
        $userData = [
            'username' => 'novouser',
            'email' => 'novouser@email.com',
            'password' => 'novasenha',
        ];

        // Dados de exemplo para criar um perfil
        $profileData = [
            'name' => 'Novo User',
            'mobile' => '123456789',
            'street' => 'Rua Exemplo',
            'locale' => 'Cidade',
            'postalCode' => '12345',
            'role' => 'cliente', // Defina o papel desejado
        ];

        $user = new User($userData);

        // Verificar se o usuário é válido antes de salvar
        $this->assertTrue($user->validate(), 'User é válido');

        // Salvar o usuário no banco de dados
        $this->assertTrue($user->save(), 'User foi salvo');

        // Criar uma instância de Profile e preenchê-la com os dados
        $profile = new Profile($profileData);

        // Vincular o perfil ao usuário após salvar
        $user->link('profile', $profile);

        // Verificar se o perfil é válido antes de salvar
        $this->assertTrue($profile->validate(), 'Perfil é válido');

        // Verificar se o ID do perfil foi definido após salvar
        $this->assertNotNull($profile->id, 'ID do perfil foi definido após salvar');

        // Recuperar o usuário do banco de dados para garantir que foi salvo corretamente
        $savedUser = User::findOne($user->id);

        // Verificar se o usuário foi recuperado corretamente
        $this->assertInstanceOf(User::class, $savedUser, 'User foi recuperado corretamente');

        // Verificar se a relação entre o usuário e o perfil foi recuperada corretamente
        $this->assertInstanceOf(Profile::class, $savedUser->profile, 'Relação entre user e perfil foi recuperada corretamente');

        $clienteId = User::find()->where(['username' => 'novouser'])->one()->id;

        return $clienteId;
    }

    public function testCriarFuncionarioComDadosCorretos()
    {
        // Dados de exemplo para criar um funcionário
        $funcionarioData = [
            'username' => 'novofuncionario',
            'email' => 'novofuncionario@email.com',
            'password' => 'novasenha',
        ];

        // Dados de exemplo para criar um perfil de funcionário
        $funcionarioProfileData = [
            'name' => 'Novo Funcionário',
            'mobile' => '987654321',
            'street' => 'Rua Exemplo Funcionário',
            'locale' => 'Cidade Funcionário',
            'postalCode' => '54321',
            'role' => 'funcionario', // Defina o papel para funcionário
        ];

        $funcionario = new User($funcionarioData);

        // Verificar se o funcionário é válido antes de salvar
        $this->assertTrue($funcionario->validate(), 'Funcionário é válido');

        // Salvar o funcionário no banco de dados
        $this->assertTrue($funcionario->save(), 'Funcionário foi salvo');

        // Criar uma instância de Profile e preenchê-la com os dados
        $funcionarioProfile = new Profile($funcionarioProfileData);

        // Vincular o perfil ao funcionário após salvar
        $funcionario->link('profile', $funcionarioProfile);

        // Verificar se o perfil do funcionário é válido antes de salvar
        $this->assertTrue($funcionarioProfile->validate(), 'Perfil do funcionário é válido');

        // Verificar se o ID do perfil do funcionário foi definido após salvar
        $this->assertNotNull($funcionarioProfile->id, 'ID do perfil do funcionário foi definido após salvar');

        // Recuperar o funcionário do banco de dados para garantir que foi salvo corretamente
        $savedFuncionario = User::findOne($funcionario->id);

        // Verificar se o funcionário foi recuperado corretamente
        $this->assertInstanceOf(User::class, $savedFuncionario, 'Funcionário foi recuperado corretamente');

        // Verificar se a relação entre o funcionário e o perfil foi recuperada corretamente
        $this->assertInstanceOf(Profile::class, $savedFuncionario->profile, 'Relação entre funcionário e perfil foi recuperada corretamente');

        $funcionarioId = User::find()->where(['username' => 'novofuncionario'])->one()->id;

        return $funcionarioId;
    }

    public function testCriarUserComDadosIncorretos()
    {
        // Dados de exemplo para criar um usuário inválido (por exemplo, sem email)
        $userData = [
            'username' => 'novouser',
            'password' => 'novasenha',
            'email' => null,
        ];

        // Dados de exemplo para criar um perfil inválido (por exemplo, sem nome)
        $invalidProfileData = [
            'name' => null,
            'mobile' => '123456789',
            'street' => 'Rua Exemplo',
            'locale' => 'Cidade',
            'postalCode' => '12345',
            'role' => 'cliente',
        ];

        // Tentar criar um usuário com dados inválidos
        $user = new User($userData);

        // Verificar se o usuário é inválido antes de salvar
        $this->assertFalse($user->validate(), 'User é inválido');

        // Verificar se o usuário não pode ser salvo com dados inválidos
        $this->assertFalse($user->save(), 'User não deve ser salvo com dados inválidos');

        // Verificar se o perfil não foi vinculado ao usuário
        $this->assertNull($user->profile, 'Perfil não deve ser vinculado a um usuário inválido');

        // Tentar vincular um perfil inválido ao usuário
        $profile = new Profile($invalidProfileData);

        // Verificar se o perfil é inválido antes de vincular
        $this->assertFalse($profile->validate(), 'Perfil é inválido');

        // Verificar se o perfil não foi vinculado ao usuário
        $this->assertNull($user->link('profile', $profile), 'Perfil não deve ser vinculado a um usuário inválido');
    }

    public function testMostrarUser()
    {
        // Assuming you have a method like testCriarUserComDadosCorretos to create a user record
        $this->testCriarUserComDadosCorretos();

        // Replace 'username' and 'email' with the values you used to create the user in testCriarUserComDadosCorretos
        $user = User::findOne(['username' => 'novouser', 'email' => 'novouser@email.com']);

        $this->assertNotNull($user, 'O registro deveria existir na BD');
    }

    public function testAtualizarUserComProfile()
    {
        // Criar um usuário de exemplo
        $user = new User([
            'username' => 'updateuser',
            'email' => 'updateuser@email.com',
            'password' => 'updatesenha',
        ]);

        $this->assertTrue($user->validate(), 'User é válido');

        // Salvar o usuário no banco de dados
        $this->assertTrue($user->save(), 'User foi salvo');

        // Criar um perfil para o usuário
        $profileData = [
            'name' => 'Nome Para Atualizar',
            'mobile' => '987654321',
            'street' => 'Rua Para Atualizar',
            'locale' => 'Cidade Atualizada',
            'postalCode' => '54321',
            'role' => 'admin', // Atualizar o papel desejado
        ];

        $profile = new Profile($profileData);
        $user->link('profile', $profile);

        // Atualizar o nome do perfil
        $profile->name = 'Nome Atualizado';
        $profile->save();

        // Recuperar o usuário do banco de dados
        $updatedUser = User::findOne($user->id);

        // Verificar se o perfil foi atualizado corretamente
        $this->assertEquals('Nome Atualizado', $updatedUser->profile->name, 'Nome do perfil foi atualizado corretamente');
    }

    public function testVerificarUserAtualizado()
    {
        // Executar o teste de atualização do usuário
        $this->testAtualizarUserComProfile();

        // Encontrar o registro atualizado
        $usuarioAtualizado = User::findOne(['username' => 'updateuser', 'email' => 'updateuser@email.com']);

        // Verificar se o registro atualizado existe
        $this->assertNotNull($usuarioAtualizado, 'O usuário atualizado deveria existir na BD');

        // Verificar se o nome do perfil foi atualizado corretamente
        $this->assertEquals('Nome Atualizado', $usuarioAtualizado->profile->name, 'Nome do perfil foi atualizado corretamente');
    }


    public function testApagarUserComProfile()
    {
        // Criar um usuário de exemplo
        $user = new User([
            'username' => 'deleteuser',
            'email' => 'deleteuser@email.com',
            'password' => 'deletesenha',
        ]);

        $this->assertTrue($user->validate(), 'User é válido');

        // Salvar o usuário no banco de dados
        $this->assertTrue($user->save(), 'User foi salvo');

        // Criar um perfil para o usuário
        $profileData = [
            'name' => 'Nome Para Excluir',
            'mobile' => '123456789',
            'street' => 'Rua Para Excluir',
            'locale' => 'Cidade Para Excluir',
            'postalCode' => '98765',
            'role' => 'cliente',
        ];

        $profile = new Profile($profileData);

        // Salvar o perfil no banco de dados antes de vincular
        $this->assertTrue($profile->save(), 'Perfil foi salvo');

        // Vincular o perfil ao usuário após salvar
        $user->link('profile', $profile);

        // Verificar se o usuário foi salvo corretamente
        $savedUser = User::findOne($user->id);
        $this->assertInstanceOf(User::class, $savedUser, 'User foi recuperado corretamente');

        // Verificar se o perfil foi vinculado corretamente
        $this->assertInstanceOf(Profile::class, $savedUser->profile, 'Perfil foi vinculado corretamente ao usuário');

        // Excluir o usuário (deveria excluir o perfil associado automaticamente)
        $savedUser->delete();

        // Verificar se o usuário foi excluído corretamente
        $this->assertNull(User::findOne($savedUser->id), 'User foi corretamente excluído do banco de dados');

        // Verificar se o perfil foi excluído corretamente
        $this->assertNull(Profile::findOne($profile->id), 'Perfil foi corretamente excluído do banco de dados');
    }


    public function testGetProfile(){

        $user = new User();
        $userQuery = $user->getProfile();

        $this->assertInstanceOf(ActiveQuery::class, $userQuery);
    }

    public function testRemovePasswordResetToken(){

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

    public function testGeneratePasswordResetToken(){

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

        // Criar uma instância do modelo User
        $user = new User();

        // Definir a chave de autenticação (auth_key) desejada
        $authKey = 'chave_autenticacao';
        $user->auth_key = $authKey;

        // Chamar diretamente o método da instância
        $isValidAuthKey = $user->validateAuthKey($authKey);

        // Verificar se a chave de autenticação é válida
        $this->assertTrue($isValidAuthKey);
    }

    public function testGetAuthKey(){

        $expectedAuthKey = 'chave_autenticacao';

        $user = new User();

        $user->auth_key = $expectedAuthKey;
        $authKey = $user->getAuthKey();
        $this->assertEquals($expectedAuthKey, $authKey);
    }

    public function testGetId()
    {
        // Criar uma instância do modelo User
        $user = new User();

        // Definir a chave primária esperada
        $chavePrimariaEsperada = 1;

        // Atribuir manualmente um valor à chave primária
        $user->id = $chavePrimariaEsperada;

        // Obter a chave primária usando o método getId
        $chavePrimaria = $user->getId();

        // Verificar se a chave primária é a esperada
        $this->assertEquals($chavePrimariaEsperada, $chavePrimaria);
    }

    /*public function testIsPasswordResetTokenValid(){

        // Criar uma instância do modelo User
        $user = new User();

        // Definir tokens válidos e expirados
        $tokenValido = 'token_valido';
        $tokenExpirado = 'token_expirado';

        // Definir timestamps para meio hora no passado e futuro
        $timestampValido = time() + 1800;
        $timestampExpirado = time() - 1800;

        // Simular configuração quando expirado
        Yii::$app->params['user.passwordResetTokenExpire'] = 1800;

        // Testar com token vazio
        $this->assertFalse(User::isPasswordResetTokenValid(''));

        // Testar com token válido e expirado
        $tokenValidoExpirado = $tokenValido . '_' . $timestampExpirado;
        $this->assertFalse(User::isPasswordResetTokenValid($tokenValidoExpirado), "O token {$tokenValidoExpirado} deveria ser inválido");

        $tokenValidoAtual = $tokenValido . '_' . $timestampValido;
        $this->assertTrue(User::isPasswordResetTokenValid($tokenValidoAtual), "O token {$tokenValidoAtual} deveria ser válido");
    }*/


    public function testFindByVerificationToken(){

        // Criar uma instância do modelo User
        $user = new User();
        $user->verification_token = 'token_verificacao';
        $user->status = User::STATUS_INACTIVE;
        $user->save();

        // Buscar o modelo pelo token de verificação
        $foundModel = User::findByVerificationToken('token_verificacao');

        // Verificar se a instância é da classe esperada
        $this->assertInstanceOf(User::class, $foundModel);

        // Verificar os atributos obtidos da função
        $this->assertEquals('token_verificacao', $foundModel->verification_token);
        $this->assertEquals(User::STATUS_INACTIVE, $foundModel->status);
    }


    /*public function testFindByPasswordResetToken(){

        // Criar um modelo de exemplo no banco de dados em memória
        $user = new User();
        $user->password_reset_token = 'token_reset';
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        // Testar com token inválido
        $foundModelInvalid = User::findByPasswordResetToken('token_invalido');
        $this->assertNull($foundModelInvalid, "Deveria retornar nulo para token inválido");

        // Testar com token válido
        $tokenValid = 'token_reset_' . (time() + 1800);
        $foundModelValid = User::findByPasswordResetToken($tokenValid);

        // Verificar se a instância é da classe esperada
        $this->assertInstanceOf(User::class, $foundModelValid, "Deveria retornar uma instância de User para token válido");

        // Verificar os atributos obtidos da função
        $this->assertEquals('token_reset', $foundModelValid->password_reset_token);
        $this->assertEquals(User::STATUS_ACTIVE, $foundModelValid->status);
    }*/


    public function testFindByUsername(){

        // Criar uma base de dados em memória e guardar o valor
        $username = 'username1';
        $user = new User();
        $user->username = $username;
        $user->status = User::STATUS_ACTIVE;
        $user->save();

        // Buscar o modelo pelo nome de usuário
        $foundModel = User::findByUsername($username);

        // Verificar se a instância é da classe esperada
        $this->assertInstanceOf(User::class, $foundModel);

        // Verificar os atributos obtidos da função
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
        $id = 1;
        $user = new User();
        $user->id = $id;
        $user->status = User::STATUS_ACTIVE;

        // Salvar somente se o usuário não existir
        if (!User::find()->where(['id' => $id])->exists()) {
            $user->save();
        }

        $foundModel = User::findIdentity($id);
        $this->assertInstanceOf(User::class, $foundModel);

        // Verifica se os atributos do modelo correspondem ao que se espera
        $this->assertEquals($id, $foundModel->id);
        $this->assertEquals(User::STATUS_ACTIVE, $foundModel->status);
    }


}
