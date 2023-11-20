<?php

use yii\helpers\Html;

$this->title = 'Gestão dos Users';
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
        <?= Html::a('Criar novo user', ['user/create'], ['class' => 'btn btn-info']) ?>
    </p>
</div>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User </h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Id</th>
                    <th style="width: 1%">Username</th>
                    <th style="width: 1%">Nome</th>
                    <th style="width: 1%">Email</th>
                    <th style="width: 1%">Telefone</th>
                    <th style="width: 15%">Morada</th>
                    <th style="width: 1%">Localidade</th>
                    <th style="width: 15%">Código Postal</th>
                    <th style="width: 1%">Status</th>
                    <th style="width: 1%">Role</th>
                    <th style="width: 1%">User Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= Html::encode($user->username) ?></td>
                        <td><?= Html::encode($user->name) ?></td>
                        <td><?= Html::encode($user->email) ?></td>
                        <td><?= Html::encode($user->mobile) ?></td>
                        <td><?= Html::encode($user->street) ?></td>
                        <td><?= Html::encode($user->locale) ?></td>
                        <td><?= Html::encode($user->postalCode) ?></td>
                        <td><?= Html::encode($user->status) ?></td>
                        <td><?= Html::encode($user->role) ?></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['user/show', 'id' => $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['user/edit', 'id' => $user->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['user/delete', 'id' => $user->id], [
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
    </div>
</section>
