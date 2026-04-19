<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PhpParser\Node\Stmt\TryCatch;

class StaffController extends Controller
{

    public function storeStaff(Request $request){

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
            ],
            'phoneNumber' => 'required|max:100',
            'address' => 'required|max:150',
            'profile_pic' => 'nullable|image|max:10000',
            'dob' => 'required',
        ]);
        
        $file = $request->file('profile_pic');
        $path = null;
        $destinationPath = public_path('\media\customerPictures\ ');
        $destinationPath = trim($destinationPath, ' ');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $path = $destinationPath . $fileName;

        $admin = $request->input('is_admin')!=true?0:1;


        Staff::create([
            'firstname'=>$request->firstname, 
            'lastname'=>$request->lastname,
            'email' => $request->email,
            'password'=>$request->password.Staff::$pattern,
            'phoneNumber'=> $request->phoneNumber,
            'address'=> $request->address,
            'profile_pic'=>$path,
            'dob'=> $request->dob,
            'is_admin'=> $admin
        ]);

        return redirect()->route('users');
    }


    public function makeAdmin($userEmail){
        $staff = Staff::where('email', $userEmail)->first();
        $staff->is_admin = 1;
        $staff->save();
        return redirect()->route('users')->with("adminChanged", "Staff was made an admin successfully.");
    }

    public function removeAdmin($userEmail){
        $staff = Staff::where('email', $userEmail)->first();
        $staff->is_admin = 0;
        $staff->save();
        return redirect()->route('users')->with("adminChanged", "Staff was removed as admin successfully.");
    }

    public function deleteStaff($userEmail){
        $staff = Staff::where('email', $userEmail)->first();
        $staff->delete();
        return redirect()->route('users')->with("staffDeleted", "Staff was deleted successfully.");
    }

    

    /* public function changePassword($isStaff, $userEmail, $newPassword){



        if ($isStaff) {
            $user = Staff::where('email', $userEmail)->first();
            $user->password = $newPassword.Staff::$pattern;
        }else{
            $user = Customer::where('email', $userEmail)->first();
            $user->password = $newPassword;
        }
        
        $user->save();
        return redirect()->route('users')->with("passwordChanged", "Password was changed successfully.");
    } */

}
