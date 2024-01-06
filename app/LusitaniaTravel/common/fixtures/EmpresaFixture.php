<?php

namespace common\tests\fixtures;

use yii\test\ActiveFixture;

class EmpresaFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Empresa';
    public $dataFile = '@common/tests/_data/empresa.php';
}
