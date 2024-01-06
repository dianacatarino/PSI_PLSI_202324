<?php

namespace common\tests\unit\models;

use common\fixtures\FaturaFixture;
use common\fixtures\ReservaFixture;
use common\models\Reserva;
use common\models\Fatura;
use backend\models\Empresa;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use backend\models\ReservaSearch;
use common\tests\fixtures\EmpresaFixture;
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
    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'fatura' => [
                'class' => FaturaFixture::class,
                'dataFile' => codecept_data_dir() . 'fatura.php',
            ],
            'reserva' => [
                'class' => ReservaFixture::class,
                'dataFile' => codecept_data_dir() . 'reserva.php',
            ],
        ];
    }

    public function testCriarFaturaComDadosCorretos()
    {
        $novaEmpresa = new Empresa([
            'sede' => 'Sede da Nova Empresa',
            'capitalsocial' => 50000.00,
            'email' => 'contato@novaempresa.com',
            'localidade' => 'Nova Localidade',
            'nif' => '123456789',
            'morada' => 'Endereço da Nova Empresa',
        ]);

        // Validar e salvar a nova empresa
        $this->assertTrue($novaEmpresa->validate(), 'Nova empresa é válida');
        $this->assertTrue($novaEmpresa->save(), 'Nova empresa foi salva');

        // Obter o ID da nova empresa
        $empresaId = $novaEmpresa->id;

        $reservasTest = new ReservasTest();

        // Chamar os métodos de teste necessários
        $reservaId = $reservasTest->testCriarReservaComDadosCorretos();

        $fatura = new Fatura([
            'totalf' => 100.00,
            'totalsi' => 90.00,
            'iva' => 10.00,
            'empresa_id' => $empresaId,
            'reserva_id' => $reservaId,
            'data' => '2024-01-01',
        ]);

        $this->assertTrue($fatura->validate(), 'Fatura é válida');
        $this->assertTrue($fatura->save(), 'Fatura foi salva');

        $faturaId = Fatura::find()->where(['totalf' => 100.00])->one()->id;

        return $faturaId;
    }

    public function testCriarFaturaComDadosInvalidos()
    {
        // Tente criar uma fatura com dados inválidos
        $fatura = new Fatura([
            'totalf' => 'abc',
            'totalsi' => 90.00,
            'iva' => 100,
            'empresa_id' => 99,
            'reserva_id' => null,
            'data' => '2024-01-01',
        ]);

        // A validação deve falhar, e a fatura não deve ser salva
        $this->assertFalse($fatura->validate(), 'Fatura com dados inválidos deveria falhar na validação');
        $this->assertFalse($fatura->save(), 'Fatura com dados inválidos não deveria ser salva');

        // Certifique-se de que a fatura não foi salva no banco de dados
        $faturaId = Fatura::find()->where(['totalf' => 'abc'])->one();
        $this->assertNull($faturaId, 'Fatura com dados inválidos não deveria ser salva no banco de dados');
    }

    public function testMostrarFatura()
    {
        $faturaId = $this->testCriarFaturaComDadosCorretos();
        $fatura = Fatura::findOne($faturaId);
        $this->assertNotNull($fatura, 'A fatura deveria existir na BD');
    }

    /*public function testAtualizarEVerificarFatura()
    {
        // Obter o ID da fatura criada
        $faturaId = $this->testCriarFaturaComDadosCorretos();
        $fatura = Fatura::findOne($faturaId);

        // Modificar os dados da fatura
        $fatura->totalf = 120.00;
        $fatura->totalsi = 110.00;
        $fatura->iva = 10.00;

        // Validar e salvar as alterações
        $isValid = $fatura->validate();
        if (!$isValid) {
            print_r('Validation Errors: ' . PHP_EOL);
            print_r($fatura->errors);
            print_r('Data being validated: ' . PHP_EOL);
            print_r($fatura->attributes);
        }

        $this->assertTrue($isValid, 'Fatura atualizada é válida');
        $this->assertTrue($fatura->save(), 'Fatura foi atualizada');

        // Recarregar a fatura do banco de dados após a atualização
        $faturaAtualizada = Fatura::findOne($faturaId);

        // Verificar se os dados foram atualizados corretamente
        $this->assertEquals(120.00, $faturaAtualizada->totalf, 'TotalF atualizado corretamente');
        $this->assertEquals(110.00, $faturaAtualizada->totalsi, 'TotalSI atualizado corretamente');
        $this->assertEquals(10.00, $faturaAtualizada->iva, 'IVA atualizado corretamente');
    }*/

    public function testApagarFatura()
    {
        $faturaId = $this->testCriarFaturaComDadosCorretos();
        $fatura = Fatura::findOne($faturaId);
        $this->assertNotNull($fatura, 'A fatura deveria existir na BD');

        if ($fatura !== null) {
            $fatura->delete();
            $this->assertNull(Fatura::findOne($faturaId), 'A fatura deveria ser apagada da BD');
        }

        return $faturaId;
    }

    public function testFaturaNaoExiste()
    {
        // Chame a função para apagar a fatura e obtenha o ID
        $faturaId = $this->testApagarFatura();

        // Tente localizar a fatura após a exclusão
        $faturaAposApagar = Fatura::findOne($faturaId);

        // Verifique se a fatura não existe após ser apagada
        $this->assertNull($faturaAposApagar, 'A fatura não deveria existir na BD após ser apagada');
    }

     public function testGetReserva(){

         $fatura = new Fatura();
         $reservaQuery = $fatura->getReserva();

         $this->assertInstanceOf(ActiveQuery::class, $reservaQuery);
     }

    public function testGetEmpresa()
    {
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