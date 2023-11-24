<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="icon" href="/LusitaniaTravel/frontend/public/img/logo_icon.png" type="image/x-icon">
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <img src="/LusitaniaTravel/frontend/public/img/logo_icon.png" alt="Lusitania Travel Logo" style="width: 85px; height: 80px;">
                    </a>
                </div>
                <div class="col-lg-9">
                    <?php
                    NavBar::begin([
                        'options' => [
                            'class' => 'navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0',
                        ],
                    ]);
                    ?>

                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 text-primary text-uppercase">Lusitânia Travel</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php
                    echo '<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">';
                    echo '<div class="navbar-nav mr-auto py-0">';
                    echo Html::a('Home', ['site/index'], ['class' => 'nav-item nav-link active']);
                    echo Html::a('Pesquisar', ['site/pesquisa'], ['class' => 'nav-item nav-link']);

                    if (Yii::$app->user->isGuest) {
                        echo Html::a('Alojamentos', ['alojamentos/index'], ['class' => 'nav-item nav-link']);
                    } else {
                        echo Html::a('Reservas', ['reservas/index'], ['class' => 'nav-item nav-link']);
                        echo Html::a('Favoritos', ['favoritos/index'], ['class' => 'nav-item nav-link']);
                        echo Html::a('Conta', ['user/index'], ['class' => 'nav-item nav-link']);
                    }

                    echo Html::a('Sobre', ['site/about'], ['class' => 'nav-item nav-link']);
                    echo Html::a('Contacto', ['site/contact'], ['class' => 'nav-item nav-link']);
                    echo '</div>';

                    echo '<div class="d-none d-lg-block">';

                    if (Yii::$app->user->isGuest) {
                        echo Html::a('Sign Up', ['site/register'], ['class' => 'btn btn-secondary rounded-0 py-4 px-md-5 mr-2']);
                        echo Html::a('Sign In', ['site/login'], ['class' => 'btn btn-success rounded-0 py-4 px-md-5']);
                    } else {
                        echo Html::a(
                            '<i class="fas fa-shopping-cart"></i>',
                            ['site/carrinho'],
                            ['class' => 'btn btn-info rounded-0 py-4 px-md-5 ml-2']
                        );
                        echo Html::tag('span', Yii::$app->user->identity->username, ['class' => 'btn btn-secondary rounded-0 py-4 px-md-5 mr-2']);
                        echo Html::a(
                            'Logout',
                            ['site/logout'],
                            [
                                'data' => ['method' => 'post'],
                                'class' => 'btn btn-success rounded-0 py-4 px-md-5',
                            ]);
                    }

                    echo '</div>';
                    echo '</div>';

                    NavBar::end();
                    ?>
                </div>
            </div>
        </div>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container" >
            <div class="row g-5 bg-dark">
                <div class="col-md-6 col-lg-4">
                    <div class="bg-primary rounded p-4">
                        <a href="index.php">
                            <h1 class="text-white text-uppercase mb-3"><img src="/LusitaniaTravel/frontend/public/img/logo_icon.png" alt="Lusitania Travel Logo" style="width: 85px; height: 80px;">Lusitânia Travel
                            </h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6 class="section-title text-start text-primary text-uppercase mb-4">Contactos</h6>
                    <p class="mb-2 text-white"><i class="fa fa-map-marker-alt me-3"></i>Leiria</p>
                    <p class="mb-2 text-white"><i class="fa fa-phone-alt me-3"></i>262 987 654</p>
                    <p class="mb-2 text-white"><i class="fa fa-envelope me-3"></i>lusitaniatravel@gmail.com</p>
                </div>

                <div class="col-lg-5 col-md-12 text-dark">
                    <div class="row gy-5 g-4">
                        <div class="col-md-6">
                            <h6 class="section-title text-start text-primary text-uppercase mb-4">Empresa</h6>
                            <a class="btn btn-link" href="">Sobre nós</a>
                            <a class="btn btn-link" href="">Contactos</a>
                            <a class="btn btn-link" href="">Política de Privacidade</a>
                            <a class="btn btn-link" href="">Termos e Condições</a>
                            <a class="btn btn-link" href="">Suporte</a>
                        </div>
                        <div class="col-md-6">
                            <h6 class="section-title text-start text-primary text-uppercase mb-4">Alojamentos</h6>
                            <a class="btn btn-link" href="">Comida & Restaurante</a>
                            <a class="btn btn-link" href="">Spa & Fitness</a>
                            <a class="btn btn-link" href="">Desportos & Gaming</a>
                            <a class="btn btn-link" href="">Eventos & Festa</a>
                            <a class="btn btn-link" href="">Ginásio & Yoga</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 text-dark" style="margin-bottom: 10px;">
                    &copy; <a class="border-bottom" href="#">Lusitânia Travel</a>, All Right Reserved.
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
                <div class="col-md-6 text-center text-md-end text-dark">
                    <div class="footer-menu">
                        <a class="text-dark" href="">Home</a>
                        <a class="text-dark" href="">Cookies</a>
                        <a class="text-dark" href="">Help</a>
                        <a class="text-dark" href="">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();