<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\PesquisaForm */

?>

<div class="card mb-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-4">
        <div class="position-relative">
                <?php
                $imagens = $model->imagens;

                if (!empty($imagens)) {
                    $imagem = $imagens[0];

                    if ($imagem->filename) {
                        echo '<style>';
                        echo '.custom-image-class {';
                        echo '    width: 500px;';
                        echo '    height: 250px;';
                        echo '    object-fit: cover; /* Ensure the aspect ratio is maintained and the image covers the entire container */';
                        echo '}';
                        echo '</style>';
                        echo Html::img($imagem->filename, ['class' => 'img-thumbnail custom-image-class']);
                    } else {
                        echo 'Imagem não encontrada';
                    }
                } else {
                    echo 'Nenhuma imagem disponível';
                }
                echo '<small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">';
                echo Yii::$app->formatter->asCurrency($model->precopornoite, 'EUR') . ' por noite';
                echo '</small>';
                ?>
            </div>
            <div class="p-4 mt-2">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">
                        <?= Html::encode($model->nome_alojamento) ?>
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <?php
                            // Obtém o perfil do usuário
                            $profile = Yii::$app->user->identity->profile;

                            // Verifica se a coluna favoritos está vazia ou nula e atribui um array vazio se for o caso
                            $favoritos = $profile->favorites ? json_decode($profile->favorites, true) : [];

                            // Verifica se o fornecedor atual está nos favoritos
                            $isFavorite = in_array($model->id, $favoritos);

                            // Exibe o ícone de favorito com base no status
                            $iconClass = $isFavorite ? 'fas fa-heart text-danger' : 'far fa-heart';

                            // URL para adicionar ou remover favorito
                            $addAction = Url::to(['favoritos/adicionar', 'fornecedorId' => $model->id]);
                            $removeAction = Url::to(['favoritos/remover', 'fornecedorId' => $model->id]);
                            ?>
                            <a href="<?= $isFavorite ? $removeAction : $addAction ?>" class="btn btn-link">
                                <i class="<?= $iconClass ?>"></i>
                            </a>
                        <?php endif; ?>
                    </h5>
                    <div class="ps-2">
                        <div class="ps-2">
                            <?php
                            $mediaClassificacoes = $model->getMediaClassificacoes();

                            if ($mediaClassificacoes !== null) {
                                // Exibindo estrelas com base na média das classificações
                                for ($i = 0; $i < $mediaClassificacoes; $i++) {
                                    echo '<small class="fa fa-star text-primary"></small>';
                                }
                            } else {
                                echo 'Sem avaliações';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <?php
                    $acomodacoes = $model->acomodacoes_alojamento; // Supondo que você tenha essa propriedade no modelo de alojamento

                    // Verificar o tipo de cama
                    $tipoDeCama = '';

                    switch (true) {
                        case (strpos($acomodacoes, 'Cama de Casal') !== false):
                            $tipoDeCama = '<i class="fa fa-bed text-primary me-2"></i> Cama de Casal';
                            break;
                        case (strpos($acomodacoes, 'Cama de Solteiro') !== false):
                            $tipoDeCama = '<i class="fa fa-bed text-primary me-2"></i> Cama de Solteiro';
                            break;
                    }

                    // Exibir a informação
                    if (!empty($tipoDeCama)) {
                        echo '<small class="border-end me-3 pe-3">' . $tipoDeCama . '</small>';
                    }

                    // Outras acomodações
                    $acomodacoesExtras = [
                        'Quartos Familiares' => '<small class="border-end me-3 pe-3"><i class="fa fa-users text-primary me-2"></i> Quartos Familiares </small>',
                        'WC Privativa' => '<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i> Casa de Banho Privativa </small>',
                        'Wi-Fi' => '<small class><i class="fa fa-wifi text-primary me-2"></i>  </small>',
                        'Estacionamento' => '<small><i class="fa fa-car text-primary me-2"></i>  </small>',
                        'Piscina' => '<small><i class="fa fa-swimming-pool text-primary me-2"></i>  </small>',
                        'Pequeno-almoço' => '<small><i class="fa fa-coffee text-primary me-2"></i>  </small>',
                        'Ar Condicionado' => '<small><i class="fa fa-snowflake text-primary me-2"></i> </small>',
                        'TV' => '<small><i class="fa fa-tv text-primary me-2"></i> </small>',
                    ];

                    foreach ($acomodacoesExtras as $keyword => $output) {
                        if (strpos($acomodacoes, $keyword) !== false) {
                            echo $output . '&nbsp;'; // Adicionando um espaço entre cada item
                        }
                    }
                    ?>
                </div>
                <p class="text-body mb-3"><?php
                    // Descrição automática
                    $descricaoAutomatica = '';

                    // Adicionar nome à descrição
                    $descricaoAutomatica .= "Bem-vindo ao {$model->nome_alojamento}. ";

                    // Adicionar tipo de alojamento à descrição
                    $descricaoAutomatica .= "Oferecemos alojamento do tipo {$model->tipo}. ";

                    // Adicionar localização à descrição
                    $descricaoAutomatica .= "Localizado em {$model->localizacao_alojamento}. ";

                    // Remover a vírgula no final da descrição
                    $descricaoAutomatica = rtrim($descricaoAutomatica, ', ');

                    // Exibir a descrição automática
                    echo $descricaoAutomatica;
                    ?></p>
                <div class="d-flex justify-content-between">
                    <?= Html::a('Detalhes', ['alojamentos/show', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('Adicionar ao Carrinho', ['carrinho/adicionar', 'fornecedorId' => $model->id], ['class' => 'btn btn-dark btn-sm']) ?>
                </div>
            </div>
        </div>
    </div>
