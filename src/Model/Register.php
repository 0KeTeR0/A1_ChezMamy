<?php

namespace App\Chezmamy\Model;

use App\Chezmamy\Lib\Database\DatabaseConnection;
class Register
{

    /**
     * Add a user to the database
     * @param UserModel $newUser the new user that needs to be added to the database
     * @param string $password_repeat needed to verify that the password is correct
     * @return array //the result of the operation
     */
    public function execute(UserModel $newUser,string $password_repeat,int $role_id): array
    {
        $message = "Une erreur est survenue pendant l'exécution de la requête.";
        $success = false;
        $database = DatabaseConnection::getConnection();

        //we verify that no user already has the specified email
        $statement = $database->prepare(
            "SELECT * FROM users WHERE email = ?"
        );
        $statement->execute([$newUser->GetEmail()]);

        // If the email is not yet used, ok, we add the user
        if($statement->rowCount() == 0) {
            if($newUser->GetPassword() == $password_repeat) {

                $statement = $database->prepare(
                    "USE ChezMamy"
                );
                $statement->execute();

                $statement = $database->prepare(
                    "INSERT INTO users (email,last_name, first_name,date_of_birth,nationality,phone,parents_address,city,postal_code,know_association,education_level,internships,establishment,end_of_studies,date_of_arrival,motivations,is_smoking,is_allergic,allergies,can_drive,means_of_locomotion,interests,why,housing,housing_2_availabilities,housing_3_budget,preferences,password,id_role) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
                );
                $res = $statement->execute([$newUser->getEmail(),$newUser->getLast_Name(),$newUser->getFirst_Name(),$newUser->getDate_Of_Birth(),$newUser->getNationality(),$newUser->getPhone(),$newUser->getParents_Adress(),$newUser->getCity(),$newUser->getPostalCode(),$newUser->getKnow_Association(),$newUser->getEducation_Level(),$newUser->getInternships(),$newUser->getEstablishment(),$newUser->getEnd_Of_Studies(),$newUser->getDate_Of_Arrival(),$newUser->getMotivation(),$newUser->getIs_Smoking(),$newUser->getIs_Allergic(),$newUser->getAllergies(),$newUser->getCan_Drive(),$newUser->getMeans_Of_Locomotion(),$newUser->getInterests(),$newUser->getWhy(),$newUser->getHousing(),$newUser->getHousing_2_Availabilities(),$newUser->getHousing_3_Budget(),$newUser->getPreferences(), password_hash($newUser->getPassword(), PASSWORD_DEFAULT),$role_id]);

                if($res) {

                    $success = true;
                    $message = "Vous êtes bien inscrit.";
                }
            }
            else $message = "Les mots de passe ne correspondent pas.";
        }
        else $message = "Cette addresse mail est déjà utilisée.";

        return [
            'success' => $success,
            'message' => $message];
    }
}