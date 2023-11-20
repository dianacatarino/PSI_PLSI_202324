<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */

class SignupForm extends Model
{
    public $username;
    public $password;
    public $repeatPassword;
    public $name;
    public $email;
    public $mobile;
    public $street;
    public $locale;
    public $postalCode;
    public $userType;
    public $terms;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['repeatPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match'],

            [['name', 'mobile', 'street', 'locale', 'postalCode'], 'string'],

            [['userType'], 'required'],
            [['userType'], 'in', 'range' => ['administrador', 'funcionario', 'fornecedor']],

            [['terms'], 'required'],
            [['terms'], 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->name = $this->name;
        $user->mobile = $this->mobile;
        $user->street = $this->street;
        $user->locale = $this->locale;
        $user->postalCode = $this->postalCode;
        $user->status = 10;

        $auth = Yii::$app->authManager;
        $role = null;

        switch ($this->userType) {
            case 'administrador':
                $role = $auth->getRole('administrador');
                $user->role = 'administrador';
                break;
            case 'funcionario':
                $role = $auth->getRole('funcionario');
                $user->role = 'funcionario';
                break;
            case 'fornecedor':
                $role = $auth->getRole('fornecedor');
                $user->role = 'fornecedor';
                break;
            default:
                Yii::warning('Tipo de usuário desconhecido: ' . $this->userType);
        }

        if ($user->save() && $role !== null) {
            $auth->assign($role, $user->getId());
            return true;
        }

        return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function isRegistered()
    {
        // Lógica para verificar se o usuário já está registrado
        return User::find()->where(['username' => $this->username])->exists();
    }

}
