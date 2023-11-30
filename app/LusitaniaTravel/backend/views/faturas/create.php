<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Emitir Fatura';

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
                                    <strong><td><?=$empresa->sede?></td></strong><br>
                                    <td><?=$empresa->capitalsocial?></td>
                                    <td><?=$empresa->email?></td>
                                    <td><?=$empresa->morada?></td><br>
                                    <td><?=$empresa->localidade?></td><br>
                                    <td><?=$empresa->nif?></td><br>
                                </tr>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>Cliente</strong>
                                <a href="#" class="btn btn-info" role="button">Selecionar Cliente</a>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Fatura #007612</b><br>
                            <br>
                            <b>Fatura ID: </b> 1 <br>
                            <b>Data Pagamento: </b><?= date('d-m-Y') ?><br>
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
                                    <th>ID da Fatura</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Percentagem de Iva</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th><?=$faturas->id?></th>
                                    <th><?=$linhasfaturas->quantidade?></th>
                                    <th><?=$linhasfaturas->precounitario?></th>
                                    <th><?=$linhasfaturas->iva?></th>
                                    <th><?=$linhasfaturas->subtotal?></th>
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
                                    <tr>
                                        <th>Valor do Iva</th>
                                        <td>Variável tem de ser adicionada na BD</td>
                                    </tr>
                                    <tr>
                                        <th>Valor total sem IVA:</th>
                                        <td><?=$faturas->totalsi?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td><?=$faturas->totalf?></td>
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
                                <p>Emissão realizada por: <strong><?=$profile->name?></strong></p>
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

