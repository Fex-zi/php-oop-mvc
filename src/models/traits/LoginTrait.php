<?php

namespace models\traits;
use models\Security\Safe;

trait LoginTrait{


    public function doLogin($email, $password, $userType = 1){
        if($_POST['action'] === 'login'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Validate email format using static method
            if(!Safe::checkEmail($email)){
                return [
                    'success' => false,
                    'message' => 'Invalid email format'
                ];
            }
            
            // Sanitize inputs
            $email = trim($email);
            $password = trim($password);
            
            // Check if fields are empty
            if(empty($email) || empty($password)){
                return [
                    'success' => false,
                    'message' => 'Email and password are required'
                ];
            }
            
            // Find user in database
            $user = $this->findby($email);
            
            if($user && password_verify($password, $user['password'])){
                // Login successful - store only essential session data
                $_SESSION['user_id'] = $user['id'];
                
                // Set role-specific session
                if($userType === 1){
                    $_SESSION['is_admin'] = true;
                } else {
                    $_SESSION['is_user'] = true;
                }
                
                return [
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user
                ];
            } else {
                // Login failed
                return [
                    'success' => false,
                    'message' => 'Invalid email or password'
                ];
            }
        }
        
        return [
            'success' => false,
            'message' => 'Invalid action'
        ];
    }
    
    public function logout(){
        session_destroy();
        header("Location: home"); 
        return [
            'success' => true,
            'message' => 'Logged out successfully'
        ];
    }
}
//$2y$10$oFov9DNlG1Au4mTaEjeUROlJNiV2PKF1T5.fGqKAKBp05e9uxdioi  ..TopSecret
