<?php 
$template = 'base';
$TITRE = 'A Propos';
$DESCRIPTION = 'Description';
ob_start();

?>
<?php include viewComponent('apropos/qsn') ?>
<?php include viewComponent('apropos/counter_stat') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>