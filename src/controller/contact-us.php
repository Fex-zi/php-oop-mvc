<?php 
declare(strict_types=1);

use core\Contactus;

$cc = new Contactus();

if($action == 'show') {
    $cc->showForm();
} else if ($action == 'submit'){
    $cc->submitForm();
} else {
     include __DIR__ .'/../view/status-pages/404.php';

}

?>
