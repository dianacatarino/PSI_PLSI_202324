<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Comentários';
?>

<div class="definicoes">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['comentarios/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3>Comentário</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Editar</h5>

            <?php $form = ActiveForm::begin(['action' => ['comentarios/edit', 'fornecedor_id' => $comentario->fornecedor_id], 'method' => 'post']); ?>

            <?= $form->field($comentario->fornecedor, 'nome_alojamento')->textInput(['placeholder' => 'Alojamento', 'disabled' => true]) ?>

            <?= $form->field($comentario, 'titulo')->textInput(['placeholder' => 'Título do Comentário'])->label('Título') ?>
            <?= $form->field($comentario, 'descricao')->textInput(['placeholder' => 'Descrição do Comentário'])->label('Descrição') ?>
            <?= $form->field($comentario, "data_comentario")->textInput(['type' => 'date', 'disabled' => true])->label('Data Comentário') ?>

            <?php foreach ($avaliacoes as $index => $avaliacao): ?>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Avaliação <?= $index + 1 ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($avaliacao, "[$index]classificacao")->dropDownList([
                            1 => '★',
                            2 => '★★',
                            3 => '★★★',
                            4 => '★★★★',
                            5 => '★★★★★',
                        ])->label('Classificação') ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($avaliacao, "[$index]data_avaliacao")->textInput(['type' => 'date', 'disabled' => true])->label('Data Avaliação') ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div style="height: 20px;"></div>
            <div class="form-group">
                <?= Html::submitButton('Salvar Alterações', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div style="height: 20px;"></div>
</div>
