<h1>Редактирование <?php
		switch ($item) {
			case 'role':
				echo 'Роли';
				break;
			case 'task':
				echo 'Задачи';
				break;
			case 'operation':
				echo 'Операции';
				break;
			default:
				echo 'Элемента';
		}

?></h1>

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

	<p class="note">Поля помеченные<span class="required">*</span> обязательны для заполнения.</p>

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

	<div class="row">
		<?php echo $form->labelEx($model, 'data'); ?>
		<?php echo $form->textField($model, 'data'); ?>
		<?php echo $form->error($model, 'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->
