<?php
$data = Yii::app()->db->createCommand()
		->select('name')
		->from('AuthItem')
		->where('type = 2')
		->queryAll();

foreach ($data as $row) {
	echo $row['name'] . '<br>';
}
?>
<?php
$this->pageTitle = Yii::app()->name . ' - Roles';
$this->breadcrumbs = array(
	'Роли',
);
?>

<h1>Роли</h1>

<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'role-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
			));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name'); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textField($model, 'description'); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'bizRule'); ?>
		<?php echo $form->textField($model, 'bizRule'); ?>
		<?php echo $form->error($model, 'bizRule'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
