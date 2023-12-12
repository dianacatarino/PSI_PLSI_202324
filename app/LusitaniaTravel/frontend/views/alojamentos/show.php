<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Detalhes do Alojamento';

?>

<div class="detalhes-alojamento">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3><?= Html::encode($fornecedor->nome_alojamento) ?></h3>

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $imagens = $fornecedor->imagens;

            if (!empty($imagens)) {
                foreach ($imagens as $index => $imagem) {
                    $activeClass = $index === 0 ? 'active' : '';
                    if ($imagem->filename) {
                        echo '<div class="carousel-item ' . $activeClass . '">';
                        echo Html::img($imagem->filename, ['class' => 'd-block img-thumbnail mx-auto',
                            'style' => 'max-height: 300px; width: 500px;',
                        ]);
                        echo '</div>';
                    } else {
                        echo 'Imagem não encontrada';
                    }
                }
            } else {
                echo 'Nenhuma imagem disponível';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" style="color: #ffffff; background-color: #3d9bd1;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="color: #ffffff; background-color: #3d9bd1;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <table class="table">
        <tbody>
        <tr>
            <th scope="row">Tipo de Alojamento</th>
            <td><?= Html::encode($fornecedor->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row">Localização</th>
            <td><?= Html::encode($fornecedor->localizacao_alojamento) ?></td>
        </tr>
        <tr>
            <th scope="row">Tipo de Quarto</th>
            <td><?= Html::encode($tipoQuarto) ?></td>
        </tr>
        <tr>
            <th scope="row">Número de Quartos</th>
            <td><?= Html::encode($numeroQuartos) ?></td>
        </tr>
        <tr>
            <th scope="row">Número de Camas</th>
            <td><?= Html::encode($numeroCamas) ?></td>
        </tr>
        <tr>
            <th scope="row">Acomodações</th>
            <td><?= Html::encode($fornecedor->acomodacoes_alojamento) ?></td>
        </tr>
        <tr>
            <th scope="row">Preço por Noite</th>
            <td><?= Html::encode($precoPorNoite) ?>€</td>
        </tr>
        </tbody>
    </table>

    <div style="height: 20px;"></div>

    <div class="mt-3">
        <h5>Comentários</h5>
        <?php $formComentario = ActiveForm::begin(['action' => ['comentarios/create', 'fornecedor_id' => $fornecedor->id], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
        <div class="mb-3">
            <?= $formComentario->field($comentario, 'titulo')->textInput(['class' => 'form-control'])->label('Título') ?>
        </div>

        <div class="mb-3">
            <?= $formComentario->field($comentario, 'descricao')->textInput(['class' => 'form-control'])->label('Descrição') ?>
        </div>

        <div class="mb-3">
            <?= $formComentario->field($comentario, 'data_comentario')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>
        </div>

        <div class="d-flex justify-content-between">
            <?= Html::submitButton('Adicionar Comentário', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <br><br>

        <h5>Avaliação</h5>
        <?php $formAvaliacao = ActiveForm::begin(['action' => ['avaliacoes/create'], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
        <div class="mb-3">
            <?= $formAvaliacao->field($avaliacao, 'classificacao')->dropDownList(
                [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'],
                ['prompt' => 'Avalie de 1 a 5', 'class' => 'form-control custom-select']
            )->label('Avaliação') ?>
        </div>

        <div class="mb-3">
            <?= $formAvaliacao->field($avaliacao, 'data_avaliacao')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>
        </div>

        <div class="d-flex justify-content-between">
            <?= Html::submitButton('Adicionar Avaliação', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <br><br>

        <div>
            <h5>Comentários de Clientes</h5>
            <?php foreach($fornecedor->comentarios as $comentario){ ?>
                <h6>username?</h6>
                <?= $comentario->data_comentario; ?> <br>
                <?= $comentario->titulo; ?> <br>
                <?= $comentario->descricao; ?>
            <?php } ?>
        </div>
        <div style="height: 20px;"></div>
    </div>

</div>
