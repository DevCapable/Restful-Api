<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiBaseController extends Controller
{
    public function getByRoleAndEmail($email){
      return   User::where('role','buyer')->where('email',$email)->first();

    }

    public function updateDepositWithEmail($email,$current_ballance){
        return User::where('email',$email)->update(['deposit' =>  $current_ballance]);
    }

    public function getUserWithEmail($email){
        $user = User::where('email',$email)->first();

        return $user;

    }
}
