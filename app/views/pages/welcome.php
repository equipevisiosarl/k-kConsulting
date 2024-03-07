<?php 
$template = 'base';
ob_start();

?>


    <h1>Welcome to PHPFx</h1>

 
<?php 

$content = ob_get_clean();
require viewTemplate($template);

?>