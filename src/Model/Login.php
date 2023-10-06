<?php
namespace App\Chezmamy\Model;

use App\Chezmamy\Lib\DatabaseConnection;

class Login
{
    /**
     * @param array $input the data entered by the user [0] = password; [1] = email
     * @return void "" if success.
     */
    public function execute(array $input): array
    {
        $result= array("","");
        $tempUserId="";
        $tempEmail="";
        $tempPassword="";
        $database = DatabaseConnection::GetConnection();

        $statementEmail = $database->prepare(
            "SELECT email FROM Users WHERE email = $input[1]"
        );
        $statementEmail->execute();

        $statementPassword = $database->prepare(
            "SELECT password FROM Users WHERE email = $input[1]"
        );
        $statementPassword->execute();
        $tempPassword=$statementPassword->fetch();

        if(password_verify($input[0],$tempPassword))
        {

            $statementUserId = $database->prepare(
                "SELECT user_id FROM Users WHERE email = $input[1] AND password = $input[0]"
            );
            $statementUserId->execute();
            $tempUserId = $statementUserId->fetch();
        }

        $tempEmail = $statementEmail->fetch();


        if($tempUserId == "" )
        {
            $result[0] = "Adresse mail + mot de passe introuvable";
        }

        else if($tempEmail == "")
        {
            $result[0] = "Adresse mail introuvable";
        }

        else{$result[1]=$tempUserId; }

        return $result;


    }
}