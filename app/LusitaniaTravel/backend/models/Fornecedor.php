<?php

namespace backend\models;

use app\models\Confirmacao;
use Yii;

/**
 * This is the model class for table "fornecedores".
 *
 * @property int $id
 * @property string $responsavel
 * @property string $tipo
 * @property string $nome_alojamento
 * @property string $localizacao_alojamento
 *
 * @property Confirmacao[] $confirmacoes
 */
class Fornecedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fornecedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['responsavel', 'tipo', 'nome_alojamento', 'localizacao_alojamento'], 'required'],
            [['responsavel', 'nome_alojamento'], 'string', 'max' => 30],
            [['tipo'], 'string', 'max' => 20],
            [['localizacao_alojamento'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'responsavel' => 'Responsavel',
            'tipo' => 'Tipo',
            'nome_alojamento' => 'Nome Alojamento',
            'localizacao_alojamento' => 'Localizacao Alojamento',
        ];
    }

    /**
     * Gets query for [[Confirmacos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmacos()
    {
        return $this->hasMany(Confirmacao::class, ['fornecedor_id' => 'id']);
    }
}
