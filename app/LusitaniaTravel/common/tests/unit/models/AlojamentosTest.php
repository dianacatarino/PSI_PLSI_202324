<?php

namespace common\tests\unit\models;

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

    public function testCreateFornecedorWithCorrectData()
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

        $this->assertTrue($fornecedor->validate(), 'Fornecedor is valid');
        $this->assertTrue($fornecedor->save(), 'Fornecedor is saved');
    }

    public function testCreateFornecedorWithIncorrectData()
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

        $this->assertFalse($fornecedor->validate(), 'Fornecedor is not valid');
        $this->assertFalse($fornecedor->save(), 'Fornecedor is not saved');
    }

    public function testCreateFornecedorWithNegativeNumeroQuartos()
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

        $this->assertFalse($fornecedor->validate(), 'Fornecedor is not valid');
        $this->assertFalse($fornecedor->save(), 'Fornecedor is not saved');
        $this->assertArrayHasKey('numeroquartos', $fornecedor->errors, 'Validation error for numeroquartos is present');
    }

    public function testCreateFornecedorWithNonIntegerNumeroQuartos()
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

        $this->assertFalse($fornecedor->validate(), 'Fornecedor is not valid');
        $this->assertFalse($fornecedor->save(), 'Fornecedor is not saved');
        $this->assertArrayHasKey('numeroquartos', $fornecedor->errors, 'Validation error for numeroquartos is present');
    }

    public function testCreateFornecedorWithNonNumericPrecopornoite()
    {
        $fornecedor = new Fornecedor([
            'responsavel' => 'Nome do Responsável',
            'tipo' => 'Tipo do Fornecedor',
            'nome_alojamento' => 'Nome do Alojamento',
            'localizacao_alojamento' => 'Localização do Alojamento',
            'acomodacoes_alojamento' => 'Acomodações do Alojamento',
            'tipoquartos' => 'Tipo de Quartos',
            'numeroquartos' => 10,
            'precopornoite' => 'invalid', // Valor incorreto
        ]);

        $this->assertFalse($fornecedor->validate(), 'Fornecedor is not valid');
        $this->assertFalse($fornecedor->save(), 'Fornecedor is not saved');
        $this->assertArrayHasKey('precopornoite', $fornecedor->errors, 'Validation error for precopornoite is present');
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

    public function testSelectFornecedores()
    {
        $result = Fornecedor::selectFornecedores();

        $this->assertTrue(is_array($result) && !empty($result));
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

