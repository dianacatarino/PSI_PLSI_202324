<?php

namespace common\tests\unit\models;

use common\models\Profile;
use common\models\Reserva;
use common\models\User;
use common\models\Confirmacao;
use common\models\Fornecedor;
use common\models\Fatura;
use common\models\Linhasreserva;


use backend\models\ReservaSearch;
use yii\db\ActiveQuery;

/**
 *
 * ReservasTestes test
 */

class ReservasTest extends \Codeception\Test\Unit {

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */

    public function testCreateReservaWithValidData()
    {
        $reserva = new Reserva([
            'tipo' => 'Online',
            'checkin' => '2022-01-01',
            'checkout' => '2022-01-05',
            'numeroquartos' => 2,
            'numeroclientes' => 4,
            'valor' => 500.00,
            'cliente_id' => 1, // ID de um cliente válido
            'funcionario_id' => 2, // ID de um funcionário válido
            'fornecedor_id' => 3, // ID de um fornecedor válido
        ]);

        $this->assertTrue($reserva->validate(), 'Reserva should be valid');
        $this->assertTrue($reserva->save(), 'Reserva should be saved');
    }

    public function testGetCliente()
    {
        $reserva = new Reserva();
        $clienteQuery = $reserva->getCliente();

        $this->assertInstanceOf(ActiveQuery::class, $clienteQuery);
    }

    public function testGetFuncionario()
    {
        $reserva = new Reserva();
        $funcionarioQuery = $reserva->getFuncionario();

        $this->assertInstanceOf(ActiveQuery::class, $funcionarioQuery);
    }

    public function testGetFornecedor()
    {
        $reserva = new Reserva();
        $fornecedorQuery = $reserva->getFornecedor();

        $this->assertInstanceOf(ActiveQuery::class, $fornecedorQuery);
    }

    public function testGetConfirmacao()
    {
        $reserva = new Reserva();
        $confirmacoesQuery = $reserva->getConfirmacoes();

        $this->assertInstanceOf(ActiveQuery::class, $confirmacoesQuery);
    }

    public function testGetLinhasreservas()
    {
        $reserva = new Reserva();
        $linhasreservasQuery = $reserva->getLinhasreservas();

        $this->assertInstanceOf(ActiveQuery::class, $linhasreservasQuery);
    }

    public function testSelectAlojamentos()
    {
        $result = Reserva::selectAlojamentos();

        // Ensure the result is an array and not empty
        $this->assertTrue(is_array($result) && !empty($result));
    }

    public function testSelectClientes()
    {
        $result = Reserva::selectClientes();

        // Ensure the result is an array and not empty
        $this->assertTrue(is_array($result) && !empty($result));
    }

    public function testSelectFuncionarios()
    {
        $result = Reserva::selectFuncionarios();

        // Ensure the result is an array and not empty
        $this->assertTrue(is_array($result) && !empty($result));
    }

    public function testGetProfile()
    {
        $reserva = new Reserva();
        $profileQuery = $reserva->getProfile();

        $this->assertInstanceOf(ActiveQuery::class, $profileQuery);
    }

}
