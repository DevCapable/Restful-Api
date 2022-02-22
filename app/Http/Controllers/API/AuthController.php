<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repo\Eloquent\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends ApiBaseController
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(Request $request)
    {

        $this->getValidation($request);

//        $user = User::create([
//            'username' => $request->username,
//            'role'=>$request->role,
//            'deposit'=>$request->deposit ? $request->deposit : '0',
//            'email' => $request->email,
//            'password' => Hash::make($request->password)
//        ]);
        $user = $this->userRepository->create($request->all());

        $token = $user->createToken('auth_token')->plainTextToken;


        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

//        $user = User::where('email', $request['email'])->firstOrFail();
        $user = $this->userRepository->findByEmail($request);

        $token = $user->createToken('auth_token')->plainTextToken;
        Session::put('token', $token);
        return response()
            ->json(['message' => 'Hi '.$user->username.', welcome to home','access_token' => $token, 'token_type' => 'Bearer',]);
    }

    // method for user logout and delete token
    public function logout()
    {
//        dd(Session::get('token'));
//        $request->session()->forget('user');
//        $request->session()->regenerate();
//        $token = User::all();
//        Session::put('token','ade');
//        $getToken = Session::get('token');

        auth()->user()->tokens()->delete();


        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];


    }

    public function update($id, Request $request){
    $this->getValidation($request);
        $data['id']= $id;
        $data['data'] = $request->all();
        $this->userRepository->update($data);
    }

    public function depositCoin($email, Request $request){
        $user= $this->getByRoleAndEmail($email);
        if ($user){
            $coin_request = array($request->deposit);
            $serialized_array = serialize($coin_request);
            $coins_array = unserialize($serialized_array);

//              $pre_coin[]  = $user->deposit;
//            $balance = array_map('intval', explode(',', $user->deposit));
//            $coin = array_push($balance, $request->deposit);
//            array_map('intval', explode(',', $request->deposit));
//            return response()->json($balance,201);

            $this->updateDepositWithEmail($email,$coins_array);
            $user= $this->getUserWithEmail($email);
            return response()->json(['message'=>'You coin successfully updated',$user], 201);
        }
        return response()->json(['message'=>'You have to be a buyer before you can deposit'],401);
    }

    public function buyProduct($email, Request $request){
        $user= $this->getByRoleAndEmail($email);
//        $user= User::where('role','buyer')->where('email',$email)->first();

        if ($user){
            $amount = (int)($request->deposit);
            $balance = array_map('intval', explode(',', $user->deposit));
//            $explode_id = json_decode($user->deposit, true);
//            return response()->json($explode_id, 201);
            if (in_array($amount, $balance,true)){
//                $pay = ($amount - $balance);
//              unset($balance[$amount]);
//              var_dump($balance);

                $current_ballance[] = array_diff($balance, array($amount));
//                return response()->json($current_ballance, 201);

                $user =  $this->updateDepositWithEmail($email,$current_ballance);
                return response()->json(['message'=>'You coin is available'], 201);
            }else{
                return response()->json(['message'=>'These are your coins left', $user->deposit],401);

            }
//            User::where('email',$email)->update(['deposit' =>  $unserialized_array]);
        }
        return response()->json(['message'=>'You have to be a buyer before you can deposit'],401);
    }

    public function destroy($id){
       $this->userRepository->destroy($id);
    }

    public function getValidation(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'role' => "required",
            'deposit',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        return $validator;
    }
}
