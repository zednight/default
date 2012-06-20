<?php
$this->breadcrumbs[]=$model->id;

//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
	$this->menu[]=array('label'=>'Изменить пользователя', 'url'=>array('update', 'id'=>$model->id));
	$this->menu[]=array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
	
?>

<h1>Просмотр пользователя №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		//'password',
		//'salt',
		'email',
		'regtime',
		'lastlogin',
	),
)); ?>
