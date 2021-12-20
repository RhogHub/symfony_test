<?php

use PHPUnit\Framework\TestCase;
use ASPTest\Controllers\User;

class CreateUserTest extends TestCase
{
    /**
    * @dataProvider dataValuesValidateCreateUser
    */
    public function testeValidateCreateUser($data)
    {
        $user = new User();        
        $result = $user->validateCreateUser($data);
        $results = $result['status'];

        $this->assertEquals(true, $results);
    }

    // =====================================================
    public function dataValuesValidateCreateUser()
    {
        $dataA = [
            "userFirstName" => "aaa",
            "userLastName" => "bbbb",
            "userEmail" => "aab@gmail.com",
            "userAge" => 10
        ];

        $dataB = [
            "userFirstName" => "Renato",
            "userLastName" => "Reis",
            "userEmail" => "renator@gmail.com",
            "userAge" => 59
        ];

        $dataC = [
            "userFirstName" => "Regis",
            "userLastName" => "Arantes",
            "userEmail" => "arantes@gmail.com",
            "userAge" => 61
        ];

        $dataD = [
            "userFirstName" => "Alberto",
            "userLastName" => "Ribeiro",
            "userEmail" => "a.ribeiro@gmail.com",
            "userAge" => 33
        ];

        $dataF = [
            "userFirstName" => "Alex",
            "userLastName" => "Dutra",
            "userEmail" => "dutra@hotmail.com",
            "userAge" => 149
        ];

        $dataG = [
            "userFirstName" => "Joao",
            "userLastName" => "Carlos",
            "userEmail" => "jc@gmail.com.br",
            "userAge" => 19
        ];

        $dataH = [
            "userFirstName" => "Rodrigo",
            "userLastName" => "Villa",
            "userEmail" => "villa.rodrigo@gmail.com",
            "userAge" => 35
        ];

        $dataI = [
            "userFirstName" => "Jose",
            "userLastName" => "Carlos",
            "userEmail" => "joseac@hotmail.com",
            "userAge" => 30
        ];

        $dataJ = [
            "userFirstName" => "Laiane",
            "userLastName" => "Lima",
            "userEmail" => "lali@gmail.com",
            "userAge" => 23
        ];

        $dataK = [
            "userFirstName" => "Laislan",
            "userLastName" => "Lima",
            "userEmail" => "lima34@gmail.com",
            "userAge" => 34
        ];

        $dataL = [
            "userFirstName" => "Manuel",
            "userLastName" => "Dias",
            "userEmail" => "dias.m@gmail.com",
            "userAge" => 18
        ];

        $dataM = [
            "userFirstName" => "Leonel",
            "userLastName" => "Brito",
            "userEmail" => "brito@gmail.com",
            "userAge" => 19
        ];

        $dataN = [
            "userFirstName" => "bbbbbbbbbbbbbb",
            "userLastName" => "cccccccccc",
            "userEmail" => "bc@gmail.com",
            "userAge" => 76
        ];

        return [
            [$dataA],
            [$dataB],
            [$dataC],
            [$dataD],
            [$dataF],
            [$dataG],
            [$dataH],
            [$dataI],
            [$dataJ],
            [$dataK],
            [$dataL],
            [$dataM],
            [$dataN]
        ];
    }

}
