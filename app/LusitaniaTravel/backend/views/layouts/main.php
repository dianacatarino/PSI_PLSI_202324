<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;


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

<?php
$userRole = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->profile->role;

// Define as opções de exibição com base na função do usuário
switch ($userRole) {
    case 'fornecedor':
        $alojamentosDisplay = '';
        $confirmacoesDisplay = '';
        $comentariosDisplay = '';
        $avaliacoesDisplay = '';
        $reservasDisplay = 'style="display: none;"';
        $faturasDisplay = 'style="display: none;"';
        $usersDisplay = 'style="display: none;"';
        $empresaDisplay = 'style="display: none;"';
        break;

    case 'funcionario':
        $alojamentosDisplay = '';
        $confirmacoesDisplay = '';
        $comentariosDisplay = '';
        $avaliacoesDisplay = '';
        $reservasDisplay = '';
        $faturasDisplay = '';
        $usersDisplay = 'style="display: none;"';
        $empresaDisplay = 'style="display: none;"';
        break;

    case 'admin':
        $alojamentosDisplay = '';
        $confirmacoesDisplay = '';
        $comentariosDisplay = '';
        $avaliacoesDisplay = '';
        $reservasDisplay = '';
        $faturasDisplay = '';
        $usersDisplay = '';
        $empresaDisplay = '';
        break;

    default:
        // Usuário não logado ou função desconhecida
        $alojamentosDisplay = 'style="display: none;"';
        $confirmacoesDisplay = 'style="display: none;"';
        $comentariosDisplay = 'style="display: none;"';
        $avaliacoesDisplay = 'style="display: none;"';
        $reservasDisplay = 'style="display: none;"';
        $faturasDisplay = 'style="display: none;"';
        $usersDisplay = 'style="display: none;"';
        $empresaDisplay = 'style="display: none;"';
        break;
}
?>

<header>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->profile->role === 'admin'): ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Home</a>
            </li>
            <?php endif; ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= Url::to(['site/contact']) ?>" class="nav-link">Contacto</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <!-- Logout Button/Link -->
            <?php if (!Yii::$app->user->isGuest) {
                echo Html::a(
                    'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                    ['/site/logout'],
                    ['class' => 'nav-link', 'data-method' => 'post']
                );
            } ?>
    </nav>
    <!-- /.navbar -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <?= $content ?>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
</header>

<main role="main" class="flex-shrink-0">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="/LusitaniaTravel/frontend/public/img/logo_icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">Lusitânia Travel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <a href="<?= Url::to(['site/perfil']) ?>" class="d-block"><?= Yii::$app->user->identity->username ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <li class="nav-item">
                            <a href="<?= Url::to(['site/index']) ?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item" <?= $empresaDisplay ?>>
                        <a href="<?= Url::to(['empresa/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Empresa</p>
                        </a>
                    </li>
                    <li class="nav-item" <?= $alojamentosDisplay ?>>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Alojamentos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if ($userRole === 'fornecedor'): ?>
                            <li class="nav-item">
                                <a href="<?= Url::to(['alojamentos/create']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar Alojamentos</p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?= Url::to(['alojamentos/index']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lista dos Alojamentos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" <?= $reservasDisplay ?>>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Reservas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= Url::to(['reservas/create']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar Reservas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= Url::to(['reservas/index']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lista das Reservas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" <?= $usersDisplay ?>>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= Url::to(['user/create']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Criar Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= Url::to(['user/index']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lista dos Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" <?= $confirmacoesDisplay ?>>
                        <a href="<?= Url::to(['confirmacoes/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>Confirmações</p>
                        </a>
                    </li>
                    <li class="nav-item" <?= $faturasDisplay ?>>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Faturas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= Url::to(['faturas/create']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Emitir Faturas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= Url::to(['faturas/index']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lista das Faturas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" <?= $comentariosDisplay ?>>
                        <a href="<?= Url::to(['comentarios/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-comment"></i>
                            <p>Comentários</p>
                        </a>
                    </li>
                    <li class="nav-item" <?= $avaliacoesDisplay ?>>
                        <a href="<?= Url::to(['avaliacoes/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Avaliações</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</main>

<footer class="footer mt-auto py-3 text-muted">

</footer>

<?php $this->endBody() ?>
</body>

<?php $this->endPage();?>
</html>