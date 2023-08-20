<?php

namespace app\modules\api\models;

use app\models\User;
use app\modules\api\resources\UserResource;
use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $access_token;

    public $user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password', 'username'], 'required'],
            ['email', 'unique',
                'targetClass' => '\app\modules\admin\resources\UserResource',
                'message' => 'This email has already been taken.'
            ],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new UserResource();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->access_token = Yii::$app->security->generateRandomString(256);
            $this->user = $user;
            if ($user->save()) {
                return Yii::$app->user->login($user, 0);
            }
            return false;
        }
        return false;
    }

}