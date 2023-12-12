<?php

use yii\helpers\Html;

$this->title = 'Favoritos';
?>

<div class="favoritos-container">
    <h3 class="mb-4">Os Meus Favoritos</h3>

    <?php if (empty($favoritos)): ?>
        <p>Você não tem nenhum favorito no momento.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($favoritos as $fornecedor): ?>
                <div class="col-md-4 mb-4">
                    <div class="card favorito-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($fornecedor->nome_alojamento) ?></h5>
                            <p class="card-text"><?= Html::encode($fornecedor->tipo) ?></p>
                            <?= Html::a('Detalhes', ['favoritos/show', 'id' => $fornecedor->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Remover dos Favoritos', ['favoritos/remover', 'fornecedorId' => $fornecedor->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Tem certeza que deseja remover dos favoritos?']]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
