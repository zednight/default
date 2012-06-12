<script type='text/javascript'>
	$(function(){
		$('.ajax').click(function(){
			$(this).closest('div').find('[title!=null]').css('color','');
			var str=$(this).attr('href');
			if(str.indexOf('addChild') + 1) {
				$(this).closest('div').find('[title!=null]').css('color','#F00');
				$(this).closest('div').find('a [title!=null]').attr('src','/images/minus.gif');
			}
			return false;
		});
	})
</script>
<?php
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
			$rusname = 'роль';
			break;
		case 'tasks':
			$rusname = 'задачу';
			break;
		case 'operations':
			$rusname = 'операцию';
			break;
	}
	if (count($values) > 0):
		foreach ($values as $item) :
			echo '<div>';
			echo CHtml::link(
					CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
			);
			echo CHtml::link(
					CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
				'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную " . $rusname . "?')) return false;"
			));

			if ($authItem->getName() === $item->name)
			{
				echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)), array('style' => 'font-style:italic;', 'title' => 'Текущий элемент'));
			}
			elseif ($authItem->hasChild($item->name))
			{
				echo CHtml::link(
						CHtml::image('/images/minus.gif'), $this->createUrl('roles/deleteChild', array('name' => $item->name, 'parent' => $authItem->getName())), array(
						'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данного Потомка?')) return false;",
						'class'=>'ajax',
				));
				echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)), array('style' => 'color:#F00;', 'title' => 'Потомок'));
			}
			else
			{
				if (!$item->hasChild($authItem->getName()))
				{
					echo CHtml::link(
							CHtml::image('/images/plus.gif'), $this->createUrl('roles/addChild', array('name' => $item->name, 'parent' => $authItem->getName())), array(
						//'OnClick'=>'return false',
						'title' => 'Добавить потомка',
						'class'=>'ajax',
						)
					);
				}
				else
				{
					echo CHtml::link(
							CHtml::image('/images/minus.gif'), $this->createUrl('roles/deleteParent', array('name' => $item->name, 'child' => $authItem->getName())), array(
						'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данного Родителя?')) return false;",
						'class'=>'ajax',
					));
				}
				echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)), $item->hasChild($authItem->getName()) ? array('style' => 'font-weight:bold;', 'title' => 'Родитель') : NULL);
			}
			//echo '<br>';
			echo '</div>';
		endforeach;
	endif;
	echo '</div>';
}
?>
