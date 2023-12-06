<?php

namespace backend\models;

use app\models\Reserva;
use DateTime;
use Yii;

/**
 * This is the model class for table "linhasreservas".
 *
 * @property int $id
 * @property string $tipoquarto
 * @property int $numeronoites
 * @property int $numerocamas
 * @property float $subtotal
 * @property int $reservas_id
 *
 * @property Linhasfatura[] $linhasfaturas
 * @property Reserva $reservas
 */
class Linhasreserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhasreservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipoquarto', 'numeronoites', 'numerocamas', 'subtotal', 'reservas_id'], 'required'],
            [['numeronoites', 'numerocamas', 'reservas_id'], 'integer'],
            [['subtotal'], 'number'],
            [['tipoquarto'], 'string', 'max' => 20],
            [['reservas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reserva::class, 'targetAttribute' => ['reservas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoquarto' => 'Tipoquarto',
            'numeronoites' => 'Numeronoites',
            'numerocamas' => 'Numerocamas',
            'subtotal' => 'Subtotal',
            'reservas_id' => 'Reservas ID',
        ];
    }

    /**
     * Gets query for [[Linhasfaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasfaturas()
    {
        return $this->hasMany(Linhasfatura::class, ['linhasreservas_id' => 'id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasOne(Reserva::class, ['id' => 'reservas_id']);
    }

    public function calcularNoites($reserva)
    {
        if ($reserva->checkin && $reserva->checkout) {
            $datetime1 = new DateTime($reserva->checkin);
            $datetime2 = new DateTime($reserva->checkout);
            $interval = $datetime1->diff($datetime2);
            return $interval->days;
        }

        return 1;
    }
}
