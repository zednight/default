<?php

class User extends PUser {

	public function validatePassword($password) {
		return $this->hashPassword($password, $this->salt) === $this->password;
	}

	public function hashPassword($password, $salt) {
		return md5($salt . $password . md5($password));
	}

	public static function model($className = 'User') {
		return parent::model($className);
	}

	public function attributeLabels() {
		return array_merge(parent::attributeLabels(),array(
			'id' => 'Идентификатор',
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'salt' => 'Соль',
			'email' => 'Email',
			'regtime' => 'Дата регистрации',
			'lastlogin' => 'Дата последнего входа',
		));
	}

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
