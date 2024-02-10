<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;

$this->title = 'Gestão dos Comentários';
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
            <h3 class="card-title">Comentários</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Id</th>
                    <th style="width: 5%">Alojamento</th>
                    <th style="width: 20%">Título</th>
                    <th style="width: 20%">Comentário da estadia</th>
                    <th style="width: 10%">Cliente</th>
                    <th style="width: 20%">Data do Comentário</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comentarios as $comentario): ?>
                    <tr>
                        <td><?= Html::encode($comentario->id) ?></td>
                        <td><?= Html::encode($comentario->fornecedor->nome_alojamento) ?></td>
                        <td><?= Html::encode($comentario->titulo) ?></td>
                        <td><?= Html::encode($comentario->descricao) ?></td>
                        <td><?= Html::encode($comentario->cliente->profile->name) ?></td>
                        <td><?= Html::encode($comentario->data_comentario)?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['comentarios/show', 'id' => $comentario->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            </div>
                        </td>
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
