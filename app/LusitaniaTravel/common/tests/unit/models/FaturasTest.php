<?php

namespace common\tests\unit\testes;

use common\models\Reserva;
use common\models\Fatura;
use backend\models\Empresa;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use backend\models\ReservaSearch;

/**
 *
 * FaturasTestes test
 */

class FaturasTestes extends \Codeception\Test\Unit {

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */
     public function testGetReserva(){

         $fatura = new Fatura();

         $reserva = new Reserva(['tipo' => 'online' , 'checkin' => '2024-03-31' ,
             'checkout' => '2024-04-03' , 'numeroquartos' => 3 , 'numeroclientes' => 5 ,
             'valor' => 166.00]);

         $fatura->reserva = $reserva;

         $result = $fatura->getReserva();

         $this->assertEquals($reserva , $result);

         $this->tester->seeInDatabase('faturas'); //confirmar

     }

     public function getEmpresa(){

         //representando a classe que possui a relação hasOne
         $fatura = new Fatura();

         $empresa = new Empresa();

         $fatura->empresa_id = $empresa->id;

         // Obtém a empresa usando o método getEmpresa
         $result = $fatura->getEmpresa();

         // Verifica se a empresa retornada é a mesma que foi associada
         $this->assertEquals($empresa, $result);
     }

     /*public function testGetFornecedor(){

         $fatura = new Fatura();

         //"Cria" um novo user em que o role é Fornecedor
         $fornecedor = new Fornecedor();

         //Ligação entre as tabelas
         $fatura->reserva_id = $fornecedor;

         //O método é aplicado
         $result = $fatura->getFornecedor();

         //Comparação do resultado da função com o valor certo
         $this->assertEquals($fornecedor , $result);

         $this->tester->seeInDatabase('carrinho'); //confirmar
     }*/

     public function testGetLinhasfaturas(){

         $fatura = new Fatura();

         //Nova Linha-fatura
         $linhasfaturas = new Linhasfatura();

         //Associação das tabelas
         $fatura->linhasfaturas = $linhasfaturas;

         $result = $fatura->getLinhasfaturas();

         $this->assertEquals($linhasfaturas , $result);

     }

     public function testSelectReservas(){ //REVER

         // createMock: biblioteca PHP para simular objetos, neste caso a fatura
         $reserva1 = $this->createMock(ReservaSearch::class);
         $reserva1->method('getId')->willReturn(1); // Supondo que existe uma função getId na classe Reserva

         $reserva2 = $this->createMock(Reserva::class);
         $reserva2->method('getId')->willReturn(2);

         // Mock de Reserva::find()
         $reservaFindMock = $this->getMockBuilder(Reserva::class)
             ->setMethods(['select', 'indexBy', 'column'])
             ->getMock();

         // Definição dos retornos esperados dos métodos
         $reservaFindMock->expects($this->once())
             ->method('select')
             ->with(['id'])
             ->willReturnSelf(); // Retorna a própria instância para encadear métodos

         $reservaFindMock->expects($this->once())
             ->method('indexBy')
             ->with('id')
             ->willReturnSelf();

         $reservaFindMock->expects($this->once())
             ->method('column')
             ->willReturn([$reserva1->getId(), $reserva2->getId()]);

         // Substitui o método find() por um mock
         $this->getMockBuilder(SuaClasse::class)
             ->setMethods(['find']) // Substitua por qualquer método estático usado para acessar o find() das Reservas
             ->getMock()
             ->method('find')
             ->willReturn($reservaFindMock);

         // Chama o método selectReservas da sua classe
         $result = SuaClasse::selectReservas(); // Substitua SuaClasse pela classe onde está o método

         // Verifica se o resultado retornado é o esperado
         $this->assertEquals([1, 2], $result); // Verifique se os IDs das reservas são os esperados

     }
}