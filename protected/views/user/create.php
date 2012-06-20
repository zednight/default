<?php
$this->breadcrumbs[]='Создание';

//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>

<h1>Создание пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>