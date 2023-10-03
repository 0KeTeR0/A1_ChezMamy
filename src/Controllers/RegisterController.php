<?php

namespace App\Chezmamy\Controllers;


use App\ChezMamy\Model\Register;


class RegisterController
{
    public function execute(?array $input)
    {
        if(count($input) > 0) {
            if (isset($input['registerStudent'])) {
                if(!empty($input['email']) && !empty($input['last_name']) && !empty($input['first_name']) && !empty($input['date_of_birth'])&& !empty($input['phone'])&& !empty($input['nationality'])&& !empty($input['parents_address'])&& !empty($input['city'])&& !empty($input['postal_code'])&& !empty($input['education_level'])&& !empty($input['establishment'])&& !empty($input['end_of_studies'])&& !empty($input['is_smoking'])&& !empty($input['is_allergic'])&& !empty($input['can_drive'])&& !empty($input['housing'])){

                }
            }
            else{
                #renvoyer une requête de tout compléter.
            }

            $newUser = new UserModel();
            #changer les attributs du newUser ici
            #

        }

        require('templates/Register.php');
    }
}