<?php

namespace App\Repo\Eloquent\Api;

use App\Models\Product;
use App\Models\User;
use App\Repo\Eloquent\AbstractRepository;
use App\Repo\Eloquent\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{


    public function __construct(User $model){
        $this->model = $model;
    }
    public function create(array $data)
    {


//      return   User::create([
//            'username' => $data->username,
//            'role'=>$data->role,
//            'deposit'=>$data->deposit ? $data->deposit : '0',
//            'email' => $data->email,
//            'password' => Hash::make($data->password)
//        ]);
        return $this->model->create($data);


    }

    public function update($data)
    {
//        return Product::where('id',$data['id'])->update(['cost'=>$data['data']['cost'],
//                    'product_name'=>$data['data']['product_name']]);
         return $this->model->where('id',$data['id'])->update($data);

    }

    public function findByEmail($data)
    {
//           return  User::where('email', $data['email'])->firstOrFail();
           return $this->model->where('email',$data['email'])->firstOrFail();

    }

    public function destroy($id): int
    {
         return $this->model->destroy($id);

    }

    public function searchByName($name)
    {

    }
}
