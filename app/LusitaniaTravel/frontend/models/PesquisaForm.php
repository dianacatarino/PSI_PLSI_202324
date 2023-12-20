<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;
use common\models\Fornecedor;

class PesquisaForm extends Fornecedor
{
    public $localizacao_alojamento;
    public $checkin;
    public $checkout;
    public $numeroclientes;
    public $numeroquartos;

    public function rules()
    {
        return [
            [['localizacao_alojamento', 'checkin', 'checkout', 'numeroclientes', 'numeroquartos'], 'safe'],
        ];
    }

    public function search($params)
    {
       /* $query = Fornecedor::find();

        // Filtrar por localizacao_alojamento no modelo Fornecedor
        $query->andFilterWhere(['like', 'localizacao_alojamento', $this->localizacao_alojamento]);

        // Verificar se há filtros para as reservas
        if ($this->checkin || $this->checkout || $this->numeroclientes || $this->numeroquartos) {
            // Filtrar por reservas
            $query->joinWith(['reservas' => function ($query) {
                // Filtrar por checkin e checkout no modelo Reserva
                $query->andFilterWhere(['>=', 'checkin', $this->checkin])
                    ->andFilterWhere(['<=', 'checkout', $this->checkout])
                    // Verificar confirmação associada
                    ->andFilterWhere(['reserva.confirmada' => 1])
                    ->andFilterWhere(['>', 'reserva.linhasreserva', 0])
                    // Filtrar por numeroclientes e numeroquartos no modelo Reserva
                    ->andFilterWhere(['reserva.numeroclientes' => $this->numeroclientes])
                    ->andFilterWhere(['reserva.numeroquartos' => $this->numeroquartos]);
            }]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;*/
    }
}
