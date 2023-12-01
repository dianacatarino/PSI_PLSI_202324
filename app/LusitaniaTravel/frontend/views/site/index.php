<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

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
                                <div class="col-md-3">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                               placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Pessoas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Quartos</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
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
</div>
