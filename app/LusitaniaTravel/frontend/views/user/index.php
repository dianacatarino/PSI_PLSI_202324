<?php

use common\models\User;
use yii\helpers\Html;

$this->title = 'Conta';
?>
<div class="container text-center">
    <div class="card conta-card">
        <div class="conta-header">
            <?php
            $utilizadorAtual = Yii::$app->user->identity;

            echo '<img src="/LusitaniaTravel/frontend/public/img/logo_icon.png" alt="Foto de Perfil">';

            if (!Yii::$app->user->isGuest) {
                // Obtém o modelo User associado ao utilizador atual
                $userModel = User::findOne($utilizadorAtual->id);

                // Obtém o perfil associado ao utilizador atual
                $profileModel = $userModel->getProfile()->one();

                // Exibir informações obtidas
                echo '<h2>' . Html::label('Username:')  . ' ' . Html::encode($userModel->username) . '</h2>';
                echo '<p>' . Html::label('Nome:') . ' ' . Html::encode($profileModel->name) . '</p>';
                echo '<p>' . Html::label('Email:') . ' ' . Html::encode($userModel->email) . '</p>';
                echo '<p>' . Html::label('Telefone:') . ' ' . Html::encode($profileModel->mobile) . '</p>';
                echo '<p>' . Html::label('Morada:') . ' ' . Html::encode($profileModel->street) . '</p>';
                echo '<p>' . Html::label('Localidade:') . ' ' . Html::encode($profileModel->locale) . '</p>';
                echo '<p>' . Html::label('Código Postal:') . ' ' . Html::encode($profileModel->postalCode) . '</p>';
            }
            ?>
        </div>

        <div class="conta-links">
            <button onclick="window.location.href='index.php?r=comentarios%2Findex'" class="btn btn-primary">
                <i class="fas fa-comments"></i> Os Meus Comentários
            </button>
            <button onclick="window.location.href='index.php?r=user%2Fdefinicoes'" class="btn btn-primary">
                <i class="fas fa-cog"></i> Definições
            </button>
            <button onclick="window.location.href='index.php?r=faturas%2Findex'" class="btn btn-primary">
                <i class="fas fa-file-invoice-dollar"></i> As Minhas Faturas
            </button>
        </div>
        <div style="height: 20px;"></div>
    </div>
    <div style="height: 20px;"></div>
</div>

