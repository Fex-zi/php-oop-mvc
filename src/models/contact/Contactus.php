<?php
declare(strict_types=1);

namespace models\contact;

class Contactus {

    public function runBeforeAction(){
        // echo '<pre>';
        // print_r($_SESSION);
        // die();
        
        if($_SESSION['has_submitted_the_form'] ?? false){
             include __DIR__ .'/../../controllers/about-us.php'; 
             return false;
        }
        return true;

    }

    public function showForm(){
        include __DIR__ .'/../../views/contact-us-view.php'; 
    }

    public function submitForm(){
        //validate
        //store data
        //send email
        include __DIR__ .'/../../views/thank-you.php'; 
    }
}
