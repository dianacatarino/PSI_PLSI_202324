<?php

use yii\helpers\Html;

$this->title = 'Detalhes do Alojamento';

?>

<div class="detalhes-alojamento">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3><?= Html::encode($fornecedor->nome_alojamento) ?></h3>

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $imagens = $fornecedor->imagens;

            if (!empty($imagens)) {
                foreach ($imagens as $index => $imagem) {
                    $activeClass = $index === 0 ? 'active' : '';
                    if ($imagem->filename) {
                        echo '<div class="carousel-item ' . $activeClass . '">';
                        echo Html::img($imagem->filename, ['class' => 'd-block img-thumbnail mx-auto',
                            'style' => 'max-height: 300px; width: 500px;',
                        ]);
                        echo '</div>';
                    } else {
                        echo 'Imagem não encontrada';
                    }
                }
            } else {
                echo 'Nenhuma imagem disponível';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" style="color: #ffffff; background-color: #3d9bd1;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="color: #ffffff; background-color: #3d9bd1;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <table class="table">
        <tbody>
        <tr>
            <th scope="row">Tipo de Alojamento</th>
            <td><?= Html::encode($fornecedor->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row">Localização</th>
            <td><?= Html::encode($fornecedor->localizacao_alojamento) ?></td>
        </tr>
        <tr>
            <th scope="row">Tipo de Quarto</th>
            <td><?= Html::encode($tipoQuarto) ?></td>
        </tr>
        <tr>
            <th scope="row">Número de Quartos</th>
            <td><?= Html::encode($numeroQuartos) ?></td>
        </tr>
        <tr>
            <th scope="row">Número de Camas</th>
            <td><?= Html::encode($numeroCamas) ?></td>
        </tr>
        <tr>
            <th scope="row">Acomodações</th>
            <td><?= Html::encode($fornecedor->acomodacoes_alojamento) ?></td>
        </tr>
        <tr>
            <th scope="row">Preço por Noite</th>
            <td><?= Html::encode($precoPorNoite) ?>€</td>
        </tr>
        </tbody>
    </table>

    <div style="height: 20px;"></div>

    <div class="mt-3">
        <h5>Comentários/Avaliação</h5>

        <!-- Adicione um formulário para adicionar comentários -->
        <form>
            <div class="mb-3">
                <label for="comment" class="form-label">Adicionar Comentário:</label>
                <textarea class="form-control" id="comment" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Avaliação:</label>
                <select class="form-select" id="rating" name="rating">
                    <option value="5">5 estrelas</option>
                    <option value="4">4 estrelas</option>
                    <option value="3">3 estrelas</option>
                    <option value="2">2 estrelas</option>
                    <option value="1">1 estrela</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Comentário/Avaliação</button>
        </form>

        <div style="height: 20px;"></div>
    </div>

</div>
