<?php

namespace App\Repo\Eloquent\Api;

use App\Models\Product;
use App\Repo\Eloquent\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function create($data)
    {
      return Product::create([
            'cost'=> $data->cost,
            'product_name'=> $data->product_name,
        ]);
    }

    public function update($data)
    {
        return Product::where('id',$data['id'])->update(['cost'=>$data['data']['cost'],
                    'product_name'=>$data['data']['product_name']]);
    }

    public function findById($id)
    {
           return  Product::where('id',$id)->first();

    }

    public function destroy($product)
    {
        $item = Product::where('id',$product->id)->first();

        return $item->delete();
    }

    public function searchByName($name)
    {
        return Product::where('product_name','like','%'.$name.'%')->get();

    }
}
