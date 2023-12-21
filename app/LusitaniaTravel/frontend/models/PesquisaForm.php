<?php

namespace frontend\models;

use common\models\Confirmacao;
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
        /*$query = Fornecedor::find()->alias('f');

        // Join with the related tables
        $query->leftJoin('reservas r', 'r.fornecedor_id = f.id')
            ->leftJoin('confirmacoes c', 'c.reserva_id = r.id');

        // Load the search parameters
        $this->load($params);

        // Check if check-in and check-out dates are provided and are not null
        if (!empty($this->checkin)) {
            $this->checkin = date('Y-m-d', strtotime($this->checkin));
        }

        if (!empty($this->checkout)) {
            $this->checkout = date('Y-m-d', strtotime($this->checkout));
        }

        // Add conditions based on the search parameters
        $query->andFilterWhere(['like', 'f.localizacao_alojamento', $this->localizacao_alojamento])
            ->andFilterWhere(['>=', 'f.numeroquartos', $this->numeroquartos]);

        // Check if check-in and check-out dates are provided
        if (!empty($this->checkin) && !empty($this->checkout)) {
            // Filter the results based on the reservation dates
            $query->andWhere(['or',
                ['>', 'r.checkout', $this->checkin],
                ['<', 'r.checkin', $this->checkout],
            ]);
        }

        // Exclude results where confirmacao.estado is 'Confirmado'
        $query->andWhere(['or',
            ['c.estado' => null],
            ['!=', 'c.estado', 'Confirmado']
        ]);

        // Add the NOT EXISTS subquery
        $notExistsSubquery = Confirmacao::find()
            ->join('INNER JOIN', 'reservas r', 'c.reserva_id = r.id')
            ->where(['c.estado' => 'Confirmado'])
            ->andWhere(['r.fornecedor_id' => new \yii\db\Expression('f.id')])
            ->andWhere(['>=', 'r.checkout', $this->checkin])
            ->andWhere(['<=', 'r.checkin', $this->checkout]);

        $query->andWhere(['not exists', $notExistsSubquery]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Validate before applying the search
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Return the complete data of the supplier
        return $dataProvider;*/
    }


    private function getMaxGuestsByTipoQuartos()
    {
        $tipoquartos = $this->tipoquartos;

        if ($tipoquartos === null) {
            return 0; // or any default value you prefer
        }

        // Map room types to the maximum number of guests
        $maxGuestsMap = [
            'individual' => 1,
            'duplo' => 2,
            'triplo' => 3,
            'familiar' => 4,
            'suite' => 4, // Adjust this based on your business logic
            'villa' => 6,
        ];

        // Extract individual room types
        $roomTypes = array_map('trim', explode(';', $tipoquartos));

        // Find the maximum number of guests for the specified room types
        $maxGuests = 0;

        foreach ($roomTypes as $roomType) {
            $roomType = strtolower($roomType);

            if (isset($maxGuestsMap[$roomType])) {
                $maxGuests = max($maxGuests, $maxGuestsMap[$roomType]);
            }
        }

        return $maxGuests;
    }

    /**
     * Check if the form is filled
     * @return bool
     */
    public function isFilled()
    {
        // Add your logic to check if the form is filled
        // For example, you can check if any of the form fields is not empty
        return !empty($this->localizacao_alojamento)
            || !empty($this->checkin)
            || !empty($this->checkout)
            || !empty($this->numeroclientes)
            || !empty($this->numeroquartos);
    }
}
