<div style="float:left; width:200px;">
	<h3>Роли</h3>
	<?php
	if(count($roles)>0):
	foreach ($roles as $item) :
		echo CHtml::link(
				CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $row))
		);
		echo CHtml::link(
				CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $row)), array(
			'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную роль?')) return false;"
		));
		echo $item->name;
		echo '<br>';
	endforeach;
	endif;
?>
</div>
<div style="float:left; width:200px;">
	<h3>Задачи</h3>
	<?php
	if(count($tasks)>0):
	foreach ($tasks as $row => $item) :
		echo CHtml::link(
				CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $row))
		);
		echo CHtml::link(
				CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $row)), array(
			'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную задачу?')) return false;"
		));
		echo $item->name;
		echo '<br>';
	endforeach;
	endif;
?>
</div>
<div style="float:left; width:200px;">
	<h3>Операции</h3>
	<?php
	if(count($operations)>0):
	foreach ($operations as $row => $item) :
		echo CHtml::link(
				CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $row))
		);
		echo CHtml::link(
				CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $row)), array(
			'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную операцию?')) return false;"
		));
		echo $item->name;
		echo '<br>';
	endforeach;
	endif;
?>
</div>
