<?php

namespace models\Security;

class Safe{

    public static function checkEmail($email){

        $email = trim($email);

        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    public static function verifyInt($input): int {

    return filter_var($input, FILTER_VALIDATE_INT);

    }

    public static function verifyFloat($input): float {

        return filter_var($input, FILTER_VALIDATE_FLOAT);
    }


    public static function hashPassword($password){

        return password_hash($password, PASSWORD_DEFAULT);  

    }

    public static function confirmPass($password, $confirmPassword): bool {

        if($password === $confirmPassword){
            return true;

        }

        return false;
    }

    
    public static function escape($html){

        return htmlspecialchars($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }


    public static function sanitizeString($input): string {

        return trim(strip_tags($input));
    }

    public static function generateToken(): string {

        return bin2hex(random_bytes(32));
    }

    public static function validatePassword($password): array {

        $errors = [];
        if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters";
        if (!preg_match('/[A-Z]/', $password)) $errors[] = "Password must contain uppercase letter";
        if (!preg_match('/[a-z]/', $password)) $errors[] = "Password must contain lowercase letter";
        if (!preg_match('/[0-9]/', $password)) $errors[] = "Password must contain number";
        
        return ['valid' => empty($errors), 'errors' => $errors];
    }


   
    }
