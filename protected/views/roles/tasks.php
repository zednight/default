<table>
	<?php
	if(count($data)>0):
	foreach ($data as $row => $value) :
		?>
		<tr>
			<td>
				<?php echo $row; ?>
			</td>
			<td>
				<?php echo $value->description; ?>
			</td>
			<td>
				<?php echo $value->bizRule; ?>
			</td>
			<td>
				<?php
				echo CHtml::link(
						CHtml::image('/images/update.png'), $this->createUrl('roles/editTask', array('name' => $row))
				);
				echo CHtml::link(
						CHtml::image('/images/delete.png'), $this->createUrl('roles/deleteTask', array('name' => $row)), array(
					'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную роль?')) return false;"
				));
				?>
			</td>
		</tr>
	<?php
	endforeach;
	endif;
?>
</table>