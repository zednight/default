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
echo '<table class="tv">' . "\r\n";
echo '<tr>' . "\r\n";
echo '<td>' . "\r\n";
echo "<p>Роли</p>\r\n";
echo '</td>' . "\r\n";
echo '<td>' . "\r\n";
echo "<p>Задачи</p>\r\n";
echo '</td>' . "\r\n";
echo '<td>' . "\r\n";
echo "<p>Операции</p>\r\n";
echo '</td>' . "\r\n";
echo '<td>' . "\r\n";
echo "<p>Статус</p>\r\n";
echo '</td>' . "\r\n";
echo '</tr>' . "\r\n";
echo '<tr>' . "\r\n";
foreach ($elements as $element => $values) {
	echo '<td>' . "\r\n";
	if (count($values)):
		foreach ($values as $item) :
			echo '<div>' . "\r\n";
			if ($authItem->getName() !== $item->name && Yii::app()->authManager->getAuthItem($item->name)->hasChild($authItem->getName()))
			{
				echo CHtml::link(
						CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
				);
				echo CHtml::link(
						CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
					'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
				));
				echo CHtml::link(
						CHtml::image('/images/minus.gif'), $this->createUrl('roles/deleteParent', array(
							'name' => $item->name,
							'child' => $authItem->getName()
						)));

				echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)),Yii::app()->user->checkAccess($item->name) ? array('style'=>'font-weight:bold;') : array());
			}
			echo '</div>' . "\r\n";
		endforeach;
	endif;
	echo '</td>' . "\r\n";
}
echo '<td>' . "\r\n";
echo "<p>Родители</p>\r\n";
echo '</td>' . "\r\n";
echo '</tr>' . "\r\n";
echo '<tr>' . "\r\n";
echo '<td style=" border-right:0px; text-align:center;">' . "\r\n";
if ($authItem->getType() === 2)
{
	echo CHtml::link(
			CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
	);
	echo CHtml::link(
			CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
		'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
	));

	echo '<h3 style="color:#F00;">' . $authItem->getName() . '</h3>' . "\r\n";
}
echo '</td>' . "\r\n";
echo '<td style=" border-left:0px; border-right:0px; text-align:center;">' . "\r\n";
if ($authItem->getType() === 1)
{
	echo CHtml::link(
			CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
	);
	echo CHtml::link(
			CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
		'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
	));

	echo '<h3 style="color:#F00;">' . $authItem->getName() . '</h3>' . "\r\n";
}
echo '</td>' . "\r\n";
echo '<td style=" border-left:0px; text-align:center;">' . "\r\n";
if ($authItem->getType() === 0)
{
	echo CHtml::link(
			CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
	);
	echo CHtml::link(
			CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
		'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
	));

	echo '<h3 style="color:#F00;">' . $authItem->getName() . '</h3>' . "\r\n";
}
echo '</td>' . "\r\n";
echo '<td>' . "\r\n";
echo "<p>Элемент</p>\r\n";
echo '</td>' . "\r\n";
echo '</tr>' . "\r\n";
echo '<tr>' . "\r\n";
foreach ($elements as $element => $values) {
	echo '<td>' . "\r\n";
	if (count($values)):
		foreach ($values as $item) :
			echo '<div>' . "\r\n";
			if ($authItem->getName() !== $item->name && $authItem->hasChild($item->name))
			{
				echo CHtml::link(
						CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
				);
				echo CHtml::link(
						CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
					'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
				));
				echo CHtml::link(
						CHtml::image('/images/minus.gif'), $this->createUrl('roles/deleteChild', array(
							'name' => $item->name,
							'parent' => $authItem->getName()
						)));
				echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)),Yii::app()->user->checkAccess($item->name) ? array('style'=>'font-weight:bold;') : array());
			}
			echo '</div>' . "\r\n";
		endforeach;
	endif;
	echo '</td>' . "\r\n";
}
echo '<td>' . "\r\n";
echo "<p>Потомки</p>\r\n";
echo '</td>' . "\r\n";
echo '</tr>' . "\r\n";

echo '<tr>' . "\r\n";
foreach ($elements as $element => $values) {
	echo '<td>' . "\r\n";
	if (count($values)):
		foreach ($values as $item) :
			echo '<div>' . "\r\n";
			if ($authItem->getName() !== $item->name && !$authItem->hasChild($item->name) && !Yii::app()->authManager->getAuthItem($item->name)->hasChild($authItem->getName()))
			{
				echo CHtml::link(
						CHtml::image('/images/update.png'), $this->createUrl('roles/edit', array('name' => $item->name))
				);
				echo CHtml::link(
						CHtml::image('/images/delete.png'), $this->createUrl('roles/delete', array('name' => $item->name)), array(
					'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную Роль?')) return false;"
				));
				if ($authItem->getType() >= Yii::app()->authManager->getAuthItem($item->name)->getType())
					echo CHtml::link(
							CHtml::image('/images/child.png'), $this->createUrl('roles/addChild', array(
								'name' => $item->name,
								'parent' => $authItem->getName()
							)));
				if ($authItem->getType() <= Yii::app()->authManager->getAuthItem($item->name)->getType())
					echo CHtml::link(
							CHtml::image('/images/parent.png'), $this->createUrl('roles/addParent', array(
								'name' => $authItem->getName(),
								'parent' => $item->name,
							)));
					echo CHtml::link($item->name, $this->createUrl('roles/detail', array('name' => $item->name)),Yii::app()->user->checkAccess($item->name) ? array('style'=>'font-weight:bold;') : array());
			}
			echo '</div>' . "\r\n";
		endforeach;
	endif;
	echo '</td>' . "\r\n";
}
echo '<td>' . "\r\n";
echo "<p>Остальные</p>\r\n";
echo '</td>' . "\r\n";
echo '</tr>' . "\r\n";
echo '</table>'
?>
