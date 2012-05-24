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
			array('label' => 'Создать Операцию', 'url' => array('createOperation')),
		);
		$this->breadcrumbs = array(
			'Управление Элементами' => array('index'),
		);
		$filterChain->run();
	}

	public function actionIndex() {
		$this->pageTitle = Yii::app()->name . ' - Роли';

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		$this->render('index', array(
			'roles' => $Roles,
			'tasks' => $Tasks,
			'operations' => $Operations,
		));
	}

	public function actionCreateRole() {
		self::create('role');
	}

	public function actionCreateTask() {
		self::create('task');
	}

	public function actionCreateOperation() {
		self::create('operation');
	}

	protected function create($item) {
		switch ($item) {
			case 'role':
				$this->pageTitle = Yii::app()->name . ' - Создание Роли';
				break;
			case 'task':
				$this->pageTitle = Yii::app()->name . ' - Создание Задачи';
				break;
			case 'operation':
				$this->pageTitle = Yii::app()->name . ' - Создание Операции';
				break;
			default:
				$this->pageTitle = Yii::app()->name . ' - Создание Роли';
		}
		switch ($item) {
			case 'role':
				$this->breadcrumbs [] = 'Создать Роль';
				break;
			case 'task':
				$this->breadcrumbs [] = 'Создать Задачу';
				break;
			case 'operation':
				$this->breadcrumbs [] = 'Создать Операцию';
				break;
			default:
				$this->breadcrumbs [] = 'Создать Роль';
		}
		$model = new RoleForm;

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		if (isset($_POST['RoleForm']))
		{
			if (!array_key_exists($_POST['RoleForm']['name'], $Operations) && !array_key_exists($_POST['RoleForm']['name'], $Tasks) && !array_key_exists($_POST['RoleForm']['name'], $Roles))
			{
				$repeat = false;
			}
			else
			{
				$repeat = true;
			}
			$model->setAttributes($_POST['RoleForm']);
			if (!$repeat && $model->validate())
			{
				$auth = Yii::app()->authManager;
				switch ($item) {
					case 'role':
						$role = $auth->createRole($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule'], $_POST['RoleForm']['data']);
						break;
					case 'task':
						$role = $auth->createTask($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule'], $_POST['RoleForm']['data']);
						break;
					case 'operation':
						$role = $auth->createOperation($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule'], $_POST['RoleForm']['data']);
						break;
					default:
						$role = $auth->createRole($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule'], $_POST['RoleForm']['data']);
				}

				$this->redirect(array('index'));
			}
		}
		if ($repeat)
		{
			$model->addError('name', 'Имя не уникально');
		}

		$this->render('create', array(
			'item' => $item,
			'model' => $model,
		));
	}

	public function actionEdit($name) {
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
				$role->data = $_POST['RoleForm']['data'];
				$this->redirect(array('edit', 'name' => $role->name));
			}
		}

		$this->pageTitle = Yii::app()->name . ' - Редактирование ' . $name;
		$this->breadcrumbs [] = $name;


		$role_form = array(
			'name' => $role->name,
			'description' => $role->description,
			'bizRule' => $role->bizRule,
			'data' => $role->data,
		);
		$model->setAttributes($role_form);

		$this->render('create', array(
			'model' => $model,
		));
	}
	
	public function actionDelete($name){
		$auth = Yii::app()->authManager;
		$role = $auth->removeAuthItem($name);
		$this->redirect(array('index'));
	}

}

?>
