<?php

use yii\helpers\Html;
use yii\bootstrap5\LinkPager;

$this->title = 'Gestão dos Alojamentos';
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

<?php if(Yii::$app->user->identity->profile->role === 'fornecedor'): ?>
    <div class="col-sm-6">
        <p>
            <?= Html::a('Criar novo Alojamento', ['alojamentos/create'], ['class' => 'btn btn-info']) ?>
        </p>
    </div>
<?php endif; ?>

<section class="content">
    <div class="card" >
        <div class="card-header">
            <h3 class="card-title">Alojamentos</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Nome</th>
                    <th style="width: 1%">Responsável</th>
                    <th style="width: 1%">Tipo</th>
                    <th style="width: 1%">Localização</th>
                    <th style="width: 1%">Acomodações</th>
                    <th style="width: 1%">Tipos Quartos</th>
                    <th style="width: 1%">Nº Quartos</th>
                    <th style="width: 1%">Preço p/noite</th>
                    <th style="width: 1%">Imagem</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <tr>
                        <td><?= Html::encode($fornecedor->nome_alojamento) ?></td>
                        <td><?= Html::encode($fornecedor->responsavel) ?></td>
                        <td><?= Html::encode($fornecedor->tipo) ?></td>
                        <td><?= Html::encode($fornecedor->localizacao_alojamento) ?></td>
                        <td><?= Html::encode($fornecedor->acomodacoes_alojamento) ?></td>
                        <td><?= Html::encode($fornecedor->tipoquartos) ?></td>
                        <td><?= Html::encode($fornecedor->numeroquartos) ?></td>
                        <td><?= Html::encode($fornecedor->precopornoite) ?>€</td>
                        <td>
                            <?php
                            $imagens = $fornecedor->imagens;
                            if (!empty($imagens)) {
                                $imagem = $imagens[0]; // Ajuste conforme necessário, dependendo da lógica que você deseja aplicar
                                echo Html::img($imagem->filename, ['class' => 'img-thumbnail', 'style' => 'max-width:60px;']);
                            }
                            ?>
                        </td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['alojamentos/show', 'id' => $fornecedor->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['alojamentos/edit', 'id' => $fornecedor->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['alojamentos/delete', 'id' => $fornecedor->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
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
                    'prevPageLabel' => '<span aria-hidden="true">&laquo;</span><span class="sr-only">Anterior</span>',
                    'nextPageLabel' => '<span aria-hidden="true">&raquo;</span><span class="sr-only">Próxima</span>',
                ]); ?>
            </nav>
        </div>
    </div>
</section>
