<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;


class UserController extends Controller
{
    private $status_code =  200;

    public function register(Request $request){

       $validator = Validator::make($request->all(), [
           'firstname'  => 'required',
           'lastname'   => 'required',
           'email'      => 'required|email|max:191|unique:users,email',
           'password'   => 'required|min:8'

       ]); 

       if($validator->fails()){

            return response()->json([

                'validation_errors' => $validator->messages(),
                
            ]);

       }else{

            $user = User::create([
                'firstname'   => $request->firstname,
                'lastname'    => $request->lastname,
                'phonenumber' => $request->phonenumber,
                'email'       => $request->email,
                'password'    => Hash::make($request->password)
            ]);

            $token  = $user->createToken($user->email.'_T oken')->plainTextToken;

            return response()->json([
                'status'   => 200,
                'username' => $user->firstname,
                'token'    => $token,
                'message'  => 'Registered Successfully'
            ]);
            
       }

    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [

            'email'    => 'required|max:191',
            'password' => 'required'
        
        ]);

        if($validator-> fails()){

            return response()->json([

                'validation_errors' => $validator->messages(),
                
            ]);

        }else{  

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                
                return response()->json([

                    'status'   =>  401,

                    'message'  => 'Invalid Credentials'

                ]);

            }else{

                $token  = $user->createToken($user->email.'_T oken')->plainTextToken;

                return response()->json([
                    'status'   => 200,
                    'username' => $user->firstname,
                    'token'    => $token,
                    'message'  => 'Logged In Successfully'
                ]);

            }   

        }

    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return response()->json([
            'status'   => 200,
            'message'  => 'Logged Out Successfully'
        ]);

    }


    public function submitForm(Request $request){

        $validator  = Validator::make($request->all(), [

            'firstname'          => 'required',
            'lastname'           => 'required',
            'gender'             => 'required',
            'homeAddress'        => 'required',
            'email'              => 'required',
            'phoneNumber'        => 'required|min:11|max:11',
            'refereeName'        => 'required',
            'refereePhonenumber' => 'required',
            'occupation'         => 'required',
            'monthlySalary'      => 'required',
            'maritalStatus'      => 'required',
            'BVN'                => 'required',

        ]);

        if($validator->fails()){

            return response()->json([

                'validation_errors' => $validator->messages(),
                
            ]);

        }else{

            LoanApplication::create([
                'firstname'           => $request->firstname,
                'lastname'            => $request->lastname,
                'gender'              => $request->gender,
                'homeAddress'         => $request->homeAddress,
                'phoneNumber'         => $request->phoneNumber,
                'email'               => $request->email,
                'occupation'          => $request->occupation,
                'monthlySalary'       => $request->monthlySalary,
                'refereeName'         => $request->refereeName,
                'refereePhonenumber'  => $request->refereePhonenumber,
                'maritalStatus'       => $request->maritalStatus,
                'BVN'                 => $request->BVN,
                'token'               => Auth::id()
            ]);

            return response()->json([
                'status'   => 200,
                'message'  => 'Your Loan is been reviewed!'
            ]);

        }
    }


    public function getRequest($token){

       
    }

}
