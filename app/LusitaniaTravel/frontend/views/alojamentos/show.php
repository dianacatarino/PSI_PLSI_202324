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
            <th scope="row">Tipos de Quartos</th>
            <td>
                <?php
                $numeroCamasPorTipoQuarto = $fornecedor->getNumeroCamasPorTipoQuarto();

                foreach ($numeroCamasPorTipoQuarto as $tipoQuarto => $numeroCamas) {
                    echo ucfirst($tipoQuarto) . ': ' . $numeroCamas . ' cama(s)<br>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Acomodações</th>
            <td>
                <?php
                $acomodacoes = explode(';', $fornecedor->acomodacoes_alojamento);
                echo implode('<br>', $acomodacoes);
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Preço por Noite</th>
            <td><?= Html::encode($fornecedor->precopornoite) ?>€</td>
        </tr>
        </tbody>
    </table>

    <div style="height: 20px;"></div>

    <div class="mt-3">
        <h5>Adicionar Comentário e Avaliação</h5>
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
        <?php $formAvaliacao = ActiveForm::begin(['action' => ['avaliacoes/create', 'fornecedor_id' => $fornecedor->id], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
        <div class="mb-3">
            <?= $formAvaliacao->field($avaliacao, 'classificacao')->dropDownList(
                [
                    1 => '★☆☆☆☆', // Uma estrela
                    2 => '★★☆☆☆', // Duas estrelas
                    3 => '★★★☆☆', // Três estrelas
                    4 => '★★★★☆', // Quatro estrelas
                    5 => '★★★★★', // Cinco estrelas
                ],
                ['prompt' => 'Selecione uma avaliação', 'class' => 'form-control']
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
            <h5>Comentários e Avaliações de Clientes</h5>

            <?php if (empty($fornecedor->comentarios) && empty($fornecedor->avaliacoes)) : ?>
                <p>Sem comentários e avaliações.</p>
            <?php else : ?>
                <?php foreach ($fornecedor->comentarios as $comentario) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title"><?= Html::encode($comentario->cliente->username ?? 'Usuário Desconhecido') ?></h6>
                            <p class="card-text">
                                <strong><?= Html::encode($comentario->titulo ?? 'Sem Título') ?></strong> <br>
                                Comentário: <?= Html::encode($comentario->descricao); ?>
                            </p>

                            <?php
                            $avaliacaoEncontrada = null;

                            foreach ($fornecedor->avaliacoes as $avaliacao) {
                                if ($avaliacao->cliente_id == $comentario->cliente_id) {
                                    $avaliacaoEncontrada = $avaliacao;
                                    break;
                                }
                            }
                            ?>

                            <?php if ($avaliacaoEncontrada) : ?>
                                <p class="card-text">
                                    Avaliação:
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo ($i <= $avaliacaoEncontrada->classificacao) ? '★' : '☆';
                                    }
                                    ?>
                                </p>
                                <small class="text-muted"><?= Yii::$app->formatter->asDate($avaliacaoEncontrada->data_avaliacao, 'dd/MM/yyyy') ?></small>
                            <?php else : ?>
                                <small class="text-muted"><?= Yii::$app->formatter->asDate($comentario->data_comentario, 'dd/MM/yyyy') ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div style="height: 20px;"></div>
    </div>

</div>
