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
 * @property Avaliacao[] $avaliacoes
 * @property Comentario[] $comentarios
 * @property Confirmacao[] $confirmacos
 * @property Imagem[] $imagens
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
     * Gets query for [[Avaliacos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacos()
    {
        return $this->hasMany(Avaliacao::class, ['fornecedor_id' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['fornecedor_id' => 'id']);
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

    /**
     * Gets query for [[Imagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['fornecedor_id' => 'id']);
    }
}
