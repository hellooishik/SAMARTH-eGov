// models/UserRegistrationForm.php

namespace app\models;

use Yii;
use yii\base\Model;

class UserRegistrationForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);

            return $user->save();
        }

        return false;
    }
}
