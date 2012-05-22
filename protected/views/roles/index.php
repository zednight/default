<table>
	<?php
	foreach ($data as $row => $value) {
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
						CHtml::image('/images/update.png'), $this->createUrl('roles/editRole', array('name' => $row))
				);
				echo CHtml::link(
						CHtml::image('/images/delete.png'), $this->createUrl('roles/deleteRole', array('name' => $row)), array(
					'OnClick' => "if(!confirm('Вы уверены, что хотите удалить данную роль?')) return false;"
				));
				?>
			</td>
		</tr>
	<?php
}
?>
</table>