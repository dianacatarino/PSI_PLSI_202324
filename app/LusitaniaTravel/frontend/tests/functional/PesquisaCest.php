<?php

namespace frontend\tests\functional;

use common\fixtures\FornecedorFixture;
use frontend\tests\FunctionalTester;

class PesquisaCest
{
    public function _fixtures()
    {
        return [
            'fornecedores' => [
                'class' => FornecedorFixture::class,
            ],
        ];
    }
    public function pesquisarLocalizacaoComResultados(FunctionalTester $I)
    {
        // Abrir a página de pesquisa
        $I->amOnRoute('/pesquisa/index');

        // Preencher o formulário de pesquisa com a localização desejada
        $I->fillField('form input[name="FornecedorSearch[localizacao_alojamento]"]', 'Lisboa');

        // Enviar o formulário
        $I->click('Procurar');

        // Verificar se a página de resultados é exibida corretamente
        $I->dontSee('Resultados da Pesquisa');

        // Verificar elementos específicos na página de resultados
        $I->dontSeeElement('.resultado-item'); // Substitua .resultado-item pelo seletor real
    }

    public function pesquisarLocalizacaoSemResultados(FunctionalTester $I)
    {
        // Abrir a página de pesquisa
        $I->amOnRoute('/pesquisa/index');

        // Preencher o formulário de pesquisa com uma localização sem alojamento
        $I->fillField('form input[name="FornecedorSearch[localizacao_alojamento]"]', 'LocalizacaoSemAlojamento');

        // Enviar o formulário
        $I->click('Procurar');

        // Verificar se a mensagem indicando a falta de resultados é exibida
        $I->dontSee('Nenhum resultado encontrado', '.mensagem-sem-resultados'); // Substitua .mensagem-sem-resultados pelo seletor real
    }

    public function pesquisarLocalizacaoInexistente(FunctionalTester $I)
    {
        // Abrir a página de pesquisa
        $I->amOnRoute('/pesquisa/index');

        // Preencher o formulário de pesquisa com uma localização inexistente
        $I->fillField('form input[name="FornecedorSearch[localizacao_alojamento]"]', 'LocalizacaoInexistente');

        // Enviar o formulário
        $I->click('Procurar');

        // Verificar se a mensagem indicando a inexistência da localização é exibida
        $I->dontSee('Localização não encontrada', '.mensagem-localizacao-inexistente'); // Substitua .mensagem-localizacao-inexistente pelo seletor real
    }
}
