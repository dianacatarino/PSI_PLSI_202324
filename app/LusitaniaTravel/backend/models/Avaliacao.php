<?php

namespace backend\models;

use app\models\Reserva;
use common\models\User;
use Yii;

/**
 * This is the model class for table "avaliacoes".
 *
 * @property int $id
 * @property int $classificacao
 * @property string $data_avaliacao
 * @property int $cliente_id
 * @property int $reserva_id
 *
 * @property User $cliente
 * @property Reserva $reserva
 */
class Avaliacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacoes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classificacao', 'data_avaliacao', 'cliente_id', 'reserva_id'], 'required'],
            [['classificacao', 'cliente_id', 'reserva_id'], 'integer'],
            [['data_avaliacao'], 'safe'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['reserva_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reserva::class, 'targetAttribute' => ['reserva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classificacao' => 'Classificacao',
            'data_avaliacao' => 'Data Avaliacao',
            'cliente_id' => 'Cliente ID',
            'reserva_id' => 'Reserva ID',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(User::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Reserva]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserva()
    {
        return $this->hasOne(Reserva::class, ['id' => 'reserva_id']);
    }
}
