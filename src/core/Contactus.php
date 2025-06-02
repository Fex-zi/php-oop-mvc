<?php
declare(strict_types=1);

namespace core;

class Contactus extends Export {

    public function runBeforeAction(){

        if($_SESSION['has_submitted_the_form'] ?? 0 === 1){
             include __DIR__ .'/../view/thank-you.php'; 
             return false;
        }
        return true;

    }

    public function showForm(){
        include __DIR__ .'/../view/contact-us-view.php'; 
    }

    public function submitForm(){
        //validate
        //store data
        //send email
        include __DIR__ .'/../view/thank-you.php'; 
    }
}
