<?php

namespace common\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\ReservaFixture;
use frontend\tests\AcceptanceTester;

class VerificarDisponibilidadeCest{

    public function _fixtures(){
        return [
            'reservas' => [
                'class' => ReservaFixture::class,
            ]
        ];
    }

    public function _before(FunctionalTester $I){

        $I->amOnPage('/backend/reservas/create');
    }

    public function verificaDisponibilidadeValido(AcceptanceTester $I){

        $I->amOnPage('/reservas/verificar');

        $I->fillField('input[name="Reserva[checkin]"]', '2024-05-05');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-05-10');
        $I->fillField('input[name="Reserva[numeroclientes]"]', 2);
        $I->fillField('input[name="Reserva[numeroquartos]"]', 1);

        //Atributos tipo de quarto e nº de camas
        for ($i = 1; $i <= 6; $i++) {
            $I->selectOption("select[name=\"Reserva[linhasreservas][1][tipoquarto][$i]\"]", 'Quarto Duplo');
            $I->fillField("input[name=\"Reserva[linhasreservas][1][numerocamas][$i]\"]", 2);
        }

        $I->click('Verificar Disponibilidade');

        $I->seeCurrentUrlEquals('/reservas/index');
        $I->see('Verificação bem-sucedida!', '.alert-success');
    }

    public function verificaDisponibilidadeCheckInInvalido(AcceptanceTester $I){

        $I->amOnPage('/reservas/verificar');

        $I->fillField('input[name="Reserva[checkin]"]', '');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-05-05');
        $I->fillField('input[name="Reserva[numeroclientes]"]', 1);
        $I->fillField('input[name="Reserva[numeroquartos]"]', 1);

        for ($i = 1; $i <= 6; $i++) {
            $I->selectOption("select[name=\"Reserva[linhasreservas][1][tipoquarto][$i]\"]", 'Individual');
            $I->fillField("input[name=\"Reserva[linhasreservas][1][numerocamas][$i]\"]", 1);
        }

        $I->click('Verificar Disponibilidade');

        $I->seeCurrentUrlEquals('/reservas/verificar');
        $I->see('Falha na verificação.', '.alert-danger');
    }

    public function verificaDisponibilidadeCheckOutInvalido(AcceptanceTester $I){

        $I->amOnPage('/reservas/verificar');

        $I->fillField('input[name="Reserva[checkin]"]', '2024-05-05');
        $I->fillField('input[name="Reserva[checkout]"]', '');
        $I->fillField('input[name="Reserva[numeroclientes]"]', 1);
        $I->fillField('input[name="Reserva[numeroquartos]"]', 1);

        for ($i = 1; $i <= 6; $i++) {
            $I->selectOption("select[name=\"Reserva[linhasreservas][1][tipoquarto][$i]\"]", 'Individual');
            $I->fillField("input[name=\"Reserva[linhasreservas][1][numerocamas][$i]\"]", 1);
        }

        $I->click('Verificar Disponibilidade');

        $I->seeCurrentUrlEquals('/reservas/verificar');
        $I->see('Falha na verificação.', '.alert-danger');
    }

    public function verificaDisponibilidadeNumeroClientesInvalido(AcceptanceTester $I){

        $I->amOnPage('/reservas/verificar');

        $I->fillField('input[name="Reserva[checkin]"]', '2024-05-05');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-05-10');
        $I->fillField('input[name="Reserva[numeroclientes]"]', -1);
        $I->fillField('input[name="Reserva[numeroquartos]"]', 1);

        for ($i = 1; $i <= 6; $i++) {
            $I->selectOption("select[name=\"Reserva[linhasreservas][1][tipoquarto][$i]\"]", 'Individual');
            $I->fillField("input[name=\"Reserva[linhasreservas][1][numerocamas][$i]\"]", 1);
        }

        $I->click('Verificar Disponibilidade');

        $I->seeCurrentUrlEquals('/reservas/verificar');
        $I->see('Falha na verificação.', '.alert-danger');
    }

    public function verificaDisponibilidadeNumeroQuartosInvalido(AcceptanceTester $I){

        $I->amOnPage('/reservas/verificar');

        $I->fillField('input[name="Reserva[checkin]"]', '2024-05-05');
        $I->fillField('input[name="Reserva[checkout]"]', '2024-05-10');
        $I->fillField('input[name="Reserva[numeroclientes]"]', 1);
        $I->fillField('input[name="Reserva[numeroquartos]"]', -1);

        for ($i = 1; $i <= 6; $i++) {
            $I->selectOption("select[name=\"Reserva[linhasreservas][1][tipoquarto][$i]\"]", 'Individual');
            $I->fillField("input[name=\"Reserva[linhasreservas][1][numerocamas][$i]\"]", 1);
        }

        $I->click('Verificar Disponibilidade');

        $I->seeCurrentUrlEquals('/reservas/verificar');
        $I->see('Falha na verificação.', '.alert-danger');
    }

    public function _after(FunctionalTester $I){ //Serve para reverter todas as alteracoes depois dos testes serem executados

        $I->haveFixtures([
            'reservas' => ReservaFixture::class
        ]);
    }

}
