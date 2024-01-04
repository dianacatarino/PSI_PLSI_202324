<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class ReservaCreateCest
 */
class ReservaCreateCest
{
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

        $I->selectOption('select[name="Reserva[tipo]"]', 'Onlie');
        $I->fillField('input[name="Reserva[checkin]"]', '2024-01-07');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-01-09');
        $I->fillField('input[name="Reserva[numeroquartos]"]', '2');
        $I->fillField('input[name="Reserva[numeroclientes]"]', '5');
        $I->fillField('input[name="Reserva[valor]"]', '122.00');

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('backend/reservas/index');

    }
}
