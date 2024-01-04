<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Fornecedor;
use common\models\Profile;
use common\models\Reserva;
use backend\models\Empresa;

$this->title = 'Fatura Emitida';

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <img src="/LusitaniaTravel/common/public/img/logo_icon.png" alt="Lusitania Travel" width="20" height="20">
                                Fatura
                                <small class="float-right"><?= $fatura->data ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            De
                            <address>
                                <tr>
                                    <strong><td><?= Html::encode($empresa->sede) ?></td></strong><br>
                                    <td><?= Html::encode($empresa->email) ?></td><br>
                                    <td><?= Html::encode($empresa->morada) ?></td>
                                    <td> - <?= Html::encode($empresa->localidade) ?></td><br>
                                    <td><?= Html::encode($empresa->nif) ?></td><br>
                                </tr>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Para
                            <address>
                                <?php if ($reserva && $reserva->cliente): ?>
                                    <tr>
                                        <strong><td><?= Html::encode($reserva->cliente->profile->name) ?></td></strong><br>
                                        <td><?= Html::encode($reserva->cliente->email) ?></td><br>
                                        <td><?= Html::encode($reserva->cliente->profile->street) ?></td>
                                        <td> - <?= Html::encode($reserva->cliente->profile->locale) ?></td><br>
                                        <td><?= Html::encode($reserva->cliente->profile->postalCode) ?></td><br>
                                    </tr>
                                <?php else: ?>
                                    <p>Cliente not found</p>
                                <?php endif; ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Fatura <?= $fatura->id ?></b><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Referência</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    if($linhasfaturas == null){
                                        return ;
                                    }
                                    foreach ($linhasfaturas as $linhasfatura): ?>
                                        <th><?= Html::encode($linhasfatura->id) ?></th>
                                        <th><?= Html::encode($linhasfatura->quantidade) ?></th>
                                        <th><?= Html::encode($linhasfatura->precounitario) ?></th>
                                        <th><?= Html::encode($linhasfatura->subtotal) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                        <tr>
                                            <th>Iva:</th>
                                            <td><?= Html::encode($fatura->iva * 100) ?>%</td>
                                        </tr>
                                        <tr>
                                            <th>Valor Total:</th>
                                            <td><?= Html::encode($fatura->totalsi) ?>€</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><?= Html::encode($fatura->totalf) ?>€</td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <?= Html::a(
                                '<i class="fas fa-download"></i> Gerar PDF',
                                ['faturas/download', 'id' => $fatura->id],
                                ['class' => 'btn btn-primary float-right', 'style' => 'margin-right: 5px;', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>

                    <!-- Rodapé -->
                    <footer class="invoice-footer">
                        <div class="row">
                            <div class="col-12">
                                <p>Emissão realizada por: <strong><?= Html::encode($reserva->funcionario->profile->name) ?></strong></p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->

