<?php

use yii\helpers\Html;

$this->title = 'Alojamentos';
?>
<div class="container-xxl bg-white p-0">


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Alojamentos</h1>
                <nav aria-label="breadcrumb" class="bg-dark">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Páginas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Alojamentos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Room Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Nossos Alojamentos</h6>
                <h1 class="mb-5">Explore os nossos <span class="text-primary text-uppercase">Alojamentos</span></h1>
            </div>
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
                                    <h5 class="mb-0"><?= Html::encode($fornecedor->nome_alojamento) ?></h5>
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
                                    <?= Html::a('Detalhes', ['alojamentos/view', 'id' => $fornecedor->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= Html::a('Reservar', ['reservas/create', 'id' => $fornecedor->id], ['class' => 'btn btn-dark btn-sm']) ?>
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