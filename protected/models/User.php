<?php

class User extends PUser {

	public function validatePassword($password) {
		return $this->hashPassword($password, $this->salt) === $this->password;
	}

	public function hashPassword($password, $salt) {
		return md5($salt . $password);
	}

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
