<?php

use yii\helpers\Html;

$this->title = 'Gestão das Avaliações';
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
            <h3 class="card-title">Avaliações</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 20%">Id do Alojamento</th>
                    <th style="width: 20%">Avaliação Geral (0-10)</th>
                    <th style="width: 20%">Data da Avaliação</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>13</td>
                    <td>8</td>
                    <td>29-04-2024</td>
                    <td class="project-actions text-right">
                        <div class="btn-group">
                            <?= Html::a('<i class="fas fa-trash"></i>', ['avaliacoes/delete'], [
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
