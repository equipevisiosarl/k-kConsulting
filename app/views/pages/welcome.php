<?php 
$template = 'base';
ob_start();

?>

<?php include viewComponent('apropos/counter_stat') ?>
<?php include viewComponent('apropos/qsn') ?>
<?php include viewComponent('apropos/partenaires') ?>
<?php include viewComponent('contact') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>