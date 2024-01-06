<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\FornecedorFixture;
use common\fixtures\ReservaFixture;

class ReservaCreateCest
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

    public function trySubmitFormVazio(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => '',
            'Reserva[checkin]' => '',
            'Reserva[checkout]' => '',
            'Reserva[numeroquartos]' => '',
            'Reserva[numeroclientes]' => '',
            'Reserva[valor]' => '',
            'Reserva[fornecedor_id]' => '',
            'Reserva[user_id]' => '',
        ]);

    }


    public function trySubmitValidForm(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => 'Online',
            'Reserva[checkin]' => '2024-03-23',
            'Reserva[checkout]' => '2024-03-25',
            'Reserva[numeroquartos]' => '2',
            'Reserva[numeroclientes]' => '5',
            'Reserva[valor]' => '122.00',
            'Reserva[fornecedor_id]' => '1',
            'Reserva[user_id]' => '47',
        ]);

        $I->amOnRoute('reservas/index');
        $I->dontSee('Create Reserva');
    }


    public function trySubmitCheckInInvalido(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => 'Online',
            'Reserva[checkin]' => '2024-03-26',
            'Reserva[checkout]' => '2024-03-25',
            'Reserva[numeroquartos]' => '2',
            'Reserva[numeroclientes]' => '5',
            'Reserva[valor]' => '122.00',
            'Reserva[fornecedor_id]' => '1',
            'Reserva[user_id]' => '47',
        ]);

        $I->dontSee('Create Reserva');
    }

    public function trySubmitCheckOutInvalido(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => 'Online',
            'Reserva[checkin]' => '2024-03-25',
            'Reserva[checkout]' => '2024-03-22',
            'Reserva[numeroquartos]' => '2',
            'Reserva[numeroclientes]' => '5',
            'Reserva[valor]' => '122.00',
            'Reserva[fornecedor_id]' => '1',
            'Reserva[user_id]' => '47',
        ]);

        $I->dontSee('Create Reserva');
    }

    public function trySubmitNumeroQuartosInvalido(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => 'Online',
            'Reserva[checkin]' => '2024-03-23',
            'Reserva[checkout]' => '2024-03-25',
            'Reserva[numeroquartos]' => '-1',
            'Reserva[numeroclientes]' => '5',
            'Reserva[valor]' => '122.00',
            'Reserva[fornecedor_id]' => '1',
            'Reserva[user_id]' => '47',
        ]);

        $I->dontSee('Create Reserva');
    }

    public function trySubmitValorInvalido(FunctionalTester $I)
    {
        $I->amOnPage('/backend/reservas/create');
        $I->submitForm('form', [
            'Reserva[tipo]' => 'Online',
            'Reserva[checkin]' => '2024-03-23',
            'Reserva[checkout]' => '2024-03-25',
            'Reserva[numeroquartos]' => '1',
            'Reserva[numeroclientes]' => '5',
            'Reserva[valor]' => '-30.00',
            'Reserva[fornecedor_id]' => '1',
            'Reserva[user_id]' => '47',
        ]);

        $I->dontSee('Create Reserva');
    }
}
