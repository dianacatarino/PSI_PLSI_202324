<?php
namespace frontend\models;

use common\models\Reserva;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

class CarrinhoSearch extends Reserva
{
    public function rules()
    {
        return [
            [['checkin', 'checkout'], 'safe'],
            [['numeroquartos', 'numeroclientes'], 'integer'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $clienteId)
    {
        $query = Reserva::find()
            ->joinWith('confirmacao') // Certifique-se de que você tenha a relação definida no modelo Reserva
            ->where(['cliente_id' => $clienteId])
            ->andWhere(['confirmacao.estado' => ['Confirmado', 'Pendente']]); // Filtra apenas reservas com confirmação confirmada ou pendente

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Se os parâmetros não forem válidos, retorne todos os registros
            return $dataProvider;
        }

        // Adicione aqui a lógica para filtrar com base nos parâmetros de pesquisa, se necessário
        $query->andFilterWhere(['like', 'checkin', $this->checkin])
            ->andFilterWhere(['like', 'checkout', $this->checkout])
            ->andFilterWhere(['numeroquartos' => $this->numeroquartos])
            ->andFilterWhere(['numeroclientes' => $this->numeroclientes]);

        return $dataProvider;
    }
}