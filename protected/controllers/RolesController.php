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
			array('label' => 'Создать элемент', 'url' => array('create')),
		);
		$this->breadcrumbs = array(
			'Управление Элементами' => array('index'),
		);
		$filterChain->run();
	}

	public function actionIndex() {
		$this->pageTitle = Yii::app()->name . ' - Элементы авторизации';

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		$this->render('index', array(
			'roles' => $Roles,
			'tasks' => $Tasks,
			'operations' => $Operations,
		));
	}

	public function actionAddChild($name, $parent) {
		if (Yii::app()->request->isAjaxRequest)
		{
			$role = Yii::app()->authManager->getAuthItem($name);
			$parentRole = Yii::app()->authManager->getAuthItem($parent);
			//Yii::app()->authManager->addItemChild('test2','tester') ;
			if (is_null($role) || is_null($parentRole))
			{
				throw new CHttpException(404);
			}
			$auth = Yii::app()->authManager;
			$auth->addItemChild($parent, $name);
			$this->redirect(array('detail', 'name' => $parent));
		}
		else
		{
			throw new CHttpException(404);
		}
	}

	public function actionDeleteChild($name, $parent) {
		if (Yii::app()->request->isAjaxRequest)
		{
			$role = Yii::app()->authManager->getAuthItem($name);
			$parentRole = Yii::app()->authManager->getAuthItem($parent);
			//Yii::app()->authManager->addItemChild('test2','tester') ;
			if (is_null($role) || is_null($parentRole))
			{
				throw new CHttpException(404);
			}
			$auth = Yii::app()->authManager;
			$auth->removeItemChild($parent, $name);
			$this->redirect(array('detail', 'name' => $parent));
		}
		else
		{
			throw new CHttpException(404);
		}
	}

	public function actionDeleteParent($name, $child) {
		if (Yii::app()->request->isAjaxRequest)
		{
			$role = Yii::app()->authManager->getAuthItem($name);
			$childRole = Yii::app()->authManager->getAuthItem($child);
			//Yii::app()->authManager->addItemChild('test2','tester') ;
			if (is_null($role) || is_null($childRole))
			{
				throw new CHttpException(404);
			}
			$auth = Yii::app()->authManager;
			$auth->removeItemChild($name, $child);
			$this->redirect(array('detail', 'name' => $child));
		}
		else
		{
			throw new CHttpException(404);
		}
	}

	public function actionDetail($name) {

		$role = Yii::app()->authManager->getAuthItem($name);
		//Yii::app()->authManager->addItemChild('test2','tester') ;
		if (is_null($role))
		{
			throw new CHttpException(404);
		}
		
		//Yii::app()->clientScript->registerScriptFile('/js/jquery-1.7.2.js', CClientScript::POS_HEAD);
		Yii::app()->getClientScript()->registerCoreScript('jquery'); 
		$this->breadcrumbs [] = 'Cвязи элемента ' . $role->getName();
		$this->pageTitle = Yii::app()->name . ' - Cвязи элемента ' . $role->getName();

		$Roles = Yii::app()->authManager->getRoles();
		$Tasks = Yii::app()->authManager->getTasks();
		$Operations = Yii::app()->authManager->getOperations();
		$this->render('detail', array(
			'roles' => $Roles,
			'tasks' => $Tasks,
			'operations' => $Operations,
			'authItem' => $role,
		));
	}

	public function actionCreate() {
		self::create($_POST['RoleForm']['item'] ? $_POST['RoleForm']['item'] : current(RoleForm::getItems()));
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
				$this->pageTitle = Yii::app()->name . ' - Создание Элемента';
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
				$this->breadcrumbs [] = 'Создать Элемент';
		}
		$model = new RoleForm('create');

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
		//echo '1111'.Yii::app()->authManager->asa($name);
		$role = Yii::app()->authManager->getAuthItem($name);
		if (is_null($role))
		{
			throw new CHttpException(404);
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

	public function actionDelete($name) {
		$auth = Yii::app()->authManager;
		$role = $auth->removeAuthItem($name);
		$this->redirect(array('index'));
	}

}

?>
