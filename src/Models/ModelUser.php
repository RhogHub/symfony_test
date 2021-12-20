<?php
namespace ASPTest\Models;

use ASPTest\Database\Database;

class ModelUser
{
    // =====================================================
    public function addNewUser($data)
    {
        try 
        {
            $db = new Database();
            $params =array(
                ':userId' => 0,
                ':name' => $data['userFirtName'].' '.$data['userLastName'],
                ':email' => $data['userEmail'],
                ':age' => $data['userAge']
            );

            $db->EXE_NON_QUERY("
            INSERT INTO users
                VALUES(
                    :userId,
                    :name,
                    :email,
                    :age,
                    '',
                    NOW(),
                    '',
                    ''            
                )
            ", $params); 
            
            return true;

        } catch (Exception $e) {
            return $e;
        }   
            
    }

    // =====================================================
    public function addNewPassword($useId, $password)
    {
        try 
        {
            $db = new Database();
            $params =array(
                ':userId' => $useId,
                ':passwordHash' => $password
               
            );

            $db->EXE_NON_QUERY("
            UPDATE users SET
                password_hash = :passwordHash,
                update_at = NOW()
                WHERE user_id = :userId
            ", $params); 

            return true;
            
        } catch (Exception $e) {
            return $e;
        }   
        
    }

    // =====================================================
    public function checkUserIdDb($userId)
    {
        $params =array(
            ':userId' => $userId
        );
               
        try 
        {
            $db = new Database();
            $result = $db->EXE_QUERY("SELECT * FROM users WHERE user_id = :userId ", $params);
                       
            if(count($result)!= 0) {
                return true;
            } else {
                return false;
            }
            
        } catch (Exception $e) {
            return $e;
        }       
    }

}
