<?php

namespace common\tests\unit\testes;

use common\models\Profile;
use common\models\Reserva;
use common\models\User;
use common\models\Confirmacao;
use common\models\Fornecedor;
use common\models\Fatura;
use common\models\Linhasreserva;


use backend\models\ReservaSearch;

/**
 *
 * ReservasTestes test
 */

class ReservasTestes extends \Codeception\Test\Unit {

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */

    public function testGetReserva(){

        $reservas = new Reserva();

        //Preenche uma nova reserva
        $reserva = new Reserva(['tipo' => 'presencial' , 'checkin' => '2024-05-13' ,
            'checkout' => '2024-05-15' , 'numeroquartos' => 1 , 'numeroclientes' => 2 ,
            'valor' => 45.00]);

        //Ligação das tabelas
        $reservas->reserva_id = $reserva;

        //Devolve de acordo com o método getReserva()
        $result = $reservas->getReserva();

        //Compara resultado dado com a do método
        $this->assertEquals($reserva , $result);

        $this->tester->seeInDatabase('reservas'); //confirmar
    }

    public function testGetCliente(){

        $reserva = new Reserva();

        //"Cria" um novo user em que o role é Cliente
        $cliente = new User(['role' => 'cliente']);

        //Ligação entre as duas tabelas
        $reserva->cliente_id = $cliente;

        $result = $reserva->getCliente();

        $this->assertEquals($cliente , $result);

        $this->tester->seeInDatabase('reservas'); //confirmar
    }

    public function testGetFuncionario(){

        $reserva = new Reserva();

        //"Cria" um novo user em que o role é Cliente
        $funcionario = new User(['role' => 'funcionario']);

        //Ligação entre as duas tabelas
        $reserva->cliente_id = $funcionario;

        $result = $reserva->getCliente();

        $this->assertEquals($funcionario , $result);

        $this->tester->seeInDatabase('reservas'); //confirmar
    }

    public function testGetFornecedor(){

        $reserva = new Reserva();

        //"Cria" um novo user em que o role é Fornecedor
        $fornecedor = new Fornecedor();

        //Ligação entre as tabelas
        $reserva->fornecedor = $fornecedor;

        //O método é aplicado
        $result = $reserva->getFornecedor();

        //Comparação do resultado da função com o valor certo
        $this->assertEquals($fornecedor , $result);

        $this->tester->seeInDatabase('reservas'); //confirmar

    }

    public function testGetConfirmacao(){

        $reserva = new Reserva();

        //Nova confirmação
        $confirmacao = new Confirmacao(['estado' => 'Confirmado' , 'dataconfirmacao' => '2023-12-22']);

        //Ligação da nova tabela
        $reserva->confirmacoes = $confirmacao; //corrigir por nome correto

        //Calculo através da função da classe
        $result = $reserva->getConfirmacao();

        $this->assertEquals($confirmacao , $result);

        $this->tester->seeInDatabase('reservas'); //confirmar

    }

    public function testGetLinhasreservas(){

        $fatura = new Fatura();

        //Nova Linha-fatura
        $linhasreservas = new Linhasfatura();

        //Associação das tabelas
        $fatura->reserva_id = $linhasreservas;

        $result = $fatura->getLinhasreservas();

        $this->assertEquals($linhasreservas , $result);

    }

    public function testSelectAlojamentos(){

        $fornecedor = $this->getMockBuilder(Fornecedor::class)
            ->setMethods(['find'])
            ->getMock();

        $alojamentosDados = [
            ['id' => 1, 'responsavel' => 'Fornecedor 1', 'tipo' => 'Hotel',
                'nome_alojamento' => 'Alojamento 1' , 'localizacao' => 'Leiria' ,
                'acomodacoes' => 'Cama Casal'],

            ['id' => 2, 'responsavel' => 'Fornecedor 2', 'tipo' => 'Alojamento Local',
                'nome_alojamento' => 'Alojamento 2' , 'localizacao' => 'Lisboa' ,
                'acomodacoes' => 'Cama Solteiro'],
        ];

        $fornecedor->method('find')->willReturn($fornecedor);
        $fornecedor->expects($this->once())
            ->method('select')
            ->with(['nome_alojamento', 'id'])
            ->willReturn($fornecedor);

        $fornecedor->expects($this->once())
            ->method('indexBy')
            ->with('id')
            ->willReturn($fornecedor);

        $fornecedor->expects($this->once())
            ->method('column')
            ->willReturn(array_column($alojamentosDados, 'nome_alojamento', 'id'));

        // Substituir o método estático 'find()' da classe Fornecedor pelo mock
        Reserva::method('find')->willReturn($fornecedor);

        $result = Reserva::selectAlojamentos();

        $this->assertEquals(['Alojamento 1', 'Alojamento 2'], $result);

    }

    public function testSelectClientes(){

        $profile = $this->getMockBuilder(Profile::class)
            ->setMethods(['find'])
            ->getMock();

        // Dados simulados de clientes
        $clientesDados = [
            ['user_id' => 1, 'name' => 'Cliente A', 'role' => 'cliente'],
            ['user_id' => 2, 'name' => 'Cliente B', 'role' => 'cliente'],
        ];

        // Definir o comportamento do método find() para retornar os dados simulados
        $profile->method('find')->willReturn($profile);
        $profile->expects($this->once())
            ->method('select')
            ->with(['name', 'user_id'])
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('where')
            ->with(['role' => 'cliente'])
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('indexBy')
            ->with('user_id')
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('column')
            ->willReturn(array_column($clientesDados, 'name', 'user_id'));

        // Substituir o método estático 'find()' da classe Profile pelo mock
        Reserva::method('find')->willReturn($profile);

        $result = Reserva::selectClientes();

        $this->assertEquals(['Cliente A', 'Cliente B'], $result);
    }

    public function testSelectFuncioanrios(){

        $profile = $this->getMockBuilder(Profile::class)
            ->setMethods(['find'])
            ->getMock();

        // Dados simulados de funcionários
        $funcionariosDados = [
            ['user_id' => 1, 'name' => 'Funcionário A', 'role' => 'funcionario'],
            ['user_id' => 2, 'name' => 'Funcionário B', 'role' => 'funcionario'],
        ];

        // Definir o comportamento do método find() para retornar os dados simulados
        $profile->method('find')->willReturn($profile);
        $profile->expects($this->once())
            ->method('select')
            ->with(['name', 'user_id'])
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('where')
            ->with(['role' => 'funcionario'])
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('indexBy')
            ->with('user_id')
            ->willReturn($profile);

        $profile->expects($this->once())
            ->method('column')
            ->willReturn(array_column($funcionariosDados, 'name', 'user_id'));

        // Substituir o método estático 'find()' da classe Profile pelo mock
        Reserva::method('find')->willReturn($profile);

        $result = Reserva::selectFuncionarios();

        // Verificar se o resultado é o esperado
        $this->assertEquals(['Funcionário A', 'Funcionário B'], $result);
    }

    public function testGetProfile()
    {
        // Criação de um mock para a classe Profile
        $profile = $this->getMockBuilder(Profile::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Simulação do retorno para o método hasOne() com o mock de Profile
        $reserva = $this->getMockBuilder(Reserva::class)
            ->setMethods(['hasOne'])
            ->getMock();

        $reserva->expects($this->once())
            ->method('hasOne')
            ->with(
                $this->equalTo(Profile::class),
                $this->equalTo(['id' => 'profile_id'])
            )
            ->willReturn($profile);

        // Chamar o método getProfile() para ativar a relação
        $result = $reserva->getProfile();

        // Verificar se a relação retornada é do tipo esperado (hasOne)
        $this->assertInstanceOf(\yii\db\ActiveQuery::class, $result);
    }


    public function testGetReservaDetails(){

        // Criação de mocks para Fornecedor, Cliente e Profile
        $fornecedor = $this->getMockBuilder(Fornecedor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $fornecedor->nome = 'Fornecedor X';


        $profile = $this->getMockBuilder(Profile::class)
            ->disableOriginalConstructor()
            ->getMock();
        $profile->name = 'Cliente Y';


        $cliente = $this->getMockBuilder(Profile::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cliente->profile = $profile;

        // Criação de um mock para a classe Reserva
        $reserva = $this->getMockBuilder(Reserva::class)
            ->setMethods(['getFornecedor', 'getCliente'])
            ->getMock();

        //Aqui são especificados os comportamentos esperados
        $reserva->expects($this->once())
            ->method('getFornecedor')
            ->willReturn($fornecedor);

        $reserva->expects($this->once())
            ->method('getCliente')
            ->willReturn($cliente);

        $reservaDetalhes = $reserva->getReservaDetails();


        $resultadosEsperados = [
            'fornecedor' => 'Fornecedor X',
            'cliente' => 'Cliente Y',
        ];

        $this->assertEquals($resultadosEsperados, $reservaDetalhes);
    }

}
