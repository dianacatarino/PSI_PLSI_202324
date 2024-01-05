<?php

namespace common\tests\unit\models;

use Yii;
use common\models\Reserva;
use common\models\Confirmacao;
use common\models\User;
use frontend\models\Carrinho;
use common\models\Fornecedor;

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

    public function testGetCliente(){

        $carrinho = new Carrinho();

        //"Cria" um novo user em que o role é Cliente
        $cliente = new User(['role' => 'cliente']);

        //Ligação entre as duas tabelas
        $carrinho->cliente_id = $cliente;

        $result = $carrinho->getCliente();

        $this->assertEquals($cliente , $result);

        $this->tester->seeInDatabase('carrinho'); //confirmar
    }


    public function testGetFornecedor(){

        $carrinho = new Carrinho();

        //"Cria" um novo user em que o role é Fornecedor
        $fornecedor = new Fornecedor();

        //Ligação entre as tabelas
        $carrinho->cliente_id = $fornecedor;

        //O método é aplicado
        $result = $carrinho->getFornecedor();

        //Comparação do resultado da função com o valor certo
        $this->assertEquals($fornecedor , $result);

        $this->tester->seeInDatabase('carrinho'); //confirmar

    }

    public function testGetReserva(){

        $carrinho = new Carrinho();

        //Preenche uma nova reserva
        $reserva = new Reserva(['tipo' => 'presencial' , 'checkin' => '2024-05-13' ,
            'checkout' => '2024-05-15' , 'numeroquartos' => 1 , 'numeroclientes' => 2 ,
            'valor' => 45.00]);

        //Ligação das tabelas
        $carrinho->reserva_id = $reserva;

        //Devolve de acordo com o método getReserva()
        $result = $carrinho->getReserva();

        //Compara resultado dado com a do método
        $this->assertEquals($reserva , $result);

        $this->tester->seeInDatabase('carrinho'); //confirmar
    }

    public function testGetConfirmacao(){

        $carrinho = new Carrinho();

        //Nova confirmação
        $confirmacao = new Confirmacao(['estado' => 'Confirmado' , 'dataconfirmacao' => '2023-12-22']);

        //Ligação da nova tabela
        $carrinho->confirmacoes = $confirmacao; //corrigir por nome correto

        //Calculo através da função da classe
        $result = $carrinho->getConfirmacao();

        $this->assertEquals($confirmacao , $result);

        $this->tester->seeInDatabase('carrinho'); //confirmar

    }


}