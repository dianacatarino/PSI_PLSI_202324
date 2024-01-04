<?php

namespace common\tests\functional;

//use tests\FunctionalTester;
use common\fixtures\FornecedorFixture;
use common\fixtures\ReservaFixture;
use common\models\Fornecedor;

class PesquisaCest{

    public function _fixtures(){
        return [
            'fornecedores' => [
                'class' => FornecedorFixture::class
            ],
        ];
    }

    public function _before(\FunctionalTester $I){

        $I->amOnPage('/backend/pesquisa/index');
    }

    public function trySubmitFormVazio(\FunctionalTester $I){ //Tentativa de submissão do form vazio

        //$I->see('Pesquisa'); // Verificação do acesso ao formulario

        $I->submitForm('#w0', []);

        $I->see('Tipo cannot be blank.'); //Rever as regras da tabela e confirmar se está certo
        //Confirma se são ou não devovidos os erros da tebela definidos
    }

    public function trySubmitFormValido(\FunctionalTester $I){

        $I->fillField('input[name="Fornecedor[localizacao_alojamento]"]', 'Leiria');

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('frontend/pesquisa/_result');
        $I->SeeElement('.success-message');

    }

    public function trySubmitFormInvalido(\FunctionalTester $I){

        $I->fillField('input[name="Fornecedor[localizacao_alojamento]"]', 'Paris');

        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('frontend/pesquisa/index');
        $I->dontSeeElement('.success-message');

    }

    public function _after(\FunctionalTester $I){ //Serve para reverter todas as alteracoes depois dos testes serem executados

        $I->haveFixtures([
            'fornecedores' => FornecedorFixture::class
        ]);
    }

}



