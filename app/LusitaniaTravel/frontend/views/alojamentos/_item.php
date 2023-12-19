<?php

use yii\helpers\Html;

/* @var $model app\models\Fornecedor */

?>

<div class="room-item shadow rounded overflow-hidden">
    <div class="position-relative">
        <?php
        $imagens = $model->imagens;

        if (!empty($imagens)) {
            $imagem = $imagens[0];

            if ($imagem->filename) {
                echo Html::img($imagem->filename, ['class' => 'img-thumbnail']);
            } else {
                echo 'Imagem não encontrada';
            }
        } else {
            echo 'Nenhuma imagem disponível';
        }

        foreach ($model->reservas as $reserva) {
            foreach ($reserva->linhasreservas as $linha):
                $formattedValue = Yii::$app->formatter->asCurrency($linha->subtotal, 'EUR');

                echo '<small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">';
                echo $formattedValue . ' por noite';
                echo '</small>';
            endforeach;
        }
        ?>
    </div>
    <div class="p-4 mt-2">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="mb-0">
                <?= Html::encode($model->nome_alojamento) ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php
                    $favoritos = Yii::$app->user->identity->profile->favorites ? json_decode(Yii::$app->user->identity->profile->favorites, true) : [];
                    $isFavorite = in_array($model->id, $favoritos);
                    $iconClass = $isFavorite ? 'fas fa-heart text-danger' : 'far fa-heart';
                    $addAction = Yii::$app->urlManager->createUrl(['favoritos/adicionar', 'fornecedorId' => $model->id]);
                    $removeAction = Yii::$app->urlManager->createUrl(['favoritos/remover', 'fornecedorId' => $model->id]);
                    ?>
                    <a href="<?= $isFavorite ? $removeAction : $addAction ?>" class="btn btn-link">
                        <i class="<?= $iconClass ?>"></i>
                    </a>
                <?php endif; ?>
            </h5>
        </div>
        <div class="d-flex mb-3">
            <?php
            $acomodacoes = $model->acomodacoes_alojamento;

            $tipoDeCama = '';

            switch (true) {
                case (strpos($acomodacoes, 'Cama de Casal') !== false):
                    $tipoDeCama = '<i class="fa fa-bed text-primary me-2"></i> Cama de Casal';
                    break;
                case (strpos($acomodacoes, 'Cama de Solteiro') !== false):
                    $tipoDeCama = '<i class="fa fa-bed text-primary me-2"></i> Cama de Solteiro';
                    break;
            }

            if (!empty($tipoDeCama)) {
                echo '<small class="border-end me-3 pe-3">' . $tipoDeCama . '</small>';
            }

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
                    echo $output . '&nbsp;';
                }
            }
            ?>
        </div>
        <p class="text-body mb-3"><?php
            $descricaoAutomatica = '';
            $descricaoAutomatica .= "Bem-vindo ao {$model->nome_alojamento}. ";
            $descricaoAutomatica .= "Oferecemos alojamento do tipo {$model->tipo}. ";
            $descricaoAutomatica .= "Localizado em {$model->localizacao_alojamento}. ";
            $descricaoAutomatica = rtrim($descricaoAutomatica, ', ');
            echo $descricaoAutomatica;
            ?></p>
        <div class="d-flex justify-content-between">
            <?= Html::a('Detalhes', ['alojamentos/show', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('Adicionar ao Carrinho', ['carrinho/adicionar', 'fornecedorId' => $model->id], ['class' => 'btn btn-dark btn-sm']) ?>
        </div>
    </div>
</div>

