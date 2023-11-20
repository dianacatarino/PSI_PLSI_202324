<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar novo Alojamento';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Alojamento</h3>
    </div>
    <form action="caminho/para/store" method="post" class="container">
        <div class="card-body">
            <div class="form-group">
                <label for="responsavel" class="control-label">Responsável</label>
                <input type="text" id="responsavel" class="form-control" name="responsavel">
            </div>
            <div class="form-group">
                <label for="tipo" class="control-label">Tipo</label>
                <input type="text" id="tipo" class="form-control" name="tipo">
            </div>
            <div class="form-group">
                <label for="nome_alojamento" class="control-label">Nome</label>
                <input type="text" id="nome_alojamento" class="form-control" name="nome_alojamento">
            </div>
            <div class="form-group">
                <label for="localizacao_alojamento" class="control-label">Localização</label>
                <input type="text" id="localizacao_alojamento" class="form-control" name="localizacao_alojamento">
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <div class="float-left">
                        <?= Html::a('Cancelar', ['alojamentos/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                    <div class="float-right">
                        <?= Html::submitButton('Criar Alojamento', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
