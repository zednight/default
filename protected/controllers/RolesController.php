<?php

class RolesController extends Controller {

	public $layout = '//layouts/column2';

	public function filters() {
		return array(
			//'accessControl', // perform access control for CRUD operations
			'before',
		);
	}

	public function filterBefore($filterChain) {
		$this->menu = array(
			array('label' => 'Создать Роль', 'url' => array('createRole')),
		);
		$this->breadcrumbs = array(
			'Роли' => array('index'),
		);
		$filterChain->run();
	}

	public function actionIndex() {
		$this->pageTitle = Yii::app()->name . ' - Главная';

		$data = Yii::app()->authManager->getRoles();
		foreach ($data as $row => $value) {
			$roles[$row] = Yii::app()->authManager->getAuthItem($row);
		}
		$this->render('index', array('data' => $roles));
	}

	public function actionCreateRole() {
		$this->pageTitle = Yii::app()->name . ' - Создание Роли';
		$this->breadcrumbs [] = 'Создать';

		$model = new RoleForm;

		if (isset($_POST['RoleForm']))
		{
			$auth = Yii::app()->authManager;
			$role = $auth->createRole($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule']);
			$this->redirect(array('index'));
		}

		$this->render('createRole', array(
			'model' => $model,
		));
	}

	public function actionEditRole($name) {
		$role=Yii::app()->authManager->getAuthItem($name);
		if (!$role)
		{
			$this->redirect(array('index'));
		}

		$this->pageTitle = Yii::app()->name . ' - Редактирование Роли '.$name;
		$this->breadcrumbs [] = 'Роль '.$name;

		$model = new RoleForm;

		$role_form=array(
			'name' => $role->name,
			'description' => $role->description,
			'bizRule' => $role->bizRule,
		);
		$model->setAttributes($role_form);
		
		$this->render('editRole', array(
			'model' => $model,
		));
	}

	public function actionDeleteRole($name) {
		$auth = Yii::app()->authManager;
		$role = $auth->removeAuthItem($name);
		$this->redirect(array('index'));
	}

}

?>
