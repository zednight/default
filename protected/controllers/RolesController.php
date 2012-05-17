<?php

class RolesController extends Controller {

	public function actionIndex() {
		$model = new RoleForm;
		$this->render('index', array('model' => $model));
	}

}

?>
