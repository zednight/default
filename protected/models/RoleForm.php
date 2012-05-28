<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RoleForm extends CFormModel {

	public $name;
	public $description;
	public $bizRule;
	public $data;
	public $item;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array(
			array('name,item', 'required'),
			array('name, description, bizRule, data', 'safe'),
			array('item', 'in', 'range' => array_keys(self::getItems())),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array(
			'name' => 'Имя элемента',
			'description' => 'Описание элемента',
			'bizRule' => 'Бизнес правило',
			'data' => 'Данные',
			'item' => 'Элемент'
		);
	}

	public static function getItems() {
		return array('role'=>'Роль','task'=>'Задача','operation'=>'Операция');
	}

}
