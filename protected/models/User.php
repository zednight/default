<?php

class User extends PUser {
	public $_oldPassword;
			
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
		return array_merge(parent::attributeLabels(), array(
					'id' => 'Идентификатор',
					'username' => 'Имя пользователя',
					'password' => 'Пароль',
					'salt' => 'Соль',
					'email' => 'Email',
					'regtime' => 'Дата регистрации',
					'lastlogin' => 'Дата последнего входа',
				));
	}

	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$time=time();
		$date = date(Yii::app()->params['dateFormat'],$time);
		$hashtime=MD5(time());
		return array(
			array('username, password', 'required'),
			array('email', 'required', 'on' => 'register'),
			array('salt', 'default', 'setOnEmpty' => true, 'value' => $hashtime),
			array('regtime', 'default', 'setOnEmpty' => true, 'value' => $date),
			array('regtime', 'date', 'format' => 'dd/MM/yyyy', 'allowEmpty' => true),
			array('lastlogin', 'date', 'format' => 'dd/MM/yyyy hh:mm', 'allowEmpty' => true),
			//array('regtime, lastlogin', 'numerical', 'integerOnly'=>true,'allowEmpty'=>true),
			array('username, email', 'length', 'max' => 128),
			array('username', 'unique', 'attributeName' => 'username', 'caseSensitive' => false, 'className' => 'User'),
			array('email', 'unique', 'attributeName' => 'email', 'caseSensitive' => false, 'className' => 'User'),
			array('email', 'email', 'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, email, regtime, lastlogin', 'safe', 'on' => 'search'),
		);
	}

	protected function beforeSave() {
		parent::beforeSave();
		if(!empty($this->lastlogin)){
			$date_time = explode(' ', $this->lastlogin);
			$date_arr = explode(Yii::app()->params['dateSeparator'], $date_time[0]);
			$time_arr = explode(':', $date_time[1]);
			$this->lastlogin = mktime($time_arr[0], $time_arr[1], 0, $date_arr[1], $date_arr[0], $date_arr[2]);
		}
		if(!empty($this->regtime)){
			$date_arr = explode(Yii::app()->params['dateSeparator'], $this->regtime);
			$this->regtime = mktime(0, 0, 0, $date_arr[1], $date_arr[0], $date_arr[2]);
		}
		if($this->isNewRecord || ($this->password!=$this->_oldPassword && $this->password!=$this->hashPassword($this->_oldPassword,$this->salt) && !empty($this->password))){
			$this->password = $this->hashPassword($this->password, $this->salt);
		}else{
			$this->password=$this->_oldPassword;
		}
		return true;
	}

	protected function afterFind() {
		parent::afterFind();
		if(!is_null($this->lastlogin))
			$this->lastlogin = date(Yii::app()->params['dateTimeFormat'], $this->lastlogin);
		if(!is_null($this->regtime))
			$this->regtime = date(Yii::app()->params['dateFormat'], $this->regtime);
		$this->_oldPassword=$this->password;
	}

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
