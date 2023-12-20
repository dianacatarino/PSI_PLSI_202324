<?php

namespace common\models;

use frontend\models\Carrinho;
use Yii;

/**
 * This is the model class for table "fornecedores".
 *
 * @property int $id
 * @property string $responsavel
 * @property string $tipo
 * @property string $nome_alojamento
 * @property string $localizacao_alojamento
 * @property string|null $acomodacoes_alojamento
 * @property string|null $tipoquartos
 * @property int|null $numeroquartos
 * @property float|null $precopornoite
 *
 * @property Avaliacao[] $avaliacoes
 * @property Carrinho[] $carrinhos
 * @property Comentario[] $comentarios
 * @property Confirmacao[] $confirmacoes
 * @property Imagem[] $imagens
 * @property Reserva[] $reservas
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
            [['numeroquartos'], 'integer', 'min' => 1],
            [['precopornoite'], 'number', 'min' => 0],
            [['responsavel', 'nome_alojamento'], 'string', 'max' => 30],
            [['tipo'], 'string', 'max' => 20],
            [['localizacao_alojamento'], 'string', 'max' => 50],
            [['acomodacoes_alojamento'], 'string', 'max' => 100],
            [['tipoquartos'], 'string', 'max' => 150],
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
            'acomodacoes_alojamento' => 'Acomodacoes Alojamento',
            'tipoquartos' => 'Tipoquartos',
            'numeroquartos' => 'Numeroquartos',
            'precopornoite' => 'Precopornoite',
        ];
    }

    /**
     * Gets query for [[Avaliacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacoes()
    {
        return $this->hasMany(Avaliacao::class, ['fornecedor_id' => 'id']);
    }

    /**
     * Gets query for [[Carrinhos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhos()
    {
        return $this->hasMany(Carrinho::class, ['fornecedor_id' => 'id']);
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
     * Gets query for [[Confirmacoes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmacoes()
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

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::class, ['fornecedor_id' => 'id']);
    }

    public static function selectFornecedores()
    {
        return Profile::find()
            ->select(['name', 'user_id'])
            ->where(['role' => 'fornecedor'])
            ->indexBy('user_id')
            ->column();
    }

    public function getMediaClassificacoes()
    {
        $avaliacoes = $this->avaliacoes;

        if (empty($avaliacoes)) {
            return null; // ou qualquer valor padrão que você preferir para o caso de não haver avaliações
        }

        $somaClassificacoes = 0;

        foreach ($avaliacoes as $avaliacao) {
            $somaClassificacoes += $avaliacao->classificacao;
        }

        return $somaClassificacoes / count($avaliacoes);
    }

    public function getNumeroCamasPorTipoQuarto()
    {
        $tipoQuartos = explode(';', $this->tipoquartos);
        $result = [];

        foreach ($tipoQuartos as $tipo) {
            $tipo = trim($tipo);
            $result[$tipo] = $this->obterNumeroCamas($tipo);
        }

        return $result;
    }

    private function obterNumeroCamas($tipoQuarto)
    {
        $tipoQuarto = strtolower($tipoQuarto);

        if (stripos($tipoQuarto, 'individual') !== false) {
            return 1;
        } elseif (stripos($tipoQuarto, 'duplo') !== false) {
            return 2;
        } elseif (stripos($tipoQuarto, 'triplo') !== false) {
            return 3;
        } elseif (stripos($tipoQuarto, 'familiar') !== false || stripos($tipoQuarto, 'suite') !== false) {
            return 4;
        } elseif (stripos($tipoQuarto, 'villa') !== false) {
            return 6;
        }
        return 0; // Caso não corresponda a nenhum tipo conhecido
    }
}
