<?php 
$template = 'base';
ob_start();

?>
<?php include viewComponent('apropos/presentation_humain') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>