<?php

use yii\helpers\Html;

$this->title = 'Gestão das Confirmações';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Confirmações</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Id</th>
                    <th style="width: 10%">Estado da Confirmação</th>
                    <th style="width: 10%">Data da Confirmação</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Confirmado</td>
                    <td>14-12-2023</td>
                    <td class="project-actions text-right">
                        <div class="btn-group">
                            <?= Html::a('<i class="fas fa-trash"></i>', ['confirmacoes/delete'], [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

