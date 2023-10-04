<?php

namespace App\Chezmamy\Controllers;


use App\Chezmamy\Model\Register;
use App\Chezmamy\Model\UserModel;
use DateTime;

/**
 * Register controller for inscriptions
 */
class RegisterController
{
    /**
     * load the inscription page or register
     * a new user if the input contains all the
     * necessary information.
     * @param array|null $input information for the inscription
     * @return void
     */
    public function execute(?array $input)
    {
        //If the input contains information
        if(count($input) > 0) {
            //We verify which type of account needs to be created
            if (isset($input['registerStudent'])) {
                //We then verify the necessary fields
                $verification=$this->verifyStudent($input);
                if(!empty($input['email']) && !empty($input['last_name']) && !empty($input['first_name']) && !empty($input['date_of_birth'])&& !empty($input['phone'])&& !empty($input['nationality'])&& !empty($input['parents_address'])&& !empty($input['city'])&& !empty($input['postal_code'])&& !empty($input['education_level'])&& !empty($input['establishment'])&& !empty($input['end_of_studies'])&& !empty($input['is_smoking'])&& !empty($input['is_allergic'])&& !empty($input['can_drive'])&& !empty($input['housing'])&& !empty($input['password'])&& !empty($input['password_repeat']) && $verification==""){

                    //We create an object of the user class to work more easily with it.
                    $newUser = new UserModel();
                    $newUser->setEmail(filter_var($input['email'],FILTER_SANITIZE_EMAIL));
                    $newUser->setLast_Name(strip_tags($input['last_name']));
                    $newUser->setFirst_Name(strip_tags($input['first_name']));
                    $newUser->setDate_Of_Birth($input['date_of_birth']);
                    $newUser->setNationality(strip_tags($input['nationality']));
                    $newUser->setPhone($input['phone']);
                    $newUser->setParents_Adress(strip_tags($input['parents_address']));
                    $newUser->setCity(strip_tags($input['city']));
                    $newUser->setPostalCode($input['postal_code']);
                    $newUser->setKnow_Association(strip_tags($input['know_association']));
                    $newUser->setEducation_Level(strip_tags($input['education_level']));
                    $newUser->setInterships(strip_tags($input['internships']));
                    $newUser->setEstablishment(strip_tags($input['establishment']));
                    $newUser->setEnd_Of_Studies(date('Y-m-d', time()+((($input['end_of_studies']*365)*24)*60)));
                    $newUser->setDate_Of_Arrival($input['date_of_arrival']);
                    $newUser->setMotivation(strip_tags($input['motivation']));
                    $newUser->setIs_Smoking($input['is_smoking']);
                    $newUser->setIs_Allergic($input['is_allergic']);
                    $newUser->setAllergies(strip_tags($input['allergies']));
                    $newUser->setCan_Drive($input['can_drive']);
                    $newUser->setMeans_Of_Locomotion(strip_tags($input['means_of_locomotion']));
                    $newUser->setInterests(strip_tags($input['interests']));
                    $newUser->setWhy(strip_tags($input['why']));
                    $newUser->setHousing($input['housing']);
                    $newUser->setHousing_2_Availabilities(strip_tags($input['housing_2_availabilities']));
                    $newUser->setHousing_3_Budget(strip_tags($input['housing_3_budget']));
                    $newUser->setPreferences(strip_tags($input['preferences']));
                    $newUser->setPassword(strip_tags($input['password']));

                    //We add it to the database using the register model
                    $register = new Register();
                    $res = $register->execute($newUser,strip_tags($input['password_repeat']),1);

                    //If everything went well we send the user to the login page
                    if(!$res['success']) throw new \Exception($res['message']);
                    else {
                        header('Location: index.php?action=login');
                    }
                }
                else throw new \Exception("Veuillez remplir tous les champs correctement :".$verification);
            }
            else throw new \Exception("Type de compte invalide");

        }

        require('templates/Register.php');
    }


    /**
     * verify the student data recieved by the controller
     * @param array $input new student data to verify
     * @return bool false if the data is incorrect, true if correct
     */
    private function verifyStudent(array $input): string {
        #A changer : faire en sorte que si un des tests est vrai alors les autres ne peuvent pas le remettre à faux
        $result = "";
        if(!filter_var($input['email'],FILTER_VALIDATE_EMAIL)){$result ="Email invalide";}
        if(strlen($input['last_name'])<=1){$result="Nom de famille invalide";}
        if(strlen($input['first_name'])<=1){$result="Prenom invalide.";}
        if(!$this->verifyDate($input['date_of_birth'])){$result="Date de naissance invalide";}
        if(!DateTime::createFromFormat('d/m/Y',$input['date_of_birth'])<((new DateTime())->modify('-18 year'))){$result="Date de naissance invalide";}
        if(strlen($input['nationality'])<=1){$result="Nationalité invalide.";}
        if(!preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/", $input['phone'])){$result="numéro de téléphone invalide.";}
        if(strlen($input['parents_address'])<=1){$result="Addresse des parents invalide.";}
        if(strlen($input['city'])>1){$result="Ville invalide.";}
        if(!filter_var($input['postal_code'],FILTER_VALIDATE_INT)){$result="Code postal invalide.";}
        if(strlen($input['education_level'])<=1){$result="Education invalide.";}
        if(strlen($input['establishment'])<=1){$result="Etablissement invalide.";}
        if($input['end_of_studies']>0){$result="Année restante d'étude invalide.";}
        if(strlen($input['date_of_arrival'])>1) {
            if(!$this->verifyDate($input['date_of_arrival'])){$result="Date d'arrivée invalide.";}
            if(!DateTime::createFromFormat('d/m/Y',$input['date_of_arrival'])<(new DateTime())){$result="Date d'arrivée invalide.";}
        }
        if(!filter_var($input['is_smoking'],FILTER_VALIDATE_BOOL)){$result="Fume invalide.";}
        if(!filter_var($input['is_allergic'],FILTER_VALIDATE_BOOL)){$result="Allergique invalide";}
        if($input['is_allergic'])
        {
            if(strlen($input['allergies'])<=1){$result="Details allergies invalide.";}
        }
        if(filter_var($input['can_drive'],FILTER_VALIDATE_BOOL)){$result="Permis de conduire invalide.";}

        if(filter_var($input['housing'],FILTER_VALIDATE_INT)){$result="type d'hébergement invalide.";}
        if($input['housing']==2){
            if(strlen($input['housing_2_availabilities'])<=1){$result="disponibilités pour l'hébergement participatif invalide.";}
        }
        if($input['housing']==3){
            if(strlen($input['housing_3_budget'])<=1){$result="informations de budget pour l'hébergement invalide.";}
        }
        if(strlen($input['password'])<=8){$result="mot de passe invalide.";}

        return $result;
    }

    /**
     * verify the date format
     * @param string $date
     * @return bool
     */
    private function verifyDate(string $date): bool{
        $result = false;
        $test_arr  = explode('/', $date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
                $result = true;
            }
        }
        return $result;
    }
}