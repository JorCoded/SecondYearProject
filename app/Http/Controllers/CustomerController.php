<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password; 

class CustomerController extends Controller
{
    public function storeCustomer(Request $request){

        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:150',
            'password' => ['required', 'confirmed',
                        Password::min(6)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        // ->symbols()
            ],/*'required|max:200|min:6'*/
            'phoneNumber' => 'required|max:100',
            'address' => 'required|max:150',
            'profile_pic' => 'nullable|image|max:10000',
            'dob' => 'required'
        ]);

        
        /* 
        $path = $request->file('profile_pic')->storeAs('public/media/customerPictures', $request->file('profile_pic')->getClientOriginalName(), 'public'); */
        /* $uploadFolder = "C:/xampp/htdocs/FYP_SecondVer/public/media/customerPictures";
        $uploadFile = $uploadFolder . basename($request->file('profile_pic')); */
        /* if ($file->move($destinationPath, $fileName)) {
            $path = $destinationPath . $fileName;
        }else{
            $path = null;
        
        } */
        $file = $request->file('profile_pic');
        $path = null;
        $destinationPath = public_path('\media\customerPictures\ ');
        $destinationPath = trim($destinationPath, ' ');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $path = $destinationPath . $fileName;

       
        
        Customer::create([
            'firstname'=>$request->firstname, 
            'lastname'=>$request->lastname,
            'email' => $request->email,
            'password'=>$request->password,
            'phoneNumber'=> $request->phoneNumber,
            'address'=> $request->address,
            'profile_pic'=>$path,
            'dob'=> $request->dob
        ]);
        return redirect()->route('users');
    }


     /*public function logIn(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:150',
            'password' => 'required|string|max:200|min:5'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect()->route('home')->with('status', 'Logged in successfully.');;
        }
        
        return back()->withInput()->with('status', 'Invalid credentials.');
        $customers = Customer::all();
        $staffs = Staff::all();

        $email = $request->input('email');
        $password = $request->input('password'); 

        foreach($customers as $customer){
            if($customer->email == $email){
                if ($customer->password == $password) {
                    
                }
            }
        } 
        
    }*/



}
