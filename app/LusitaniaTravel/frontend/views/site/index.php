<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Lusitânia Travel';
?>
<div class="site-index">
    <div class="body-content">

        <div class="container-fluid p-0 mb-5">
            <div class="d-flex justify-content-center">
                <img src="/LusitaniaTravel/frontend/public/img/logo_vertical.png" alt="Image" style="max-width: 500px; height: auto;">
            </div>
        </div>


        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Os Nossos Alojamentos</h6>
            <h1 class="mb-5">Explore os nossos <span class="text-primary text-uppercase">Alojamentos</span></h1>
        </div>

        <div style="height: 20px;"></div>

        <div class="container">
            <div class="row">
                <?php if (!$searchModel->validate() || !$dataProvider || !$fornecedores) : ?>
                    <?= ListView::widget([
                        'dataProvider' => $fornecedores,
                        'itemView' => '_item',
                        'summary' => '',
                        'options' => ['class' => 'list-view'],
                        'itemOptions' => [
                            'class' => 'col-md-4',
                            'style' => 'margin-bottom: 15px;',
                        ],
                        'layout' => '<div class="row">{items}</div>{pager}',
                    ]) ?>
                <?php else : ?>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_item',
                        'summary' => '',
                        'options' => ['class' => 'list-view'],
                        'itemOptions' => [
                            'class' => 'col-md-4',
                            'style' => 'margin-bottom: 15px;',
                        ],
                        'layout' => '<div class="row">{items}</div>{pager}',
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
