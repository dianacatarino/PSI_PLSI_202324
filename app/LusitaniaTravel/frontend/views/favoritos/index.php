<?php

use yii\helpers\Html;

$this->title = 'Favoritos';
?>

<div class="favoritos-container">
    <h1 class="mb-4">Meus Favoritos</h1>

    <?php if (empty($favoritos)): ?>
        <p>Você não tem nenhum favorito no momento.</p>
    <?php else: ?>
        <?php foreach ($favoritos as $fornecedorId => $isFavorite): ?>
            <?php
            $fornecedorNome = 'Nome do Alojamento ' . $fornecedorId;
            ?>

            <div class="card favorito-card">
                <div class="card-body">
                    <h5 class="card-title"><?= Html::encode($fornecedorNome) ?></h5>
                    <?= Html::a('Detalhes', ['favoritos/view', 'id' => $fornecedorId], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Remover dos Favoritos', ['favoritos/removerfavorito', 'id' => $fornecedorId], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Tem certeza que deseja remover dos favoritos?']]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
