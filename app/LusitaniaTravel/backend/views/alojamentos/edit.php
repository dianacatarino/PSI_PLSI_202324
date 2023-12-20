<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$this->title = 'Editar Alojamento';
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Alojamento</h3>
    </div>

    <?php $form = ActiveForm::begin(['action' => ['alojamentos/edit', 'id' => $fornecedor->id], 'method' => 'post', 'options' => ['class' => 'container']]); ?>
    <div class="card-body">
        <div class="form-group">
            <?= $form->field($fornecedor, 'responsavel')->dropDownList(
                array_combine($responsaveis, $responsaveis),
                ['prompt' => 'Selecione um responsável', 'class' => 'form-control']
            )->label('Responsável') ?>
        </div>

        <div class="form-group">
            <?= $form->field($fornecedor, 'tipo')->dropDownList(
                array_combine($tipos, $tipos),
                ['prompt' => 'Selecione um tipo', 'class' => 'form-control']
            )->label('Tipo') ?>
        </div>
        <div class="form-group">
            <?= $form->field($fornecedor, 'nome_alojamento')->textInput(['class' => 'form-control'])->label('Nome do Alojamento') ?>
        </div>
        <div class="form-group">
            <?= $form->field($fornecedor, 'localizacao_alojamento')->textInput(['class' => 'form-control'])->label('Localização do Alojamento') ?>
        </div>
        <div class="form-group">
            <?php
            $acomodacoesSelecionadas = !empty($fornecedor->acomodacoes_alojamento)
                ? explode(';', $fornecedor->acomodacoes_alojamento)
                : [];

            echo $form->field($fornecedor, 'acomodacoes_alojamento[]')->checkboxList(
                [
                    'Cama de Casal' => 'Cama de Casal',
                    'Cama de Solteiro' => 'Cama de Solteiro',
                    'Wi-Fi' => 'Wi-Fi',
                    'TV' => 'TV',
                    'AC' => 'AC',
                    'WC Privativa' => 'WC Privativa',
                    'Pequeno Almoço' => 'Pequeno Almoço',
                    'Piscina' => 'Piscina',
                    'Estacionamento' => 'Estacionamento',
                ],
                [
                    'item' => function ($index, $label, $name, $checked, $value) use ($acomodacoesSelecionadas) {
                        $checked = in_array($value, $acomodacoesSelecionadas);
                        $checked = $checked ? 'checked' : '';
                        return "<label class='checkbox-inline'><input type='checkbox' $checked name='$name' value='$value'> $label</label>";
                    },
                ]
            )->label('Acomodações');
            ?>
        </div>
        <div class="form-group">
            <?php
            $tiposQuartosSelecionados = !empty($fornecedor->tipoquartos)
                ? explode(';', $fornecedor->tipoquartos)
                : [];

            echo $form->field($fornecedor, 'tipoquartos[]')->checkboxList(
                [
                    'Individual' => 'Individual',
                    'Duplo' => 'Duplo',
                    'Triplo' => 'Triplo',
                    'Familiares' => 'Familiares',
                    'Suite' => 'Suite',
                    'Villa' => 'Villa',
                ],
                [
                    'item' => function ($index, $label, $name, $checked, $value) use ($tiposQuartosSelecionados) {
                        $checked = in_array($value, $tiposQuartosSelecionados);
                        $checked = $checked ? 'checked' : '';
                        return "<label class='checkbox-inline'><input type='checkbox' $checked name='$name' value='$value'> $label</label>";
                    },
                ]
            )->label('Tipo de Quartos');
            ?>
        </div>
        <div class="form-group">
            <?= $form->field($fornecedor, 'numeroquartos')->textInput(['type' => 'number', 'min' => 1, 'class' => 'form-control'])->label('Número de Quartos') ?>
        </div>
        <div class="form-group">
            <?= $form->field($fornecedor, 'precopornoite')->textInput(['type' => 'number', 'min' => 0, 'class' => 'form-control'])->label('Preço por Noite') ?>
        </div>
        <div class="form-group">
            <?= $form->field($fornecedor, 'imagens[]')->fileInput(['multiple' => true])->label('Imagens') ?>
        </div>
        <div class="current-images">
            <?php foreach ($fornecedor->imagens as $imagem): ?>
                <?= Html::img($imagem->filename, ['class' => 'img-thumbnail', 'style' => 'max-width:100px; margin-right: 5px;']); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <?= Html::a('Cancelar', ['alojamentos/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="float-right">
                    <?= Html::submitButton('Editar Alojamento', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
