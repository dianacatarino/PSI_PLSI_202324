<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;

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
                    <th style="width: 10%">Id da Reserva</th>
                    <th style="width: 10%">Alojamento</th>
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->profile->role !== 'funcionario'): ?>
                    <th style="width: 1%">Ações</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($confirmacoes as $confirmacao): ?>
                    <tr>
                        <td><?= Html::encode($confirmacao->id) ?></td>
                        <td><?= Html::encode($confirmacao->estado) ?></td>
                        <td><?= Html::encode($confirmacao->dataconfirmacao) ?></td>
                        <td><?= Html::encode($confirmacao->reserva_id) ?></td>
                        <td><?= Html::encode($confirmacao->fornecedor->nome_alojamento) ?></td>
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->profile->role !== 'funcionario'): ?>
                        <td class="project-actions text-right">
                            <div class="btn-group">

                                    <?= Html::a('<i class="fas fa-folder"></i>', ['confirmacoes/show', 'id' => $confirmacao->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['confirmacoes/edit', 'id' => $confirmacao->id], ['class' => 'btn btn-info btn-sm']) ?>
                                    <?= Html::a('<i class="fas fa-trash"></i>', ['confirmacoes/delete', 'id' => $confirmacao->id], [
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>

                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <nav aria-label="Page navigation">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => ['class' => 'pagination justify-content-end'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                    'prevPageLabel' => '<span aria-hidden="true">&laquo;</span> <span class="sr-only">Anterior</span>',
                    'nextPageLabel' => '<span aria-hidden="true">&raquo;</span> <span class="sr-only">Próxima</span>',
                ]); ?>
            </nav>
        </div>
    </div>
</section>