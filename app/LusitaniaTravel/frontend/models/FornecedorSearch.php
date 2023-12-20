<?php

namespace frontend\models;

use common\models\Fornecedor;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FornecedorSearch represents the model behind the search form of `common\models\Fornecedor`.
 */
class FornecedorSearch extends Fornecedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['responsavel', 'tipo', 'nome_alojamento', 'localizacao_alojamento', 'acomodacoes_alojamento','tipoquartos','numeroquartos',
                'precopornoite'], 'safe'],
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
        $query = Fornecedor::find();

        // Carrega os parâmetros de pesquisa com base no modelo
        $this->load($params);

        // Adicione condições com base nos parâmetros de pesquisa
        $query->andFilterWhere(['like', 'localizacao_alojamento', $this->localizacao_alojamento]);

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
