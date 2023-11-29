<?php

namespace backend\models;

use backend\models\Confirmacao;
use backend\models\Imagem;
use backend\models\Linhasreserva;
use common\models\User;
use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id
 * @property string|null $tipo
 * @property string $checkin
 * @property string $checkout
 * @property int $numeroquartos
 * @property int $numeroclientes
 * @property float $valor
 * @property int $cliente_id
 * @property int $funcionario_id
 *
 * @property Avaliacao[] $avaliacoes
 * @property User $cliente
 * @property Comentario[] $comentarios
 * @property Confirmacao[] $confirmacoes
 * @property Fatura[] $faturas
 * @property User $funcionario
 * @property Imagem[] $imagens
 * @property Linhasreserva[] $linhasreservas
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'string'],
            [['checkin', 'checkout', 'numeroquartos', 'numeroclientes', 'valor', 'cliente_id', 'funcionario_id'], 'required'],
            [['checkin', 'checkout'], 'safe'],
            [['numeroquartos', 'numeroclientes', 'cliente_id', 'funcionario_id'], 'integer'],
            [['valor'], 'number'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['funcionario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['funcionario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'checkin' => 'Checkin',
            'checkout' => 'Checkout',
            'numeroquartos' => 'Numeroquartos',
            'numeroclientes' => 'Numeroclientes',
            'valor' => 'Valor',
            'cliente_id' => 'Cliente ID',
            'funcionario_id' => 'Funcionario ID',
        ];
    }

    /**
     * Gets query for [[Avaliacos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacos()
    {
        return $this->hasMany(Avaliacao::class, ['reserva_id' => 'id']);
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
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['reserva_id' => 'id']);
    }

    /**
     * Gets query for [[Confirmacos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmacos()
    {
        return $this->hasMany(Confirmacao::class, ['reserva_id' => 'id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['reserva_id' => 'id']);
    }

    /**
     * Gets query for [[Funcionario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionario()
    {
        return $this->hasOne(User::class, ['id' => 'funcionario_id']);
    }

    /**
     * Gets query for [[Imagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['reserva_id' => 'id']);
    }

    /**
     * Gets query for [[Linhasreservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhasreservas()
    {
        return $this->hasMany(Linhasreserva::class, ['reservas_id' => 'id']);
    }
}
