<?php

namespace common\tests\functional;

use common\fixtures\FornecedorFixture;
use common\fixtures\ProfileFixture;
use common\fixtures\ReservaFixture;
use common\models\Reserva;
use common\models\Fornecedor;
use common\models\Fatura;
use common\models\Profile;
use backend\tests\FunctionalTester;

class FaturaCreateCest{

    public function _fixtures(){
        return [
            'reservas' => [
                'class' => ReservaFixture::class,
            ],
            'fornecedores' => [
                'class' => FornecedorFixture::class,
            ],
            'profile'=> [
                'class' => ProfileFixture::class,
        ],
            ];
    }

    public function _before(FunctionalTester $I){

        $I->amOnPage('/backend/faturas/create');
    }

    public function trySubmitFormVazio(FunctionalTester $I){

        $I->see('Create Fatura'); // Verificação do acesso ao formulario

        $I->submitForm('#w0', []);

        $I->see('Tipo cannot be blank.'); //Rever as regras da tabela e confirmar se está certo
        $I->dontSeeElement('.success-message');

    }

    public function trySubmitValidForm(FunctionalTester $I){

        $I->selectOption('select[name="Reserva[id]"]', '2'); //Substituir pelo id da reserva desejada, restandos atributos tem de bater certo
        $I->fillField('input[name="Fornecedor[nome]"]', 'Selene Hotel');
        $I->fillField('input[name="Cliente[nome]"]', 'user1');

        $I->submitForm('#w0', []);

        $I->see('Fatura criada com sucesso.');

        $I->seeCurrentUrlEquals('backend/faturas/show');

        $I->seeElement('.sucess-message');

    }

    public function trySubmitInvalidForm(FunctionalTester $I){

        $I->selectOption('select[name="Reserva[id]"]', '3');
        $I->fillField('input[name="Fornecedor[nome]"]', 'Selene Hotel'); //vai fazer não estar correto
        $I->fillField('input[name="User[nome]"]', 'maria'); //Select da tabela

        $I->submitForm('#w0', []);

        $I->see('Erro ao criar a fatura.');

        $I->seeCurrentUrlEquals('backend/faturas/create');
        $I->dontSeeElement('.success-message');

    }

    public function _after(FunctionalTester $I){ //Serve para reverter todas as alteracoes depois dos testes serem executados

        $I->haveFixtures([
            'reservas' => ReservaFixture::class,
            'fornecedores' => FornecedorFixture::class,
            'profile' => ProfileFixture::class,
        ]);
    }



}


