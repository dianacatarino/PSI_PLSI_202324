<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Lusitânia Travel';
?>
<div class="site-index">
    <div class="body-content">

        <div class="container-fluid p-0 mb-5">
            <div class="d-flex justify-content-center">
                <img src="/LusitaniaTravel/frontend/public/img/logo_vertical.png" alt="Image" style="max-width: 500px; height: auto;">
            </div>
        </div>


        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="localizacao" placeholder="Localização">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="checkin" placeholder="Check-in">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="checkout" placeholder="Check-out">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select">
                                        <option selected>Pessoas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select">
                                        <option selected>Quartos</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Procurar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->

        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <?php foreach ($fornecedores as $fornecedor): ?>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="room-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <?php
                                    $imagens = $fornecedor->imagens;

                                    if (!empty($imagens)) {
                                        $imagem = $imagens[0]; // Ajuste conforme necessário, dependendo da lógica que você deseja aplicar

                                        if ($imagem->filename) {
                                            echo Html::img($imagem->filename, ['class' => 'img-thumbnail']);
                                        } else {
                                            echo 'Imagem não encontrada';
                                        }
                                    } else {
                                        echo 'Nenhuma imagem disponível';
                                    }
                                    ?>
                                    <?php foreach ($fornecedor->reservas as $reserva) {
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
                                            <?= Html::encode($fornecedor->nome_alojamento) ?>
                                            <?php if (!Yii::$app->user->isGuest): ?>
                                                <?php
                                                // Obtém o perfil do usuário
                                                $profile = Yii::$app->user->identity->profile;

                                                // Verifica se a coluna favoritos está vazia ou nula e atribui um array vazio se for o caso
                                                $favoritos = $profile->favorites ? json_decode($profile->favorites, true) : [];

                                                // Verifica se o fornecedor atual está nos favoritos
                                                $isFavorite = in_array($fornecedor->id, $favoritos);

                                                // Exibe o ícone de favorito com base no status
                                                $iconClass = $isFavorite ? 'fas fa-heart text-danger' : 'far fa-heart';

                                                // URL para adicionar ou remover favorito
                                                $addAction = Url::to(['favoritos/adicionar', 'fornecedorId' => $fornecedor->id]);
                                                $removeAction = Url::to(['favoritos/remover', 'fornecedorId' => $fornecedor->id]);
                                                ?>
                                                <a href="<?= $isFavorite ? $removeAction : $addAction ?>" class="btn btn-link">
                                                    <i class="<?= $iconClass ?>"></i>
                                                </a>
                                            <?php endif; ?>
                                        </h5>
                                        <div class="ps-2">
                                            <!-- <div class="ps-2">
                                            <?php
                                            // Exemplo de como exibir estrelas com base na classificação do alojamento
                                            // for ($i = 0; $i < $alojamento->classificacao; $i++) {
                                            //     echo '<small class="fa fa-star text-primary"></small>';
                                            // }
                                            ?>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <?php
                                        $acomodacoes = $fornecedor->acomodacoes_alojamento; // Supondo que você tenha essa propriedade no modelo de alojamento

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
                                        $descricaoAutomatica .= "Bem-vindo ao {$fornecedor->nome_alojamento}. ";

                                        // Adicionar tipo de alojamento à descrição
                                        $descricaoAutomatica .= "Oferecemos alojamento do tipo {$fornecedor->tipo}. ";

                                        // Adicionar localização à descrição
                                        $descricaoAutomatica .= "Localizado em {$fornecedor->localizacao_alojamento}. ";

                                        // Remover a vírgula no final da descrição
                                        $descricaoAutomatica = rtrim($descricaoAutomatica, ', ');

                                        // Exibir a descrição automática
                                        echo $descricaoAutomatica;
                                        ?></p>
                                    <div class="d-flex justify-content-between">
                                        <?= Html::a('Detalhes', ['alojamentos/show', 'id' => $fornecedor->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                        <?= Html::a('Adicionar ao Carrinho', ['carrinho/create', 'fornecedorId' => $fornecedor->id], ['class' => 'btn btn-dark btn-sm']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim do loop -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- Room End -->

    </div>
</div>
