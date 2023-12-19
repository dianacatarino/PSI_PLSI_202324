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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tipo', 'checkin', 'checkout', 'numeroquartos', 'numeroclientes', 'valor'], 'safe'],
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
        $query->joinWith(['profile']); // Realiza JOIN com a tabela 'profile'

        // Carrega os parâmetros de pesquisa com base no modelo
        $this->load($params);

        // Adiciona condições com base nos parâmetros de pesquisa
        $query->andFilterWhere(['like', 'profile.name', $this->getAttribute('name')]); // Filtra pelo nome na tabela 'profile'

        // Filtra pelo nome do funcionário apenas se o papel for funcionário
        if ($this->getAttribute('role') === 'funcionario') {
            $query->innerJoin('funcionario', 'funcionario.profile_id = profile.id')
                ->andFilterWhere(['like', 'funcionario.nome', $this->getAttribute('nome_funcionario')]);
        }

        // Filtra pelo nome do cliente apenas se o papel for cliente
        if ($this->getAttribute('role') === 'cliente') {
            $query->innerJoin('cliente', 'cliente.profile_id = profile.id')
                ->andFilterWhere(['like', 'cliente.nome', $this->getAttribute('nome_cliente')]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Validar antes de aplicar a pesquisa
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Retorna os dados completos do fornecedor
        return $dataProvider;
    }

}
