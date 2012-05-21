<?php

class RolesController extends Controller {

	public function actionIndex() {
		$data=Yii::app()->authManager->getRoles();
		foreach ($data as $row => $value) {
			$roles[$row]=Yii::app()->authManager->getAuthItem($row);
		}
		$this->render('index', array('data' => $roles));
	}

	public function actionCreateRole() {

		$model = new RoleForm;

		if (isset($_POST['RoleForm']))
		{
			$auth = Yii::app()->authManager;
			$role = $auth->createRole($_POST['RoleForm']['name'], $_POST['RoleForm']['description'], $_POST['RoleForm']['bizRule']);
			$this->redirect(array('index'));
		}

		$this->render('create', array(
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
