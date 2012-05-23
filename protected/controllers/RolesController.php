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
			array('label' => 'Создать Задачу', 'url' => array('createTask')),
			array('label' => 'Задачи', 'url' => array('tasks')),
		);
		$this->breadcrumbs = array(
			'Роли' => array('index'),
		);
		$filterChain->run();
	}

	public function actionIndex() {
		$this->pageTitle = Yii::app()->name . ' - Роли';

		$data = Yii::app()->authManager->getRoles();
		foreach ($data as $row => $value) {
			$roles[$row] = Yii::app()->authManager->getAuthItem($row);
		}
		$this->render('index', array('data' => $roles));
	}

	public function actionTasks() {
		$this->pageTitle = Yii::app()->name . ' - Задачи';

		$data = Yii::app()->authManager->getTasks();
		foreach ($data as $row => $value) {
			$roles[$row] = Yii::app()->authManager->getAuthItem($row);
		}
		$this->render('tasks', array('data' => $roles));
	}

	public function actionCreateRole() {
		$this->pageTitle = Yii::app()->name . ' - Создание Роли';
		$this->breadcrumbs [] = 'Создать Роль';

		$model = new RoleForm;

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		if (isset($_POST['RoleForm']))
		{
			$model->setAttributes($_POST['RoleForm']);
			if (!(array_key_exists($_POST['RoleForm']['name'], $Operations) || array_key_exists($_POST['RoleForm']['name'], $Tasks) || array_key_exists($_POST['RoleForm']['name'], $Roles)) && $model->validate())
			{
				$auth = Yii::app()->authManager;
				$role = $auth->createRole($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule']);
				$this->redirect(array('index'));
			}
		}
		if (array_key_exists($_POST['RoleForm']['name'], $Operations) || array_key_exists($_POST['RoleForm']['name'], $Tasks) || array_key_exists($_POST['RoleForm']['name'], $Roles))
		{
			$model->addError('name', 'Имя не уникально');
		}
		$this->render('createRole', array(
			'model' => $model,
		));
	}

	public function actionCreateTask() {
		$this->pageTitle = Yii::app()->name . ' - Создание Задачи';
		$this->breadcrumbs [] = 'Создать Задачу';

		$model = new RoleForm;

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		if (isset($_POST['RoleForm']))
		{
			$model->setAttributes($_POST['RoleForm']);
			if (!(array_key_exists($_POST['RoleForm']['name'], $Operations) || array_key_exists($_POST['RoleForm']['name'], $Tasks) || array_key_exists($_POST['RoleForm']['name'], $Roles)) && $model->validate())
			{
				$auth = Yii::app()->authManager;
				$role = $auth->createTask($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule']);
				$this->redirect(array('index'));
			}
		}
		if (array_key_exists($_POST['RoleForm']['name'], $Operations) || array_key_exists($_POST['RoleForm']['name'], $Tasks) || array_key_exists($_POST['RoleForm']['name'], $Roles))
		{
			$model->addError('name', 'Имя не уникально');
		}
		$this->render('createTask', array(
			'model' => $model,
		));
	}

	public function actionEditRole($name) {
		$role = Yii::app()->authManager->getAuthItem($name);

		if (!$role)
		{
			$this->redirect(array('index'));
		}
		$model = new RoleForm;

		if (isset($_POST['RoleForm']))
		{
			$model->setAttributes($_POST['RoleForm']);
			if ($model->validate())
			{
				$role->name = $_POST['RoleForm']['name'];
				$role->description = $_POST['RoleForm']['description'];
				$role->bizRule = $_POST['RoleForm']['bizRule'];
				$this->redirect(array('editRole', 'name' => $role->name));
			}
		}

		$this->pageTitle = Yii::app()->name . ' - Редактирование Роли ' . $name;
		$this->breadcrumbs [] = 'Роль ' . $name;


		$role_form = array(
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

	public function actionDeleteTask($name) {
		$auth = Yii::app()->authManager;
		$role = $auth->removeAuthItem($name);
		$this->redirect(array('tasks'));
	}

}

?>
