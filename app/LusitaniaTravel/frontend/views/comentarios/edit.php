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

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($comentario->fornecedor, 'nome_alojamento')->textInput(['placeholder' => 'Alojamento', 'disabled' => true])?>
            <?= $form->field($comentario, 'descricao')->textInput(['placeholder' => 'Descrição']) ?>

            <?php foreach ($avaliacoes as $index => $avaliacao): ?>
                <tr>
                    <th scope="row">Avaliação</th>
                    <td>
                        <?= $form->field($avaliacao, "[$index]classificacao")->dropDownList([
                            1 => '★',
                            2 => '★★',
                            3 => '★★★',
                            4 => '★★★★',
                            5 => '★★★★★',
                        ])->label(false) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Data Avaliação</th>
                    <td><?= Html::encode($avaliacao->data_avaliacao) ?></td>
                </tr>
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
