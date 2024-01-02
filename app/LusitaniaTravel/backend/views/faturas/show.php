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
                                <i class="fas fa-globe"></i> Fatura
                                <small class="float-right"><?= date('d-m-Y') ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <tr>
                                    <strong><td><?= Html::encode($empresa->sede) ?></td></strong><br>
                                    <td><?= Html::encode($empresa->capitalsocial) ?></td><br>
                                    <td><?= Html::encode($empresa->email) ?></td><br>
                                    <td><?= Html::encode($empresa->morada) ?></td><br>
                                    <td><?= Html::encode($empresa->localidade) ?></td><br>
                                    <td><?= Html::encode($empresa->nif) ?></td><br>
                                </tr>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>Cliente nº <?= Html::encode($reserva->cliente_id) ?></strong>
                                <strong>Nome: <?= Html::encode($reserva->cliente->profile->name) ?></strong>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <!-- ?php foreach ($faturas as $fatura): ? -->
                            <b>Fatura #007612</b><br>
                            <br>
                            <b><!-- = Html::encode($fatura->id) ?--></b><br>
                            <b>Data Pagamento: </b><?= date('d-m-Y') ?><br>
                            <!-- ?php endforeach; ?-->
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
                                    <th>Iva</th>
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
                                        <th><?= Html::encode($linhasfatura->quantidade) ?></th>
                                        <th><?= Html::encode($linhasfatura->precounitario) ?></th>
                                        <th><?= Html::encode($linhasfatura->iva) ?></th>
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
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Métodos de Pagamento:</p>
                            <img src="/LusitaniaTravel/backend/web/dist/img/credit/visa.png" alt="Visa">
                            <img src="/LusitaniaTravel/backend/web/dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="/LusitaniaTravel/backend/web/dist/img/credit/american-express.png" alt="American Express">
                            <img src="/LusitaniaTravel/backend/web/dist/img/credit/paypal2.png" alt="Paypal">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <?php foreach ($linhasfaturas as $linhasfatura): ?>
                                        <tr>
                                            <th>Iva Total:</th>
                                            <td><?= Html::encode($linhasfatura->subtotal) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Valor Total:</th>
                                            <td><?= Html::encode($linhasfatura->subtotal) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><?= Html::encode($linhasfatura->subtotal) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submeter
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div>

                    <!-- Rodapé -->
                    <footer class="invoice-footer">
                        <div class="row">
                            <div class="col-12">
                                <p>Emissão realizada por: <strong><?= Html::encode($reserva->funcionario_id) ?></strong></p>
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

