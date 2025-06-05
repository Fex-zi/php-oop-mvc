<?php 
declare(strict_types=1);

use models\contact\Contactus;

$cc = new Contactus();
//$cc->runAction(); // This will call runBeforeAction()

if($action == 'show') {
    $cc->showForm();
} else if ($action == 'submit'){
    $cc->submitForm();
} else {
     include __DIR__ .'/../views/status-pages/404.php';

}

?>
