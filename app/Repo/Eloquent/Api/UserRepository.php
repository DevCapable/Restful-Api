<?php

namespace App\Repo\Eloquent\Api;

use App\Models\Product;
use App\Models\User;
use App\Repo\Eloquent\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function create($data)
    {


      return   User::create([
            'username' => $data->username,
            'role'=>$data->role,
            'deposit'=>$data->deposit ? $data->deposit : '0',
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);


    }

    public function update($data)
    {
        return Product::where('id',$data['id'])->update(['cost'=>$data['data']['cost'],
                    'product_name'=>$data['data']['product_name']]);

    }

    public function findById($data)
    {
           return  User::where('email', $data['email'])->firstOrFail();

    }

    public function destroy($id)
    {
         return User::destroy($id);

    }

    public function searchByName($name)
    {

    }
}
