<?php 
$template = 'base';
$TITRE = 'Formations';
$DESCRIPTION = 'Description';
ob_start();

?>
<?php include viewComponent('formations') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>