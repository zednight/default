<?php

class User extends PUser {

	public function validatePassword($password) {
		return $this->hashPassword($password, $this->salt) === $this->password;
	}

	public function hashPassword($password, $salt) {
		return md5($salt . $password . md5($password));
	}
	
	public static function model($className='User')
	{
		return parent::model($className);
	}
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
