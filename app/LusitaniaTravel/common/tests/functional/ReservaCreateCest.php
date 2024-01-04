<?php

namespace common\tests\functional;

//use tests\FunctionalTester;
use common\fixtures\FornecedorFixture;
use common\fixtures\ReservaFixture;
use common\fixtures\UserFixture;
use common\models\Reserva;
use common\models\Fornecedor;
use common\models\Profile;

class ReservaCreateCest{

    public function _fixtures(){
        return [
            'fornecedores' => [
                'class' => FornecedorFixture::class
            ],
            'reservas' => [
                'class' => ReservaFixture::class
            ]
        ];
    }

    public function _before(\FunctionalTester $I){

        $I->amOnPage('/backend/reservas/create');
    }

    public function trySubmitFormVazio(\FunctionalTester $I){

        $I->see('Create Reserva'); // Verificação do acesso ao formulario

        // Submissão do formulário vazio

        $I->submitForm('#w0', []);

        //Verificação se existem ou não erros no formulario
        $I->see('Tipo cannot be blank.'); //Rever as regras da tabela e confirmar se está certo

    }

    public function trySubmitValidForm(\FunctionalTester $I){

        $I->selectOption('select[name="Reserva[tipo]"]', 'Online');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-03-23');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-03-25');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '2');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '5');
        $I->fillField('input[name="Reserva[valor]"]', '122.00');
        I->selectOption('select[name="Reserva[fornecedor_id]"]', '1');
        $I->selectOption('select[name="Reserva[user_id]"]', '47'); //Forma de identificar por role TODO
        $I->selectOption('select[name="Reserva[user_id]"]', '52'); //Forma de identificar por role TODO

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/index');
        $I->SeeElement('.success-message');

    }

    public function trySubmitCheckInInvalido(\FunctionalTester $I){

        $I->selectOption('select[name="Reserva[tipo]"]', 'Online');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-03-26');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-03-25');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '2');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '5');
        $I->fillField('input[name="Reserva[valor]"]', '122.00');
        I->selectOption('select[name="Reserva[fornecedor_id]"]', '1');
        $I->selectOption('select[name="Reserva[user_id]"]', '47'); //Forma de identificar por role TODO
        $I->selectOption('select[name="Reserva[user_id]"]', '52'); //Forma de identificar por role TODO

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/create');
        $I->dontSeeElement('.success-message');

    }

    public function trySubmitCheckOutInvalido(\FunctionalTester $I){

        $I->selectOption('select[name="Reserva[tipo]"]', 'Online');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-03-25');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-03-22');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '2');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '5');
        $I->fillField('input[name="Reserva[valor]"]', '122.00');
        I->selectOption('select[name="Reserva[fornecedor_id]"]', '1');
        $I->selectOption('select[name="Reserva[user_id]"]', '47'); //Forma de identificar por role TODO
        $I->selectOption('select[name="Reserva[user_id]"]', '52'); //Forma de identificar por role TODO

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/create');
        $I->dontSeeElement('.success-message');

    }

    public function trySubmitNumeroQuartosInvalido(\FunctionalTester $I){

        $I->selectOption('select[name="Reserva[tipo]"]', 'Online');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-03-23');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-03-25');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '-1');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '5');
        $I->fillField('input[name="Reserva[valor]"]', '122.00');
        I->selectOption('select[name="Reserva[fornecedor_id]"]', '1');
        $I->selectOption('select[name="Reserva[user_id]"]', '47'); //Forma de identificar por role TODO
        $I->selectOption('select[name="Reserva[user_id]"]', '52'); //Forma de identificar por role TODO

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/create');
        $I->dontSeeElement('.success-message');

    }

    public function trySubmitValorInvalido(\FunctionalTester $I){

        $I->selectOption('select[name="Reserva[tipo]"]', 'Online');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-03-23');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-03-25');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '1');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '-2');
        $I->fillField('input[name="Reserva[valor]"]', '-30.00');
        $I->selectOption('select[name="Reserva[fornecedor_id]"]', '1');
        $I->selectOption('select[name="Reserva[user_id]"]', '47'); //Forma de identificar por role TODO
        $I->selectOption('select[name="Reserva[user_id]"]', '52'); //Forma de identificar por role TODO

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/create');
        $I->dontSeeElement('.success-message');

    }

    public function _after(\FunctionalTester $I){ //Serve para reverter todas as alteracoes depois dos testes serem executados

        $I->haveFixtures([
            'fornecedores' => FornecedorFixture::class,
            'reservas' => ReservaFixture::class
        ]);
    }


}

