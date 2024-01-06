<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class FornecedorFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Fornecedor';
    public $dataFile = '@common/tests/_data/fornecedor.php';
}

