<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Program;
use App\Http\Resources\ProgramResource;

class ProgramController extends Controller
{
    //
    public function Index(){
        $data = Program::latest()->get();
        return response()->json([ProgramResource::collection($data),'Programs fetched']);
    }

    public function store(Request $request){
       $this->getValidator($request);
       $inputData = $this->getInputRequest($request);
        $Programes = Program::create([
           'name' => $inputData(['name']),
           'desc' => $inputData(['desc']),
        ]);
        return response()->json(['You data :', new ProgramResource($Programes)]);
    }
    public function find($id){
        $programe = Program::find($id);
        if (!$programe){
            return response()->json(['Programnot fount', 404]);
        }
        return response()->json([new ProgramResource($programe)]);
    }

    private function update(Request $request){
        $this->getValidator($request);
        $inputData = $this->getInputRequest($request);
        $Programe = Program::update([
            'name' => $inputData(['name']),
            'desc' => $inputData(['desc']),
        ]);
        return response()->json(['Your programs has been updated', new ProgramResource($Programe)]);
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return response()->json('Program deleted successfully');
    }
    public function getValidator(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'desc' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        return $validator;
    }

    public function getInputRequest(Request $request){

        $requestInput = [
            $name = $request->name,
            $desc = $request->desc
        ];
        return $requestInput;
    }
}
