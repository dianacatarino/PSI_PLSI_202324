<?php

namespace backend\models;

use common\models\Reserva;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReservaSearch represents the model behind the search form of `common\models\Reserva`.
 */

class ReservaSearch extends Reserva
{
    public $fornecedor_nome_alojamento;
    public $cliente_profile_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tipo', 'checkin', 'checkout', 'numeroquartos', 'numeroclientes', 'valor'], 'safe'],
            [['fornecedor_nome_alojamento', 'cliente_profile_name'], 'string'], // Adicionei as regras para os novos atributos
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reserva::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);

        // Add conditions related to the search fields
        $query->andFilterWhere(['like', 'fornecedor.nome_alojamento', $this->fornecedor_nome_alojamento])
            ->andFilterWhere(['like', 'profile.name', $this->cliente_profile_name]);

        return $dataProvider;
    }

}
