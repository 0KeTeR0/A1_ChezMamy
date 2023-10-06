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
        $database = DatabaseConnection::GetConnection();

        $statementUser= $database->prepare(
            "SELECT * FROM Users WHERE email = ?"
        );
        $statementUser->execute([$input[1]]);


        if($statementUser->rowCount() == 1) {
            $user = $statementUser->fetch();
            if(password_verify($input[0], $user['password'])) {
                $result[0]="";
                $statementId= $database->prepare(
                    "SELECT user_id FROM Users WHERE email = ?"
                );
                $statementId->execute([$input[1]]);
                $result[1]=$statementId->fetch()['user_id'];
            }
            else{$result[0]="Mauvais mot de passe.";}
        }
        else{
            $result[0]="mauvaise addresse mail";
        }

        return $result;

    }
}