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
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">€ por noite</small>
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
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i> Camas</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>Casas de Banho</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i><?= Html::encode($fornecedor->acomodacoes_alojamento) ?></small>
                                </div>
                                <p class="text-body mb-3"><?= Html::encode($fornecedor->tipo) ?></p>
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