<?php

namespace App\Http\Controllers;

use Session;
use DateTime;
use App\Models\Staff;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $staff = Staff::all();
        //dd($customers);
        return view('users', [
            'customers' => $customers,
            'staff' => $staff
        ]);
    }

    public function addUser()
    {
        return view('addUser');
    }

    public function home()
    {
        // Auth::user() defaults to the 'web' guard. Since you are using 'customer' and 'staff' guards,
        // you need to explicitly retrieve the user from the active guard.
        $user = Auth::guard('customer')->user() ?? Auth::guard('staff')->user();
        

        return view('home', ['user' => $user]);
    }

    public function signInPage()
    {
        return view('signin');
    }

    public function signUp(Request $request): RedirectResponse
    {


        return redirect()->route('signin')->with('status', 'Registered successfully. Please log in.');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:150',
            'password' => 'required|string|max:200|min:6'
        ]);

        //$credentials = $request->only('email', 'password');
        $customer = Customer::where('email', $request->email)->first();
        $staff = Staff::where('email', $request->email)->first();


        if ($customer && Hash::check($request->password, $customer->password)) {
            Auth::guard('customer')->login($customer);
            $request->session()->regenerate();
            return redirect()->route('home')->with('status', 'Logged in successfully. From og login');
        } else if ($staff && Hash::check($request->password . Staff::$pattern, $staff->password)) {
            Auth::guard('staff')->login($staff);
            $request->session()->regenerate();
            return redirect()->route('home')->with('status', 'Logged in successfully.');
        }

        /* if(Auth::attempt(['email'=>$request->email, 'password' => $request->password]))
        {
            return redirect()->route('home')->with('status', 'Logged in successfully.');;
        } */

        return back()->withInput()->with('status', 'Invalid credentials.');
    }


    public function logIn(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:150',
            'password' => 'required|string|max:200|min:6'
        ]);

        /*$credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect()->route('home')->with('status', 'Logged in successfully.');;
        } */


        $customers = Customer::all();
        $staffs = Staff::all();

        $email = $request->input('email');
        $password = $request->input('password');

        date_default_timezone_set("Etc/GMT-4");
        $phpDate = new DateTime();
        $formattedTimestamp = $phpDate->format('Y-m-d H:i:s');

        //verify if input password contains a string pattern at the end of it, this string pattern is dedicated to staff members
        if (substr($password, -4) == Staff::$pattern) {
            foreach ($staffs as $staff) {
                if ($staff->email == $email) {
                    if ($staff->password == $password) {
                        DB::table('staff')
                            ->where('email', $email)
                            ->update(
                                ['logtime' => DB::raw("array_append(logtime, '{$formattedTimestamp}'::timestamp)")]
                            );
                        //Auth::guard('staff')->login($staff);
                        return redirect()->route('home')->with('status', 'Logged in successfully.');
                    }
                    return back()->withInput()->with('status', 'Invalid password.');
                }
            }
        } else {
            foreach ($customers as $customer) {
                if ($customer->email == $email) {
                    if ($customer->password == $password) {
                        DB::table('customer')
                            ->where('email', $email)
                            ->update(
                                ['logtime' => DB::raw("array_append(logtime, '{$formattedTimestamp}'::timestamp)")]
                            );
                        //Auth::guard('customer')->login($customer);
                        return redirect()->route('home')->with('status', 'Logged in successfully.');
                    }
                    return back()->withInput()->with('status', 'Invalid password.');
                }
            }
            return back()->withInput()->with('status', 'Invalid credentials.');
        }
    }

    public function logOut()
    {
        session()->flush();
        /* Auth::guard('customer')->logout();
        Auth::guard('staff')->logout(); */
        Auth::logout();
        return redirect()->route('home')->with('status', 'Logged out successfully.');
    }

    public function profile()
    {
        return view('userProfile');
    }




    
}
