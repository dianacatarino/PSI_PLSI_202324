<?php

namespace common\tests\unit\models;

use common\fixtures\CarrinhoFixture;
use common\models\Reserva;
use frontend\models\Carrinho;
use yii\db\ActiveQuery;

/**
 * CarrinhoTestes test
 */

class CarrinhoTest extends \Codeception\Test\Unit {


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
                'class' => CarrinhoFixture::class,
                'dataFile' => codecept_data_dir() . 'carrinho.php'
            ]
        ];
    }

    public function testCriarCarrinhoComDadosCorretos()
    {
        // Instanciar as classes de teste relevantes
        $reservasTest = new ReservasTest();

        // Chamar os métodos de teste necessários para criar uma reserva
        $reservaId = $reservasTest->testCriarReservaComDadosCorretos();

        // Encontrar a reserva recém-criada para obter os IDs associados
        $reserva = Reserva::findOne($reservaId);

        // Verificar se a reserva foi encontrada
        $this->assertNotNull($reserva, 'A reserva deveria existir na BD');

        // Obter os IDs do fornecedor e do cliente associados à reserva
        $fornecedorId = $reserva->fornecedor_id;
        $clienteId = $reserva->cliente_id;

        // Agora você pode criar o carrinho com os IDs obtidos
        $carrinho = new Carrinho([
            'quantidade' => 2,
            'preco' => 50.00,
            'subtotal' => 100.00,
            'cliente_id' => $clienteId,
            'fornecedor_id' => $fornecedorId,
            'reserva_id' => $reservaId,
        ]);

        // Validar e salvar o carrinho
        $this->assertTrue($carrinho->validate(), 'Carrinho is valid');
        $this->assertTrue($carrinho->save(), 'Carrinho is saved');

        $carrinhoId = Carrinho::find()->where(['quantidade' => '2'])->one()->id;

        return $carrinhoId;
    }

    public function testCriarCarrinhoComDadosIncorretos()
    {
        $carrinho = new Carrinho([
            'quantidade' => -1,
            'preco' => 30.00,
            'subtotal' => 30.00,
            'cliente_id' => 2,
            'fornecedor_id' => 2,
            'reserva_id' => 2,
        ]);

        $this->assertFalse($carrinho->validate(), 'Carrinho não é válido');
        $this->assertFalse($carrinho->save(), 'Carrinho não foi salvo');
    }

    public function testMostrarCarrinho()
    {
        $this->testCriarCarrinhoComDadosCorretos();

        $carrinho = Carrinho::findOne(['quantidade' => 2]);

        $this->assertNotNull($carrinho, 'O registro deveria existir na BD');
    }

    /*public function testAtualizarEVerificarCarrinho()
    {
        // Criar um carrinho com dados corretos
        $carrinhoId = $this->testCriarCarrinhoComDadosCorretos();

        // Encontrar o carrinho pelo ID retornado
        $carrinho = Carrinho::findOne($carrinhoId);

        // Verificar se o carrinho foi encontrado
        $this->assertNotNull($carrinho, 'O carrinho deveria existir na BD');

        // Modificar os dados do carrinho
        $carrinho->quantidade = 3;

        // Atualizar e salvar o carrinho na BD
        $this->assertTrue($carrinho->save(), 'Deveria ser possível atualizar e salvar o carrinho na BD');

        // Encontrar o carrinho atualizado
        $carrinhoAtualizado = Carrinho::findOne($carrinhoId);

        // Verificar se o carrinho atualizado existe
        $this->assertNotNull($carrinhoAtualizado, 'O carrinho atualizado deveria existir na BD');

        // Verificar se a quantidade foi atualizada corretamente
        $this->assertEquals(3, $carrinhoAtualizado->quantidade, 'A quantidade do carrinho foi atualizada corretamente');
    }*/

    public function testApagarCarrinho()
    {
        $this->testCriarCarrinhoComDadosCorretos();

        $carrinho = Carrinho::findOne(['cliente_id' => 1]);

        $this->assertNotNull($carrinho, 'O registro deveria existir na BD');

        if ($carrinho !== null) {
            $carrinhoId = $carrinho->id;

            $carrinho->delete();
            $this->assertNull(Carrinho::findOne($carrinhoId), 'O registro deveria ser apagado da BD');
        }
    }

    public function testCarrinhoNaoExiste()
    {
        $carrinhoDeletado = Carrinho::findOne(['cliente_id' => 1]);

        if ($carrinhoDeletado !== null) {
            $carrinhoId = $carrinhoDeletado->id;

            $carrinhoDeletado->delete();

            $this->assertNull(Carrinho::findOne($carrinhoId), 'Falha ao apagar o carrinho: ');
        }
        // Additional assertion to ensure the deleted record does not exist
        $this->assertNull(Carrinho::findOne($carrinhoId), 'O registro não deveria existir na BD após ser apagado');
    }


    public function testGetCliente(){

        $carrinho = new Carrinho();
        $clienteQuery = $carrinho->getCliente();

        $this->assertInstanceOf(ActiveQuery::class, $clienteQuery);
    }


    public function testGetFornecedor(){

        $carrinho = new Carrinho();
        $fornecedoresQuery = $carrinho->getFornecedor();

        $this->assertInstanceOf(ActiveQuery::class, $fornecedoresQuery);
    }

    public function testGetReserva(){

        $carrinho = new Carrinho();
        $reservasQuery = $carrinho->getReserva();

        $this->assertInstanceOf(ActiveQuery::class, $reservasQuery);
    }

    public function testGetConfirmacao(){

        $carrinho = new Carrinho();
        $confirmacaoQuery = $carrinho->getConfirmacao();

        $this->assertInstanceOf(ActiveQuery::class, $confirmacaoQuery);

    }
}