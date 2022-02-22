<?php

namespace App\Repo\Eloquent\Api;

use App\Models\Product;
use App\Models\User;
use App\Repo\Eloquent\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function create($request)
    {


      return   User::create([
            'username' => $request->username,
            'role'=>$request->role,
            'deposit'=>$request->deposit ? $request->deposit : '0',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


    }

    public function update($data)
    {
        return Product::where('id',$data['id'])->update(['cost'=>$data['data']['cost'],
                    'product_name'=>$data['data']['product_name']]);

    }

    public function findById($request)
    {
           return  User::where('email', $request['email'])->firstOrFail();

    }

    public function destroy($id)
    {
         return User::destroy($id);

    }

    public function searchByName($name)
    {

    }
}
