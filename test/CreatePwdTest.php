<?php

use PHPUnit\Framework\TestCase;
use ASPTest\Controllers\User;

class CreatePwdTest extends TestCase
{
    /**
    * @dataProvider dataValuesValidateCreatePwd
    */
    public function testeValidateCreatePwd($data)
    {
        $user = new User();        
        $status = $user->ValidateCreatePwd($data);
        
        $this->assertEquals(false, $status['status']);
    }

    // =====================================================
    public function dataValuesValidateCreatePwd()
    {       
        $data1 = [
            "userId" => 1,
            "userPass" => "aaaa1",
            "userConfirmPass" => "aaaa1"           
        ];

        $data2 = [
            "userId" => 1,
            "userPass" => "aaaa1%",
            "userConfirmPass" => "aaaa1%"           
        ];

        $data3 = [
            "userId" => 10,
            "userPass" => "A%aa1A",
            "userConfirmPass" => "A%aa1A"           
        ];

        $data4 = [
            "userId" => 1,
            "userPass" => "aaaa1@A",
            "userConfirmPass" => "aaaa1@"           
        ];

        $data5 = [
            "userId" => 45,
            "userPass" => "aaaa1@A",
            "userConfirmPass" => "aaaa1@A"           
        ];       

        return [
            [$data1],
            [$data2],
            [$data3],
            [$data4],
            [$data5]            
        ];
    }

}
