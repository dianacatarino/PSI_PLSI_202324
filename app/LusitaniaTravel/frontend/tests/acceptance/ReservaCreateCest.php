<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class ReservaCreateCest
{
    public function testCriarReserva(AcceptanceTester $I)
    {
        $I->wantTo('Criação de uma reserva no frontend');

        $I->amOnPage('carrinho/index');

        $I->fillField('checkin', '2024-08-08');
        $I->fillField('checkout', '2024-08-12');
        $I->fillField('numeroquartos', '2');
        $I->fillField('numeroclientes', '4');
        $I->fillField('tipoquartos', 'duplo');

        $I->click('Verificar Disponibilidade');

        // verificar se foi adicionado ao carrinho ou não

        $I->click('Finalizar');

        // Ver a fatura?
    }
}
