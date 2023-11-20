<?php

use yii\helpers\Html;

$this->title = 'Gestão da Empresa';
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

<div class="col-sm-6">
    <p>
        <?= Html::a('Criar nova empresa', ['empresa/create'], ['class' => 'btn btn-info']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Empresa</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Id</th>
                    <th style="width: 5%">Sede</th>
                    <th style="width: 5%">Capital Social</th>
                    <th style="width: 1%">Email</th>
                    <th style="width: 5%">Morada</th>
                    <th style="width: 1%">Localidade</th>
                    <th style="width: 1%">Nif</th>
                    <th style="width: 1%">Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Lusitânia Travel</td>
                    <td>1.000.000€</td>
                    <td>lusitaniatravel@email.com</td>
                    <td>Rua da Lusitânia Travel</td>
                    <td>Leiria</td>
                    <td>123456789</td>
                    <td class="project-actions text-right">
                        <div class="btn-group">
                            <?= Html::a('<i class="fas fa-folder"></i>', ['empresa/show'], ['class' => 'btn btn-primary btn-sm']) ?>
                            <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['empresa/edit'], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= Html::a('<i class="fas fa-trash"></i>', ['empresa/delete'], [
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