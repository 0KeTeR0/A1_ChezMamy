<?php
namespace App\Chezmamy\Model;

use App\Chezmamy\Lib\DatabaseConnection;

class Login
{
    /**
     * @param array $input the data entered by the user [0] = password; [1] = email
     * @return array [0] = message, [1] = user_id
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
                    "SELECT id_user FROM Users WHERE email = ?"
                );
                $statementId->execute([$input[1]]);
                $result[1]=$statementId->fetch()['id_user'];
            }
            else{$result[0]="Mot de passe incorrect.";}
        }
        else{
            $result[0]="Adresse email invalide";
        }

        return $result;

    }
}