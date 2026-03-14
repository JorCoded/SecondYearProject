<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function storeStaff(Request $request){

        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:150',
            'password' => 'required|max:200|min:6',
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
}
