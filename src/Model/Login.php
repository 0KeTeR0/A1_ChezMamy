<?php
namespace App\Chezmamy\Model;

use App\Chezmamy\Lib\DatabaseConnection;

class Login
{
    /**
     * @param array $input the data entered by the user [0] = password; [1] = email
     * @return void "" if success.
     */
    public function execute(array $input): string
    {
        $result="";
        $temp="";
        $database = DatabaseConnection::GetConnection();

        $statementEmail = $database->prepare(
            "SELECT email FROM Users WHERE email = $input[1]"
        );
        $statementEmail->execute();

        $statementPassword = $database->prepare(
            "SELECT password,email FROM Users WHERE email = $input[1] AND password = $input[0]"
        );

        if;
        return $result;


    }
}