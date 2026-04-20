<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels', ['hotels'=>$hotels]);
    }

    public function addHotel()
    {
        return view('addHotel');
    }

    public function destinations()
    {
        return view('destinations');
    }

    

    public function storeHotel(Request $request)
    {
        
        $request->validate([
            'hotel_name' => 'required|max:100',
            'location' => 'required|max:100',
            'address' => 'required|max:100',
            'phoneNumber' => 'required|max:100',
            'email' => 'required|max:150',
            'picture' => 'nullable|image|max:200',
            'description' => 'required'
        ]);

    
        /* $msg = "Upload Failed.";
        $uploadFolder = "../php/uploadedMedia/UserProfilePic/";
        $uploadFile = $uploadFolder . basename($request->input('picture'));
        //echo "<p></p>";

        if(move_uploaded_file($request->input(tempName), $uploadFile)){
            $msg = "Upload Successful.";
        }else{echo $msg;} */ 

        $file = $request->file('picture');
        $path = null;
        $destinationPath = public_path('\media\hotelPictures\ ');
        $destinationPath = trim($destinationPath, ' ');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $path = $destinationPath . $fileName;
        
        Hotel::create([
            'hotel_name' => $request->hotel_name,
            'location' => $request->location,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'picture' => $path,
            'description' => $request->description
        ]);
        
        return redirect()->route('hotels');
    }
    
    /* public function uploadPicture(Request $request){
        $image = $request->input('picture');
        return redirect()->route('dashboard',['picture' => $image]); 
        dd($request->input());
    }*/

}
