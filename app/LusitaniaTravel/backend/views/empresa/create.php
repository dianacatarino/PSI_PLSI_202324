<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar nova Empresa';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Empresa</h3>
    </div>
    <form action="caminho/para/store" method="post" class="container">
        <div class="card-body">
            <div class="form-group">
                <label for="empresa-nome" class="control-label">Nome</label>
                <input type="text" id="empresa-nome" class="form-control" name="Empresa[nome]">
            </div>
            <div class="form-group">
                <label for="empresa-capital_social" class="control-label">Capital Social</label>
                <input type="text" id="empresa-capital_social" class="form-control" name="Empresa[capital_social]">
            </div>
            <div class="form-group">
                <label for="empresa-email" class="control-label">Email</label>
                <input type="text" id="empresa-email" class="form-control" name="Empresa[email]">
            </div>
            <div class="form-group">
                <label for="empresa-morada" class="control-label">Morada</label>
                <input type="text" id="empresa-morada" class="form-control" name="Empresa[morada]">
            </div>
            <div class="form-group">
                <label for="empresa-localidade" class="control-label">Localidade</label>
                <input type="text" id="empresa-localidade" class="form-control" name="Empresa[localidade]">
            </div>
            <div class="form-group">
                <label for="empresa-nif" class="control-label">NIF</label>
                <input type="text" id="empresa-nif" class="form-control" name="Empresa[nif]">
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <div class="float-left">
                        <?= Html::a('Cancelar', ['empresa/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                    <div class="float-right">
                        <?= Html::submitButton('Criar Empresa', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
