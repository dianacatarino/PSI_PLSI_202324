<?php

namespace frontend\tests\functional;

use frontend\models\Carrinho;
use frontend\tests\FunctionalTester;
use common\fixtures\FornecedorFixture;
use common\fixtures\ProfileFixture;
use common\fixtures\ReservaFixture;
use common\models\Reserva;
use common\models\Fornecedor;
use common\models\Fatura;
use common\models\Profile;

class CarrinhoCreateCest{

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => \common\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'fornecedor' => FornecedorFixture::class,
            'profile' => ProfileFixture::class,
            'reserva' => ReservaFixture::class,
        ];
    }

    public function testAdicionarAoCarrinho(FunctionalTester $I)
    {
        // Suponha que você tenha um fornecedor existente com ID 1
        $fornecedorId = 1;

        // Suponha que o usuário esteja autenticado
        $I->amLoggedInAs(1); // Substitua 1 pelo ID do usuário

        // Acesse a página do fornecedor
        $I->amOnRoute('alojamentos/show', ['id' => $fornecedorId]);

        // Verifique se a página do fornecedor foi carregada com sucesso
        $I->see('Detalhes do Alojamento', 'h1');

        // Execute a ação de adicionar ao carrinho
        $I->click('Adicionar ao Carrinho');

        // Verifique se o item foi adicionado ao carrinho com sucesso
        $I->seeRecord(Carrinho::class, ['fornecedor_id' => $fornecedorId]);

        // Verifique se o usuário foi redirecionado para a página do carrinho
        $I->seeCurrentUrlEquals(['carrinho/index']);
    }



}



