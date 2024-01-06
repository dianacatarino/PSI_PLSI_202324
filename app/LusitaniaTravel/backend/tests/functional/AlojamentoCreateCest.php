<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\FornecedorFixture;
use common\fixtures\ReservaFixture;

class AlojamentoCreateCest
{
    public function _fixtures()
    {
        return [
            'fornecedores' => [
                'class' => FornecedorFixture::class,
            ],
            'reservas' => [
                'class' => ReservaFixture::class,
            ],
        ];
    }

    // Teste com dados vazios
    public function testCreateWithFormVazio(FunctionalTester $I)
    {
        $I->amOnRoute('alojamentos/create');

        $I->submitForm('form', [
            'Fornecedor[responsavel]' => '',
            'Fornecedor[tipo]' => '',
            'Fornecedor[nome_alojamento]' => '',
            'Fornecedor[localizacao_alojamento]' => '',
            'Fornecedor[acomodacoes_alojamento][]' => [],
            'Fornecedor[tipoquartos][]' => [],
            'Fornecedor[numeroquartos]' => '',
            'Fornecedor[precopornoite]' => '',
            'Fornecedor[imagens]' => '',
        ]);

        $I->dontSee('Nome do Alojamento não pode ficar em branco.');
        $I->dontSee('Localização do Alojamento não pode ficar em branco.');
        $I->dontSee('Acomodações do Alojamento não pode ficar em branco.');
        $I->dontSee('Tipo de Quartos do Alojamento não pode ficar em branco.');
        $I->dontSee('Número de Quartos não pode ficar em branco.');
        $I->dontSee('Preço por Noite não pode ficar em branco.');
        $I->dontSee('Imagens não pode ficar em branco.');
    }

    // Teste com dados válidos
    public function testCreateWithValidData(FunctionalTester $I)
    {
        $I->amOnRoute('alojamentos/create');

        // Preencha o formulário com dados válidos
        $I->submitForm('form', [
            'Fornecedor[responsavel]' => 1, // Substitua com um ID de fornecedor válido
            'Fornecedor[tipo]' => 'Hotel',
            'Fornecedor[nome_alojamento]' => 'Nome do Alojamento',
            'Fornecedor[localizacao_alojamento]' => 'Localização do Alojamento',
            'Fornecedor[acomodacoes_alojamento][]' => ['Cama de Casal', 'Wi-Fi'], // Substitua com opções válidas
            'Fornecedor[tipoquartos][]' => ['Individual', 'Duplo'], // Substitua com opções válidas
            'Fornecedor[numeroquartos]' => 10,
            'Fornecedor[precopornoite]' => 100,
            'Fornecedor[imagens]' => 'caminho_da_imagem.jpg', // Substitua com o caminho real da imagem
        ]);

        $I->amOnRoute('alojamentos/index');
        $I->dontSee('Create Alojamento');
    }

    // Teste com dados inválidos
    public function testCreateWithInvalidData(FunctionalTester $I)
    {
        $I->amOnRoute('alojamentos/create');

        // Preencha o formulário com dados inválidos
        $I->submitForm('form', [
            'Fornecedor[responsavel]' => 'TextoInvalido',
            'Fornecedor[tipo]' => 'Tipo Inválido',
            'Fornecedor[nome_alojamento]' => 'Nome do Alojamento',
            'Fornecedor[localizacao_alojamento]' => 'Localização do Alojamento',
            'Fornecedor[acomodacoes_alojamento][]' => ['Cama de Casal', 'Wi-Fi', 'OpcaoInvalida'],
            'Fornecedor[tipoquartos][]' => ['Individual', 'Duplo', 'OpcaoInvalida'],
            'Fornecedor[numeroquartos]' => 'TextoInvalido',
            'Fornecedor[precopornoite]' => 'TextoInvalido',
            'Fornecedor[imagens][]' => 'caminho_da_imagem_invalida.pdf',
        ]);

        $I->dontSee('Responsável inválido', '#fornecedor-responsavel');
        $I->dontSee('Tipo inválido', '#fornecedor-tipo');
        $I->dontSee('Opção inválida', '#fornecedor-acomodacoes_alojamento');
        $I->dontSee('Opção inválida', '#fornecedor-tipoquartos');
        $I->dontSee('Deve ser um número inteiro', '#fornecedor-numeroquartos');
        $I->dontSee('Deve ser um número', '#fornecedor-precopornoite');
        $I->dontSee('Apenas arquivos de imagem são permitidos', '#fornecedor-imagens');
    }
}