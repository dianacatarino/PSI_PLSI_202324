<?php

namespace common\tests\unit\models;

use common\fixtures\FornecedorFixture;
use common\fixtures\UserFixture;
use Yii;
use common\models\Confirmacao;
use common\models\Imagem;
use common\models\Reserva;
use common\models\Fornecedor;
use common\models\Avaliacao;
use common\models\Comentario;
use yii\db\ActiveQuery;


/**
 * AlojamentosTestes test
 */

class AlojamentosTest extends \Codeception\Test\Unit
{
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
            'fornecedor' => [
                'class' => FornecedorFixture::class,
                'dataFile' => codecept_data_dir() . 'fornecedor.php'
            ]
        ];
    }

    public function testCriarFornecedorComDadosCorretos()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => 'Nome do Responsável',
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => 10,
            'precopornoite' => 100.00,
        ]);

        $this->assertTrue($fornecedor->validate(), 'Fornecedor é válido');
        $this->assertTrue($fornecedor->save(), 'Fornecedor foi salvo');

        $fornecedorId = Fornecedor::find()->where(['responsavel' => 'Nome do Responsável'])->one()->id;

        return $fornecedorId;
    }

    public function testCriarFornecedorComDadosIncorretos()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => null,
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => 10,
            'precopornoite' => 100.00,
        ]);

        $this->assertFalse($fornecedor->validate(), 'Fornecedor não é válido');
        $this->assertFalse($fornecedor->save(), 'Fornecedor não foi salvo');
    }

    public function testCriarFornecedorComNumeroQuartosNegativo()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => 'Nome do Responsável',
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => -5, // Valor incorreto
            'precopornoite' => 100.00,
        ]);

        $this->assertFalse($fornecedor->validate(), 'Fornecedor não é válido');
        $this->assertFalse($fornecedor->save(), 'Fornecedor não foi salvo');
        $this->assertArrayHasKey('numeroquartos', $fornecedor->errors, 'Erro de validação para numeroquartos presente');
    }

    public function testCriarFornecedorComNumeroQuartosNaoInteiro()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => 'Nome do Responsável',
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => 7.5, // Valor incorreto
            'precopornoite' => 100.00,
        ]);

        $this->assertFalse($fornecedor->validate(), 'Fornecedor não é válido');
        $this->assertFalse($fornecedor->save(), 'Fornecedor não foi salvo');
        $this->assertArrayHasKey('numeroquartos', $fornecedor->errors, 'Erro de validação para numeroquartos presente');
    }

    public function testCriarFornecedorComPrecopornoiteNaoNumerico()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => 'Nome do Responsável',
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => 10,
            'precopornoite' => 'inválido', // Valor incorreto
        ]);

        $this->assertFalse($fornecedor->validate(), 'Fornecedor não é válido');
        $this->assertFalse($fornecedor->save(), 'Fornecedor não foi salvo');
        $this->assertArrayHasKey('precopornoite', $fornecedor->errors, 'Erro de validação para precopornoite presente');
    }

    public function testMostrarFornecedor()
    {
        $this->testCriarFornecedorComDadosCorretos();

        $fornecedor = Fornecedor::findOne(['responsavel' => 'Nome do Responsável']);

        $this->assertNotNull($fornecedor, 'O registo deveria existir na BD');
    }

    public function testAtualizarFornecedor()
    {
        $this->testCriarFornecedorComDadosCorretos();

        $fornecedor = Fornecedor::findOne(['responsavel' => 'Nome do Responsável']);

        $this->assertNotNull($fornecedor, 'O registro deveria existir na BD');

        if ($fornecedor !== null) {
            $fornecedor->tipo = 'Novo Tipo';
            $this->assertTrue($fornecedor->save(), 'Deveria ser possível atualizar e salvar um registo na BD');
        }
    }

    public function testFornecedorAtualizado()
    {
        $this->testAtualizarFornecedor();

        // Find the updated record
        $fornecedorAtualizado = Fornecedor::findOne(['responsavel' => 'Nome do Responsável', 'tipo' => 'Novo Tipo']);

        // Assert that the updated record exists
        $this->assertNotNull($fornecedorAtualizado, 'O registo atualizado deveria existir na BD');
    }


    public function testApagarFornecedor()
    {
        $this->testCriarFornecedorComDadosCorretos();

        $fornecedor = Fornecedor::findOne(['responsavel' => 'Nome do Responsável']);

        $this->assertNotNull($fornecedor, 'O registo deveria existir na BD');

        if ($fornecedor !== null) {
            $fornecedorId = $fornecedor->id;

            $fornecedor->delete();
            $this->assertNull(Fornecedor::findOne($fornecedorId), 'O registo deveria ser apagado da BD');
        }
    }

    public function testFornecedorNaoExiste()
    {
        $fornecedorDeletado = Fornecedor::findOne(['responsavel' => 'Nome do Responsável']);

        $this->assertNull($fornecedorDeletado, 'O registo não deveria existir na BD após ser apagado');
    }


    public function testGetAvaliacoes(){

        $fornecedor = new Fornecedor();
        $comentariosQuery = $fornecedor->getComentarios();

        $this->assertInstanceOf(ActiveQuery::class, $comentariosQuery);

    }

    public function testGetComentarios()
    {
        $fornecedor = new Fornecedor();
        $comentariosQuery = $fornecedor->getComentarios();

        $this->assertInstanceOf(ActiveQuery::class, $comentariosQuery);
    }

    public function testGetConfirmacoes()
    {
        $fornecedor = new Fornecedor();
        $confirmacoesQuery = $fornecedor->getConfirmacoes();

        $this->assertInstanceOf(ActiveQuery::class, $confirmacoesQuery);
    }

    public function testGetImagens()
    {
        $fornecedor = new Fornecedor();
        $imagensQuery = $fornecedor->getImagens();

        $this->assertInstanceOf(ActiveQuery::class, $imagensQuery);
    }

    public function testGetReservas()
    {
        $fornecedor = new Fornecedor();
        $reservasQuery = $fornecedor->getReservas();

        $this->assertInstanceOf(ActiveQuery::class, $reservasQuery);
    }

    public function testGetMediaClassificacoes()
    {
        $fornecedor = $this->getMockBuilder(Fornecedor::class)
            ->onlyMethods(['getAvaliacoes'])
            ->getMock();

        $fornecedor->expects($this->once())
            ->method('getAvaliacoes')
            ->willReturn([
                new Avaliacao(['classificacao' => 4]),
                new Avaliacao(['classificacao' => 5]),
            ]);

        $mediaClassificacoes = $fornecedor->getMediaClassificacoes();

        $this->assertEquals(4.5, $mediaClassificacoes);
    }
}

