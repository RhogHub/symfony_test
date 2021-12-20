<?php
namespace ASPTest\Controllers;

use ASPTest\Models\ModelUser;

class User 
{
    // =====================================================
    // Create User in Database (UC-001)  
    // =====================================================
    public function createUser($data)
    {   
        if(isset($data)) {
            $model = new ModelUser();
            $result = $model->addNewUser($data);

            return $result;
        }        
    }

    // =====================================================
    public function validateCreateUser($data)
    {     
        if(isset($data)) {
            $userFirstName = $data['userFirstName'];
            $userLastName = $data['userLastName'];
            $userEmail = $data['userEmail'];

            if($this->validateUserName($userFirstName) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: First Name must be between 2 and 35 characters."
                ];

                return $data;
            }
    
            if($this->validateUserName($userLastName) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: Last Name must be between 2 and 35 characters."
                ];

                return $data;
            }
    
            if($this->validateEmail($userEmail) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: Invalid e-mail address."
                ];

                return $data;             
            }
    
            if(isset($data['userAge'])) {
                $userAge = $data['userAge'];

                if($this->validateUserAge($userAge) == false) {
                    $data = [
                        'status' => false,
                        'message' => "Error: Invalid age. The age must be positive, no more than 4 digits and no > 150 years."
                    ];
    
                    return $data;               
                } 
            } else {
                $userAge = null;
            }           
            
            $data = [
                'status' => true,
                'message' => "SUCCESS"
            ];

            return $data; 
        }
    } 

    // =====================================================
    // Create a Password for User in Database (UC-002)  
    // =====================================================
    public function createPwd($data)
    {
        if(isset($data)){
            $userId =  $data['userId'];
            $userPass = $data['userPass'];

            $userHashPass = $this->hashPass($userPass);

            $model = new ModelUser();
            $result = $model->addNewPassword($userId, $userHashPass);

            return $result;
        }
    } 

    // =====================================================
    public function validateCreatePwd($data)
    {
        if(isset($data)) {
            $userId =  $data['userId'];
            $userPass = $data['userPass'];
            $userConfirmPass = $data['userConfirmPass'];

            if($this->checkUserIdExists($userId) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: There is no user registered with this ID"
                ];

                return $data;               
            }
    
            if($this->validatePass($userPass) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: Invalid password. The password must have at least: 1 special character, 1 number and 1 uppercase letter."
                ];

                return $data;                
            }
    
            if($this->checkMatchPass($userPass, $userConfirmPass) == false) {
                $data = [
                    'status' => false,
                    'message' => "Error: Passwords don't match."
                ];

                return $data;                
            } 
            
            $data = [
                'status' => true,
                'message' => "SUCCESS"
            ];

            return $data;
        }
    }

    // =====================================================
    // Checks and validations - PRIVATE FUNCTIONS
    // =====================================================  
    private function validateUserName($inputUserName)
    {
        // checks if the username size is valid.
        if(isset($inputUserName) && (is_string($inputUserName))) {

            $lenUserName = strlen($inputUserName);

            if($lenUserName < 2 || $lenUserName > 35) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    // =====================================================
    private function validateUserAge($age)
    {
        // Check if the age of the user is valid.
        if($age < 0 ) {
            return false;
        }

        if($age > 150) {
            return false;
        }

        if(!preg_match("/^[0-9]{0,4}$/", $age)) {
            return false;
        }  
        
        return true;
    }
  
    // =====================================================
    private function validateEmail(string $userEmail)
    {
        //Checks if the email is valid.
        if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }
   
    // =====================================================
    private function checkUserIdExists($userId)
    {
        //Checks if the user ID exist in database.
        if(isset($userId)) {
            $model = new ModelUser();
            $results = $model->checkUserIdDb($userId);
            return $results;
        }
    }

    // =====================================================
    private function validatePass($password)
    {
        //Check if password:
        //Enforce length - OK      
        //Contains uppercase - OK        
        //Contains digit - OK
        //Contains symbol - OK

        $minlength = 6;

        if((strlen($password) >= $minlength) && 
            (preg_match("/[A-Z]/", $password)) &&     
            (preg_match("/[0-9]/", $password)) &&
            (preg_match("/[^a-zA-Z0-9]/", $password))) {

            // valid password
            return true;
        } else {
            return false;
        }        
    }

    // =====================================================
    private function checkMatchPass($userPass, $userConfirmPass)
    {
        //Checks if the passwords match.

        if($userPass == $userConfirmPass) {
            return true;
        } else {
            return false;
        }
    }

    // =====================================================   
    private function hashPass($password)
    {
        //mcrypt - This function has been DEPRECATED as of PHP 7.1.0 and REMOVED as of PHP 7.2.0. Relying on this function is highly discouraged.
        //The salt option is deprecated. It is now preferred to simply use the salt that is generated by default. As of PHP 8.0.0, an explicitly given salt is ignored.
        //PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). 

        return password_hash($password, PASSWORD_DEFAULT);        
    }

    // =====================================================
    private function sanitizationUserName(string $inputUserName)
    {
        //Sanitizes the input username string (for storage).
        if(isset($inputUserName) && (is_string($inputUserName))) {
            $sanitizedUserName = trim($inputUserName);
            $sanitizedUserName = utf8_encode($sanitizedUserName);
            $sanitizedUserName = filter_var($sanitizedUserName, FILTER_SANITIZE_STRING);
            
            return $sanitizedUserName;
        } else {
            return false;
        }
    }

    // =====================================================
    private function sanitizationEmail(string $userEmail)
    {
        //Sanitizes the input user email string (for storage).
        $userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);

        return $userEmail;
    }


}
