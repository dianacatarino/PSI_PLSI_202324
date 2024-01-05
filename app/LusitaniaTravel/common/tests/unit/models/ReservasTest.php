<?php

namespace common\tests\unit\models;

use common\fixtures\FornecedorFixture;
use common\fixtures\ReservaFixture;
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
    public function _fixtures()
    {
        return [
            'reserva' => [
                'class' => ReservaFixture::class,
                'dataFile' => codecept_data_dir() . 'reserva.php'
            ]
        ];
    }

    public function testCriarReservaComDadosCorretos()
    {
        // Instanciar as classes de teste relevantes
        $usersTest = new UsersTest();
        $alojamentosTest = new AlojamentosTest();

        // Chamar os métodos de teste necessários
        $clienteId = $usersTest->testCriarUserComDadosCorretos();
        $funcionarioId = $usersTest->testCriarFuncionarioComDadosCorretos();
        $fornecedorId = $alojamentosTest->testCriarFornecedorComDadosCorretos();

        $reserva = new Reserva([
            'tipo' => 'Online',
            'checkin' => '2024-01-01',
            'checkout' => '2024-01-10',
            'numeroquartos' => 3,
            'numeroclientes' => 5,
            'valor' => 500.00,
            'cliente_id' => $clienteId,
            'funcionario_id' => $funcionarioId,
            'fornecedor_id' => $fornecedorId,
        ]);

        $this->assertTrue($reserva->validate(), 'Reserva is valid');
        $this->assertTrue($reserva->save(), 'Reserva is saved');

        $reservaId = Reserva::find()->where(['tipo' => 'Online'])->one()->id;

        return $reservaId;
    }

    public function testCriarReservaComDadosIncorretos()
    {
        $reserva = new Reserva([
            'tipo' => null,
            'checkin' => '2024-01-01',
            'checkout' => '2024-01-10',
            'numeroquartos' => -1,
            'numeroclientes' => 10,
            'valor' => 500.00,
            'cliente_id' => 1,
            'funcionario_id' => 2,
            'fornecedor_id' => 3,
        ]);

        $this->assertFalse($reserva->validate(), 'Reserva is not valid');
        $this->assertFalse($reserva->save(), 'Reserva is not saved');
    }

    public function testMostrarReserva()
    {
        $this->testCriarReservaComDadosCorretos();

        $reserva = Reserva::findOne(['tipo' => 'Online', 'checkin' => '2024-01-01', 'checkout' => '2024-01-10']);

        $this->assertNotNull($reserva, 'O registo deveria existir na BD');
    }

    public function testAtualizarReserva()
    {
        $this->testCriarReservaComDadosCorretos();

        $reserva = Reserva::findOne(['tipo' => 'Online', 'checkin' => '2024-01-01', 'checkout' => '2024-01-10']);

        $this->assertNotNull($reserva, 'O registo deveria existir na BD');

        if ($reserva !== null) {
            $reserva->tipo = 'Presencial';
            $this->assertTrue($reserva->save(), 'Deveria ser possível atualizar e salvar um registo na BD');
        }
    }

    public function testReservaAtualizada()
    {
        $this->testAtualizarReserva();

        // Find the updated record
        $reservaAtualizada = Reserva::findOne(['tipo' => 'Presencial', 'checkin' => '2024-01-01', 'checkout' => '2024-01-10']);

        // Assert that the updated record exists
        $this->assertNotNull($reservaAtualizada, 'O registo atualizado deveria existir na BD');
    }

    public function testApagarReserva()
    {
        $this->testCriarReservaComDadosCorretos();

        $reserva = Reserva::findOne(['tipo' => 'Online', 'checkin' => '2024-01-01', 'checkout' => '2024-01-10']);

        $this->assertNotNull($reserva, 'O registo deveria existir na BD');

        if ($reserva !== null) {
            $reservaId = $reserva->id;

            $reserva->delete();
            $this->assertNull(Reserva::findOne($reservaId), 'O registo deveria ser apagado da BD');
        }
    }

    public function testReservaNaoExiste()
    {
        $reservaDeletada = Reserva::findOne(['tipo' => 'Online', 'checkin' => '2024-01-01', 'checkout' => '2024-01-10']);

        $this->assertNull($reservaDeletada, 'O registo não deveria existir na BD após ser apagado');
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

    /*public function testSelectAlojamentos()
    {
        $reserva = new Reserva();
        $result = $reserva::selectAlojamentos();

        // Verifique se o resultado é um array
        $this->assertTrue(is_array($result), 'Result should be an array');

        // Verifique se o array não está vazio
        $this->assertNotEmpty($result, 'Result should not be empty');
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
    }*/

    public function testGetProfile()
    {
        $reserva = new Reserva();
        $profileQuery = $reserva->getProfile();

        $this->assertInstanceOf(ActiveQuery::class, $profileQuery);
    }

}
