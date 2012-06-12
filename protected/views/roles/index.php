	<?php
	$elements = array();
	$elements['roles'] = $roles;
	$elements['tasks'] = $tasks;
	$elements['operations'] = $operations;
	foreach ($elements as $element => $values) {
		echo '<div style="float:left; width:200px;">';
		switch ($element) {
			case 'roles':
				echo '<h3>Роли</h3>';
				break;
			case 'tasks':
				echo '<h3>Задачи</h3>';
				break;
			case 'operations':
				echo '<h3>Операции</h3>';
				break;
		}
		switch ($element) {
			case 'roles':
				$rusname= 'роль';
				break;
			case 'tasks':
				$rusname= 'задачу';
				break;
			case 'operations':
				$rusname= 'операцию';
				break;
		}
	if (count($values) > 0):
		foreach ($values as $item) :
			echo CHtml::link(
					CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
			);
			echo CHtml::link(
					CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
				'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную ".$rusname."?')) return false;"
			));
			echo CHtml::link($item->name,$this->createUrl('roles/detail', array('name' => $item->name)));
			echo '<br>';
		endforeach;
	endif;
	echo '</div>';
	}
	?>
