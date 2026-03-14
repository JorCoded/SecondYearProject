<?php

namespace App\Http\Controllers;

// use App\Models\Room;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{

    public function getInventory()
    {
        $inventory = [];

        for ($i = 1; $i <= 40; $i++) {
            $inventory[$i]=[];
            for($j = 1; $j <= 4; $j++)
            {
                $inventory[$i][$j] = DB::select('select count(typeid) from room where "isAvailable" = ? AND "typeid" =? AND "hotelid" = ?', [1, $j, $i])[0];
            }
            
        }
        
        $test1=DB::select('select count(typeid) from room where "isAvailable" = ? AND "typeid" =? AND "hotelid" = ?', [1, 1, 1])[0];
        $cnt = $test1->count;

        return view('test', ['inventory' => $inventory, 'test' => $test1, 'count'=> $cnt]);
    }

    

    





}
