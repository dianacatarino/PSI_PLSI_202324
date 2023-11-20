<?php

namespace backend\models;

use app\models\Reserva;
use common\models\User;
use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $titulo
 * @property string $descricao
 * @property string $data_comentario
 * @property int $cliente_id
 * @property int $reserva_id
 *
 * @property User $cliente
 * @property Reserva $reserva
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descricao', 'data_comentario', 'cliente_id', 'reserva_id'], 'required'],
            [['descricao'], 'string'],
            [['data_comentario'], 'safe'],
            [['cliente_id', 'reserva_id'], 'integer'],
            [['titulo'], 'string', 'max' => 100],
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
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'data_comentario' => 'Data Comentario',
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
