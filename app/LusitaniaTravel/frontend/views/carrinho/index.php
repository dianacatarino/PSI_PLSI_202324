<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Carrinho de Compras';

$this->registerJsFile('https://code.jquery.com/jquery-3.6.4.min.js', ['position' => \yii\web\View::POS_HEAD]);

$script = <<< JS
    $(document).ready(function() {
        // Oculte o botão "Verificar Disponibilidade" no início
        $('#verificar-disponibilidade-btn').hide();

        $('input[name="selecionarReserva[]"]').change(function() {
            var selectedReservas = $('input[name="selecionarReserva[]"]:checked');
            
            // Esconda todos os campos de formulário
            $('.reserva-form').hide();
            
            // Mostre apenas os campos de formulário correspondentes às reservas selecionadas
            selectedReservas.each(function() {
                var reservaId = $(this).val();
                $('.reserva-form[data-reserva-id="' + reservaId + '"]').show();
            });

            // Se houver pelo menos uma reserva selecionada, mostre o botão
            if (selectedReservas.length > 0) {
                $('#verificar-disponibilidade-btn').show();
            } else {
                // Caso contrário, oculte o botão
                $('#verificar-disponibilidade-btn').hide();
            }
        });

        // Esconda todos os tipoquarto-campos inicialmente
        $('.tipoquarto-campos').hide();

        // Show/hide tipoquarto-campos based on the selected number of rooms
        $('input[name="Reserva[numeroquartos]"]').change(function() {
            var numeroquartos = parseInt($(this).val());

            // Hide all tipoquarto-campos
            $('.tipoquarto-campos').hide();

            // Show tipoquarto-campos based on the selected number of rooms
            if (numeroquartos > 0) {
                for (var i = 1; i <= numeroquartos; i++) {
                    $('.tipoquarto-campos[data-quarto-index="' + i + '"]').show();
                }
            }
        });
    });
JS;

$this->registerJs($script);

// Check if there are items in the cart
$hasItemsInCart = !empty($itensCarrinho);
?>

<div class="container mt-4">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php $form = ActiveForm::begin(['method' => 'post', 'action' => ['reservas/verificar']]); ?>

    <?php foreach ($itensCarrinho as $item) : ?>
        <?php
        // Verifica se as linhas de reserva já foram criadas
        $linhasReservasCriadas = !empty($item->reserva->linhasreservas);
        ?>

        <div class="form-group row m-3 reserva-form <?= $linhasReservasCriadas ? 'd-none' : '' ?>" data-reserva-id="<?= $item->reserva->id ?>">
            <div class="col-md-3">
                <?= Html::hiddenInput('reservaId', $item->reserva->id) ?>
                <?= $form->field($reserva, 'checkin')->textInput(['type' => 'date', 'class' => 'form-control checkin'])->label('Check-in') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($reserva, 'checkout')->textInput(['type' => 'date', 'class' => 'form-control checkout'])->label('Check-out') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($reserva, 'numeroclientes')->textInput(['type' => 'number', 'class' => 'form-control numeroclientes', 'min' => 1, 'max' => 10])->label('Número de Clientes') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($reserva, 'numeroquartos')->textInput(['type' => 'number', 'class' => 'form-control numeroquartos', 'min' => 1, 'max' => 6])->label('Número de Quartos') ?>
            </div>

            <?php for ($i = 1; $i <= 6; $i++) : ?>
                <div class="col-md-3 tipoquarto-campos" data-quarto-index="<?= $i ?>">
                    <?= $form->field($reserva, "linhasreservas[{$item->reserva->id}][tipoquarto][$i]")->dropDownList(
                        ['Quarto Individual' => 'Quarto Individual', 'Quarto Duplo' => 'Quarto Duplo', 'Quarto Triplo' => 'Quarto Triplo', 'Quarto Familiar' => 'Quarto Familiar', 'Villa' => 'Villa'],
                        ['class' => 'form-control tipoquarto', 'prompt' => 'Seleciona o tipo de quarto']
                    )->label("Tipo de Quarto {$i}") ?>

                    <?= $form->field($reserva, "linhasreservas[{$item->reserva->id}][numerocamas][$i]")->textInput(['type' => 'number', 'class' => 'form-control numerocamas', 'min' => 1, 'max' => 6])->label('Número de Camas') ?>
                </div>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>

    <div class="col-md-12 mt-2">
        <?php
        // Show the button only if there are items in the cart
        if ($hasItemsInCart) {
            echo Html::submitButton('Verificar Disponibilidade', ['class' => 'btn btn-primary']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>


    <div style="height: 20px;"></div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Carrinho de Compras
        </div>
        <div class="card-body p-0">
            <?php if (!empty($itensCarrinho)) : ?>
            <table class="table mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Reserva</th>
                    <th>Quantidade</th>
                    <th>Preço por Noite</th>
                    <th>Preço Total</th>
                    <th></th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($itensCarrinho as $item) : ?>
                <tr>
                    <td>
                        <?= Html::checkbox('selecionarReserva[]', false, ['value' => $item->reserva->id]) ?>
                        <?= Html::encode($item->reserva->id) ?>
                    </td>
                    <td><?= Html::encode($item->quantidade) ?></td>
                    <td><?= Yii::$app->formatter->asCurrency($item->preco, 'EUR') ?></td>
                    <td><?= Yii::$app->formatter->asCurrency($item->subtotal, 'EUR') ?></td>
                    <td>
                        <?= Html::a('<i class="fas fa-trash"></i>', ['carrinho/remover', 'id' => $item->id], ['class' => 'btn btn-danger btn-sm']) ?>
                    </td>
                    <td>
                        <?php
                        // Obtém o modelo de confirmação associado ao item do carrinho
                        $confirmacoes = $item->reserva->confirmacoes;
                        if (!empty($confirmacoes)) {
                            // Ajuste esta parte para corresponder à estrutura real do array de confirmações
                            $ultimaConfirmacao = end($confirmacoes); // assumindo que o array de confirmações é ordenado e queremos a última
                            echo Html::encode($ultimaConfirmacao['estado']);
                        } else {
                            echo 'Não Confirmado';
                        }
                        ?>
                    </td>
                    <?php endforeach; ?>

                </tr>

                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <td><?= Yii::$app->formatter->asCurrency($totalCarrinho, 'EUR') ?></td>
                </tr>
                </tfoot>
            </table>
            <?php if ($hasItemsInCart) : ?>
                <?php
                // Verificar se há pelo menos um item no carrinho com estado diferente de "Confirmado"
                $podeFinalizarCompra = true;
                foreach ($itensCarrinho as $item) {
                    $confirmacoes = $item->reserva->confirmacoes;
                    if (!empty($confirmacoes)) {
                        $ultimaConfirmacao = end($confirmacoes);
                        if ($ultimaConfirmacao['estado'] !== 'Confirmado') {
                            $podeFinalizarCompra = false;
                            break; // Se pelo menos um item não estiver confirmado, não precisa verificar os outros
                        }
                    } else {
                        $podeFinalizarCompra = false;
                        break; // Se pelo menos um item não tiver confirmações, não precisa verificar os outros
                    }
                }
                ?>

                <div class="text-right p-3">
                    <?php if ($podeFinalizarCompra) : ?>
                        <p class="font-weight-bold">Total a Pagar: <?= Yii::$app->formatter->asCurrency($totalCarrinho, 'EUR') ?></p>
                        <?= Html::a('Finalizar Compra', ['carrinho/pagamento', 'id' => !empty($itensCarrinho) ? $itensCarrinho[0]->reserva->id : null], ['class' => 'btn btn-success']) ?>
                    <?php else : ?>
                        <p class="text-danger">Não é possível finalizar a compra. O estado de pelo menos uma reserva não está confirmado.</p>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <p class="p-3 text-center">O carrinho está vazio.</p>
            <?php endif; ?>
        </div>
        <?php else : ?>
            <p class="p-3 text-center">O carrinho está vazio.</p>
        <?php endif; ?>
    </div>
    <div style="height: 20px;"></div>
</div>
<div style="height: 20px;"></div>
</div>