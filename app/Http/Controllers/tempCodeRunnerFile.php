<?php
$inventory = [];

        for($i=1;$i<=4;$i++){
            $inventory[$i]= DB::select('select capacity from room_type where id = ?', [$i]);
        }
        echo $inventory;
        return $inventory;