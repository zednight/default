<?php
foreach ($data as $row => $value) {
?>
<a href="<?php echo $this->createUrl('roles/deleteRole',array('name'=>$row));?>" OnClick="if(!confirm('Вы уверены, что хотите удалить данную роль?')) return false;"><?php echo $row;?></a><br>
<?php
}
?>
