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
        $message="";
        //If the input contains information
        if(count($input) > 0) {
            //We verify which type of account needs to be created
            if (isset($input['registerStudent'])) {
                //We then verify the necessary fields
                $verification=$this->verifyStudent($input);
                if($verification==""){

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
                    if(!$res['success']) $message=($res['message']);
                    else {
                        $message=($res['message']);
                        header('Location: index.php?p=login');
                    }
                }
                else $message=("Veuillez remplir tous les champs correctement :".$verification);
            }
            //We verify if it's a senior
            else if(isset($input['registerSenior'])){
                //We verify the fields
                $verification=$this->verifySenior($input);
                if($verification==""){

                    //we fill a new user with the senior data
                    $newUser = new UserModel();
                    $newUser->setEmail(filter_var($input['email'],FILTER_SANITIZE_EMAIL));
                    $newUser->setLast_Name(strip_tags($input['last_name']));
                    $newUser->setFirst_Name(strip_tags($input['first_name']));
                    $newUser->setDate_Of_Birth($input['date_of_birth']);
                    $newUser->setPhone($input['phone']);
                    $newUser->setCity(strip_tags($input['city']));
                    $newUser->setPostalCode($input['postal_code']);
                    $newUser->setKnow_Association(strip_tags($input['know_association']));
                    $newUser->setIs_Smoking($input['is_smoking']);
                    $newUser->setWhy(strip_tags($input['why']));
                    $newUser->setHousing($input['housing']);
                    $newUser->setPassword(strip_tags($input['password']));
                    $newUser->setMarital_Status($input['marital_status']);
                    $newUser->setIs_House($input['is_house']);
                    $newUser->setIs_Landlord($input['is_landlord']);
                    $newUser->setHave_Animal($input['have_animal']);
                    $newUser->setAnimal($input['animal']);
                    $newUser->setPublic_Transport_Distance($input['public_transport_distance']);
                    $newUser->setNeeds($input['needs']);
                    $newUser->setPassion_To_Share($input['passion_to_share']);
                    $newUser->setCan_Stay_Summer($input['can_stay_summer']);
                    $newUser->setProfession($input['profession']);
                    $newUser->setAdvantages_With_You($input['advantages_with_you']);
                    $newUser->setHas_Kids($input['has_kids']);
                    $newUser->setHas_Grandkids($input['has_grandkids']);
                    $newUser->setIs_Family_Present($input['is_family_present']);
                    $newUser->setIs_Family_Ok($input['is_family_ok']);
                    $newUser->setRoom_Surface($input['room_surface']);
                    $newUser->setHas_Furniture($input['has_furniture']);
                    $newUser->setCan_Clean($input['can_clean']);
                    $newUser->setHas_Internet($input['has_internet']);
                }
                else $message=("Veuillez remplir tous les champs correctement :".$verification);
            }
            else $message=("Type de compte invalide");

        }

        require('templates/Register.php');
    }


    /**
     * verify the student data recieved by the controller
     * @param array $input new student data to verify
     * @return bool false if the data is incorrect, true if correct
     */
    private function verifyStudent(array $input): string {
        $result = "";
        if(!filter_var($input['email'],FILTER_VALIDATE_EMAIL)){$result ="Email invalide";}
        else if(strlen($input['last_name'])<=1){$result="Nom de famille invalide";}
        else if(strlen($input['first_name'])<=1){$result="Prénom invalide.";}
        else if(!$this->verifyDate($input['date_of_birth']) || strtotime($input['date_of_birth']) > strtotime(((new DateTime())->sub(new \DateInterval('P18Y')))->format("Y/m/d"))){ $result="Date de naissance invalide"; }
        else if(strlen($input['nationality'])<=1){$result="Nationalité invalide.";}
        else if(!preg_match("/^[0-9]{10}$/", $input['phone'])){$result="numéro de téléphone invalide.";}
        else if(strlen($input['parents_address'])<=1){$result="Addresse des parents invalide.";}
        else if(strlen($input['city'])<1){$result="Ville invalide.";}
        else if(!filter_var($input['postal_code'],FILTER_VALIDATE_INT)){$result="Code postal invalide.";}
        else if(strlen($input['education_level'])<=1){$result="Education invalide.";}
        else if(strlen($input['establishment'])<=1){$result="Etablissement invalide.";}
        else if($input['end_of_studies']<0){$result="Année restante d'étude invalide.";}
        else if(strlen($input['date_of_arrival'])>1) {
            if(!$this->verifyDate($input['date_of_arrival']) || !DateTime::createFromFormat('d/m/Y',$input['date_of_arrival'])<(new DateTime())){$result="Date d'arrivée invalide.";}
        }
        else if(!in_array($input['is_smoking'], [0, 1])){$result="Fume invalide.";}
        else if(!in_array($input['is_allergic'], [0, 1])){$result="Allergique invalide";}
        else if($input['is_allergic'])
        {
            if(strlen($input['allergies'])<=1){$result="Details allergies invalide.";}
        }
        else if(!in_array($input['can_drive'], [0, 1])){$result="Permis de conduire invalide.";}
        else if(!is_numeric($input['housing'])){$result=$input['housing']."type d'hébergement invalide.";}
        else if($input['housing']==2){
            if(strlen($input['housing_2_availabilities'])<=1){$result="disponibilités pour l'hébergement participatif invalide.";}
        }
        else if($input['housing']==3){
            if(strlen($input['housing_3_budget'])<=1){$result="informations de budget pour l'hébergement invalide.";}
        }
        else if(strlen($input['password'])<=8){$result="mot de passe invalide.";}

        return $result;
    }

    private function verifySenior(array $input): string {
        $result="";
        if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){$result="email invalide";}
        else if(strlen($input['last_name'])<=1){$result="Nom de famille invalide";}
        else if(strlen($input['first_name'])<=1){$result="Prénom invalide.";}
        else if(!$this->verifyDate($input['date_of_birth']) || strtotime($input['date_of_birth']) > strtotime(((new DateTime())->sub(new \DateInterval('P18Y')))->format("Y/m/d"))){ $result="Date de naissance invalide"; }
        else if(!preg_match("/^[0-9]{10}$/", $input['phone'])){$result="numéro de téléphone invalide.";}
        else if(strlen($input['city'])<1){$result="Ville invalide.";}
        else if(!filter_var($input['postal_code'],FILTER_VALIDATE_INT)){$result="Code postal invalide.";}
        else if(!in_array($input['is_smoking'], [0, 1])){$result="Fume invalide.";}
        else if(!is_numeric($input['housing'])){$result=$input['housing']."type d'hébergement invalide.";}
        else if(strlen($input['password'])<=8){$result="mot de passe invalide.";}
        else if(strlen($input['marital_status']<1)){$result="situation invalide";}
        else if(!in_array($input['is_house'],[1,2])){$result="type de maison invalide";}
        else if(!in_array($input['is_landlord'],[0,1])){$result="propriétaire invalide";}
        else if(!in_array($input['have_animal'],[0,1])){$result="avoir animal invalide";}
        else if($input['have_animal'])
        {
            if(strlen($input['animal'])<=1){$result="animal invalide";}
        }
        else if(!in_array($input['can_stay_summer'],[0,1])){$result="rester l'été invalide";}
        else if(!in_array($input['is_family_present'],[1,2,3])){$result="présence de la famille invalide";}
        else if(!is_numeric($input['room_surface'])){$result="surface de pièce invalide";}
        else if(!in_array($input['has_furniture'],[0,1])){$result="meublé invalide";}
        else if(!in_array($input['can_clean'],[0,1])){$result="possibilité de nettoyer invalide";}
        else if(!in_array($input['has_internet'],[0,1])){$result="internet invalide";}

        return $result;
    }

    /**
     * verify the date format
     * @param string $date
     * @return bool
     */
    private function verifyDate(string $date): bool{
        $result = false;
        $test_arr  = explode('-', $date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
                $result = true;
            }
        }
        return $result;
    }
}