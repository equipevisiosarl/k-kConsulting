<?php 
$template = 'base';
$TITRE = 'Partenariat';
$DESCRIPTION = 'Description partenariat';
ob_start();

?>
<?php include viewComponent('formPartenaire') ?>
<?php include viewComponent('apropos/partenaires') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>