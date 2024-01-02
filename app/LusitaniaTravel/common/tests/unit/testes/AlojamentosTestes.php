<?php

namespace common\tests\unit\testes;

use Yii;
use common\models\Confirmacao;
use common\models\Imagem;
use common\models\Reserva;
use common\models\Fornecedor;
use common\models\Avaliacao;
use common\models\Comentario;


/**
 * AlojamentosTestes test
 */

class AlojamentosTestes extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    /**
     * @return array
     */

    public function testGetAvaliacoes(){

        $fornecedores = new Fornecedor();

        $avaliacoes = [
            new Avaliacao(['classificacao' => 4]) ,
            new Avaliacao(['classificacao' => 5]),
            new Avaliacao(['classificacao' => 2]),
        ];

        //Simula o a ligação entre as duas tabelas
        $fornecedores->avaliacoes = $avaliacoes; //Confirmar após a migração da tabela Fornecedores

        //Testa usando o método getAvaliacoes()
        $result = $fornecedores->getAvaliacoes();

        //Comparação do resultado da função com o valor certo
        $this->assertEquals($avaliacoes, $result);
        //$this->tester->seeInDatabase('fornecedores'); //confirmar após a migração

    }

    public function testGetComentarios(){

        $fornecedores = new Fornecedor();

        $comentarios = [
            new Comentario(['titulo' => 'titulo do comentario numero 1' , 'descricao' => 'comentario 1']),
            new Comentario(['titulo' => 'titulo do comentario numero 2' , 'descricao' => 'comentario 2']),
            new Comentario(['titulo' => 'titulo do comentario numero 3' , 'descricao' => 'comentario 3'])
        ];

        $fornecedores->comentarios = $comentarios; //Confirmar após a migração da tabela Fornecedores

        $result = $fornecedores->getComentarios();

        $this->assertEquals($comentarios, $result);

        //$this->tester->seeInDatabase('fornecedores'); //confirmar após a migração
    }

    public function testGetConfirmacoes(){

        $fornecedores = new Fornecedor();

        //Criação de uma nova confirmação
        $confirmacoes = new Confirmacao(['estado' => 'confirmado' , 'dataconfirmacao' => '2024-01-02']);

        $fornecedores->confirmacoes = $confirmacoes; //Confirmar após a migração da tabela Fornecedores

        //Teste da função getConfirmacoes()
        $result = $fornecedores->getConfirmacoes();

        $this->assertEquals($confirmacoes, $result);

        //$this->tester->seeInDatabase('fornecedores'); //confirmar após a migração
    }

    public function testGetImagens(){

        $fornecedores = new Fornecedor();

        //Adiconar a nova imagem
        $imagens = new Imagem(['filename' => '/LusitaniaTravel/common/public/img/design-3588214_640.jpg']);

        $fornecedores->imagens = $imagens; //Confirmar após migração

        //Testar do método getImagens()
        $result = $fornecedores->getImagens();

        $this->assertEquals($imagens , $result);

        //$this->tester->seeInDatabase('fornecedores'); //confirmar após a migração
    }

    public function testGetReservas(){

        $fornecedores = new Fornecedor();

        //Adicionar a nova reserva
        $reservas = new Reserva (['tipo' => 'online' , 'checkin' => '2024-08-22' ,
            'checkout' => '2024-08-28' , 'numeroquartos' => 2 , 'numeroclientes' => 4 ,
            'valor' => 56.00]);

        $fornecedores->fornecedor_id = $reservas; //fornecedor_id não está correto

        //Testa no método getReservas
        $result = $fornecedores->getReservas();

        $this->assertEquals($reservas , $result);
    }

    public function testGetMediaClassificacoes(){

        $fornecedores = new Fornecedor();

        //Atribuição de Valores às variaveis
        $avaliacao1 = new Avaliacao();
        $avaliacao1->classificacao = 5 ;

        $avaliacao2 = new Avaliacao();
        $avaliacao2->classificacao = 3 ;

        $avaliacao3 = new Avaliacao();
        $avaliacao3->classificacao = 4 ;

        //Criação de um array de avaliações do novo fornecedor e vai testar o método getMediaClassificacoes()
        $fornecedores->avaliacoes = [$avaliacao1 , $avaliacao2 , $avaliacao3];
        $result = $fornecedores->getMediaClassificacoes();

        //Comparação do resultado da função com o valor certo
        $this->assertEquals(4, $result);

        //$this->tester->seeInDatabase('fornecedores'); //confirmar após a migração

    }


}

