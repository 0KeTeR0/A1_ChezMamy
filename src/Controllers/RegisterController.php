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
                if(!empty($input['email']) && !empty($input['last_name']) && !empty($input['first_name']) && !empty($input['date_of_birth'])&& !empty($input['phone'])&& !empty($input['nationality'])&& !empty($input['parents_address'])&& !empty($input['city'])&& !empty($input['postal_code'])&& !empty($input['education_level'])&& !empty($input['establishment'])&& !empty($input['end_of_studies'])&& !empty($input['is_smoking'])&& !empty($input['is_allergic'])&& !empty($input['can_drive'])&& !empty($input['housing'])&& !empty($input['password'])&& !empty($input['password_repeat']) && $this->verifyStudent($input)){

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
                else throw new \Exception("Veuillez remplir tous les champs correctement.");
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
    private function verifyStudent(array $input): bool {
        #A changer : faire en sorte que si un des tests est vrai alors les autres ne peuvent pas le remettre à faux
        $result = true;
        $result = ( filter_var($input['email'],FILTER_VALIDATE_EMAIL))&&$result;
        $result = strlen($input['last_name'])>1&&$result;
        $result = strlen($input['first_name'])>1&&$result;
        $result = $this->verifyDate($input['date_of_birth'])&&$result;
        $result = DateTime::createFromFormat('d/m/Y',$input['date_of_birth'])<((new DateTime())->modify('-18 year'))&&$result;
        $result = strlen($input['nationality'])>1&&$result;
        $result = preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/", $input['phone'])&&$result;
        $result = strlen($input['parents_address'])>1&&$result;
        $result = strlen($input['city'])>1&&$result;
        $result = (filter_var($input['postal_code'],FILTER_VALIDATE_INT))&&$result;
        $result = strlen($input['education_level'])>1&&$result;
        $result = strlen($input['establishment'])>1&&$result;
        $result = $input['end_of_studies']>0&&$result;
        if(strlen($input['date_of_arrival'])>1) {
            $result = $this->verifyDate($input['date_of_arrival'])&&$result;
            $result = DateTime::createFromFormat('d/m/Y',$input['date_of_arrival'])<(new DateTime())&&$result;
        }
        $result = filter_var($input['is_smoking'],FILTER_VALIDATE_BOOL)&&$result;
        $result = filter_var($input['is_allergic'],FILTER_VALIDATE_BOOL)&&$result;
        if($input['is_allergic']){$result=strlen($input['allergies'])>1;}
        $result = filter_var($input['can_drive'],FILTER_VALIDATE_BOOL)&&$result;

        $result = filter_var($input['housing'],FILTER_VALIDATE_INT)&&$result;
        if($input['housing']==2){
            $result = strlen($input['housing_2_availabilities'])>1&&$result;
        }
        if($input['housing']==3){
            $result = strlen($input['housing_3_budget'])>1&&$result;
        }
        $result = strlen($input['password'])>=8&&$result;

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