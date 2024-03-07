<?php 
$template = 'base';
ob_start();

?>
<?php include viewComponent('apropos/qsn') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>