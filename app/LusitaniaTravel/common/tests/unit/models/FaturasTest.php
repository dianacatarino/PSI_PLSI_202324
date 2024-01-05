<?php

namespace common\tests\unit\models;

use common\models\Reserva;
use common\models\Fatura;
use backend\models\Empresa;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use backend\models\ReservaSearch;
use yii\db\ActiveQuery;

/**
 *
 * FaturasTestes test
 */

class FaturasTest extends \Codeception\Test\Unit {

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */
     public function testGetReserva(){

         $fatura = new Fatura();
         $reservaQuery = $fatura->getReserva();

         $this->assertInstanceOf(ActiveQuery::class, $reservaQuery);
     }

     public function getEmpresa(){

         $fatura = new Fatura();
         $empresaQuery = $fatura->getEmpresa();

         $this->assertInstanceOf(ActiveQuery::class, $empresaQuery);
     }


     public function testGetLinhasfaturas(){

         $fatura = new Fatura();
         $linhasfaturasQuery = $fatura->getLinhasfaturas();

         $this->assertInstanceOf(ActiveQuery::class, $linhasfaturasQuery);

     }
}