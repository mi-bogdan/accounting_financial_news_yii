<?php
namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email'], 'trim'],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->is_superuser = false;
        
        return $user->save() ? $user : null;
    }
}