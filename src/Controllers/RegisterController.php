<?php

namespace App\ChezMamy\Controllers;


use App\ChezMamy\Model\Register;
use App\ChezMamy\Model\UserModel;

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
                if(!empty($input['email']) && !empty($input['last_name']) && !empty($input['first_name']) && !empty($input['date_of_birth'])&& !empty($input['phone'])&& !empty($input['nationality'])&& !empty($input['parents_address'])&& !empty($input['city'])&& !empty($input['postal_code'])&& !empty($input['education_level'])&& !empty($input['establishment'])&& !empty($input['end_of_studies'])&& !empty($input['is_smoking'])&& !empty($input['is_allergic'])&& !empty($input['can_drive'])&& !empty($input['housing'])&& !empty($input['password'])&& !empty($input['password_repeat'])){

                    //We create an object of the user class to work more easily with it.
                    $newUser = new UserModel();
                    $newUser->setEmail($input['email']);
                    $newUser->setLast_Name($input['last_name']);
                    $newUser->setFirst_Name($input['first_name']);
                    $newUser->setDate_Of_Birth($input['date_of_birth']);
                    $newUser->setNationality($input['nationality']);
                    $newUser->setPhone($input('phone'));
                    $newUser->setParents_Adress($input['parents_address']);
                    $newUser->setCity($input['city']);
                    $newUser->setPostalCode($input['postal_code']);
                    $newUser->setKnow_Association($input['know_association']);
                    $newUser->setEducation_Level($input['education_level']);
                    $newUser->setInterships($input['internships']);
                    $newUser->setEstablishment($input['establishment']);
                    $newUser->setEnd_Of_Studies(date('m/d/Y h:i:s a', time()+((($input['end_of_studies']*365)*24)*60)));
                    $newUser->setDate_Of_Arrival($input['date_of_arrival']);
                    $newUser->setMotivation($input['motivations']);
                    $newUser->setIs_Smoking($input['is_smoking']);
                    $newUser->setIs_Allergic($input['is_allergic']);
                    $newUser->setAllergies($input['allergies']);
                    $newUser->setCan_Drive($input['can_drive']);
                    $newUser->setMeans_Of_Locomotion($input['means_of_locomotion']);
                    $newUser->setInterests($input['interests']);
                    $newUser->setWhy($input['why']);
                    $newUser->setHousing($input['housing']);
                    $newUser->setHousing_2_Availabilities($input('housing_2_availabilities'));
                    $newUser->setHousing_3_Budget($input('housing_3_budget'));
                    $newUser->setPreferences($input('preferences'));
                    $newUser->setPassword($input('password'));

                    //We add it to the database using the register model
                    $register = new Register();
                    $res = $register->execute($newUser,$input['password_repeat'],1);

                    //If everything went well we send the user to the login page
                    if(!$res['success']) throw new \Exception($res['message']);
                    else {
                        header('Location: index.php?action=login');
                    }
                }
                else throw new \Exception("Veuillez remplir tous les champs.");
            }
            else throw new \Exception("Type de compte invalide");

        }

        require('templates/Register.php');
    }
}