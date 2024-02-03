<?php

use yii\helpers\Html;

$this->title = 'Favoritos';
?>

<div class="favoritos-container">
    <h3 class="mb-4">Os Meus Favoritos</h3>

    <?php if (empty($favoritos)): ?>
        <p>Não existem favoritos adicionados no momento.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($favoritos as $fornecedor): ?>
                <div class="col-md-4 mb-4">
                    <div class="card favorito-card">
                        <div class="card-body text-center">
                            <?php
                            $imagens = $fornecedor->imagens;

                            if (!empty($imagens)) {
                                $imagem = $imagens[0]; // Ajuste conforme necessário, dependendo da lógica que você deseja aplicar

                                if ($imagem->filename) {
                                    echo '<style>';
                                    echo '.custom-image-class {';
                                    echo '    width: 200px;';
                                    echo '    height: auto;';  // Altura ajustada automaticamente para manter a proporção
                                    echo '    object-fit: cover; /* Ensure the aspect ratio is maintained and the image covers the entire container */';
                                    echo '    margin: auto; /* Adicionado para centralizar a imagem */';
                                    echo '}';
                                    echo '</style>';
                                    echo Html::img($imagem->filename, ['class' => 'img-thumbnail custom-image-class']);
                                } else {
                                    echo 'Imagem não encontrada';
                                }
                            } else {
                                echo 'Nenhuma imagem disponível';
                            }
                            ?>
                            <h5 class="card-title"><?= Html::encode($fornecedor->nome_alojamento) ?></h5>
                            <p class="card-text"><strong>Tipo:</strong> <?= Html::encode($fornecedor->tipo) ?></p>
                            <p class="card-text"><strong>Localização:</strong> <?= Html::encode($fornecedor->localizacao_alojamento) ?></p>
                            <?= Html::a('Detalhes', ['favoritos/show', 'id' => $fornecedor->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Remover dos Favoritos', ['favoritos/remover', 'fornecedorId' => $fornecedor->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Tem certeza que deseja remover dos favoritos?']]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
