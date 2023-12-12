<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fornecedor;

class PesquisaForm extends Model
{
    public $localizacao;
    public $checkin;
    public $checkout;
    public $numeroPessoas;
    public $numeroQuartos;

    public function rules()
    {
        return [
            [['localizacao', 'checkin', 'checkout', 'numeroPessoas', 'numeroQuartos'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Fornecedor::find()
            ->joinWith(['reservas', 'reservas.confirmacoes']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'localizacao_alojamento', $this->localizacao])
                ->andFilterWhere(['>=', 'checkin', $this->checkin])
                ->andFilterWhere(['<=', 'checkout', $this->checkout])
                ->andFilterWhere(['=', 'numeroPessoas', $this->numeroPessoas])
                ->andFilterWhere(['=', 'numeroQuartos', $this->numeroQuartos]);

            $query->andWhere(['OR',
                ['reserva.estado' => null],
                ['reserva.estado' => 'Pendente'],
            ]);
        }

        return $dataProvider;
    }
}
