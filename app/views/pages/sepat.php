<?php 
$template = 'base';
$TITRE = 'Sepat';
$DESCRIPTION = 'Description';
ob_start();

?>
<?php include viewComponent('detail_sepat') ?>
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>