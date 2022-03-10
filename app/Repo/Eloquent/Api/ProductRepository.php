<?php
namespace App\Repo\Eloquent\Api;
use App\Models\Product;
use App\Repo\Eloquent\AbstractRepository;
use App\Repo\Eloquent\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{


    public function __construct(Product $model){
        $this->model = $model;
    }
    public function getAll(){
        return $this->model;
    }

    public function create($data)
    {
    return $this->model->create($data);
    }

    public function update($data)
    {

        return $this->model->where('id',$data['id'])->update($data);

    }

    public function findWithId($id)
    {
           return $this->model->where('id',$id)->first();

    }

    public function destroy($product)
    {
        $item = $this->model->where('id',$product->id)->first();

        return $item->delete();
    }

    public function searchByName($name)
    {
        return $this->model->where('product_name','like','%'.$name.'%')->get();

    }

}
