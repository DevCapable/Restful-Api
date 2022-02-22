<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repo\Eloquent\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }
        public function getAllProduct(){
            $product = Product::all();

                return response()->json($product);

        }

        public function createProduct(Request $request)
        {
            $validator = $this->getValidation($request);

            if ($validator->fails()){
                return response()->json($validator->errors());
            }
            $product = $this->productRepository->create($request);
            return response()->json(['Product created successfully',$product]);
        }
        public function deleteProduct($id){
//            $product = Product::where('id',$id)->first();
            $product= $this->productRepository->findById($id);
            if ($product){
//                $product->delete();
                $this->productRepository->destroy($product);
                return response()->json('Product deleted Successfully');
            }
            return response()->json(['Product not found']);

        }


        public function updateProduct($id, Request $request){

            $validator = $this->getValidation($request);

            if ($validator->fails()){
                return response()->json($validator->errors());
            }
            $product = Product::where('id',$id)->first();
//            $product= $this->productRepository->findById($id)->first();

            if ($product){
//             $producte =   Product::where('id',$product->id)->update(['cost'=>$request->cost,
//                    'product_name'=>$request->product_name]);
            $data['id'] = $id;
            $data['data'] = $request->all();
             $this->productRepository->update($data);
//                $updatedProduct = Product::where('id',$id)->first();
                $updatedProduct = $this->productRepository->findWithId($id);
                return response()->json(['message'=>'Your product has been updated',$updatedProduct]);
            }
            return response()->json('Error occurred');
        }

        public function searchProduct($name){
//            $product = Product::where('product_name','like','%'.$name.'%')->get();
            $this->productRepository->searchByName($name);
            return response()->json(['message'=>'Your available result:',$this]);
        }

        public function getValidation(Request $request){
            $validator = Validator::make($request->all(),[
                'cost'=> 'required',
                'product_name' => 'required',
            ]);

            return $validator;
        }
}
