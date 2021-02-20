<?php 

namespace app\models;
use yii\db\ActiveRecord;


class SignupForm extends ActiveRecord {
 
 
 	public function rules() {
 		return [
 			[['username', 'password'], 'required', 'message' => 'Заполните поле'],
 			[['username'], 'unique', 'message' => ' Данный логин уже есть!'],
 		];
 	}
 
 	public function attributeLabels() {
 		return [
 			'username' => 'Ваше имя',
 			'password' => 'Пароль',
 		];
 	}

 	public static function tableName() {
 		return "users";
 	}
 
}

?>