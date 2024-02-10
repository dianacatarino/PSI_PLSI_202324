<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;

$this->title = 'Gestão dos Avaliações';
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
                    <th style="width: 1%">Id</th>
                    <th style="width: 5%">Alojamento</th>
                    <th style="width: 10%">Avaliação Geral (0-5)</th>
                    <th style="width: 5%">Cliente</th>
                    <th style="width: 5%">Data da Avaliação</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($avaliacoes as $avaliacao): ?>
                    <tr>
                        <td><?= Html::encode( $avaliacao->id) ?></td>
                        <td><?= Html::encode($avaliacao->fornecedor->nome_alojamento) ?></td>
                        <td><?= Html::encode($avaliacao->classificacao) ?></td>
                        <td><?= Html::encode($avaliacao->cliente->profile->name) ?></td>
                        <td><?= Html::encode($avaliacao->data_avaliacao) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['avaliacoes/show', 'id' => $avaliacao->id], ['class' => 'btn btn-primary btn-sm']) ?>
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

