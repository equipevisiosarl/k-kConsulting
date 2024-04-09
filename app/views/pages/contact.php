<?php 
$template = 'base';
$TITRE = 'Contacts';
$DESCRIPTION = 'Description';
ob_start();

?>
<?php include viewComponent('contact') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>