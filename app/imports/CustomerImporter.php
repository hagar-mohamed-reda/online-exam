<?php

namespace App\imports; 

use Maatwebsite\Excel\Concerns\ToModel;
use App\Customer;
use App\City;
use App\Area;
use App\User;

class CustomerImporter  implements ToModel
{
    
    /**
     * @param array $row
     *
     * @return User|null
     */
     
    public function model(array $row)
    {  
        if (!is_numeric($row[0]))
            return null;
        
        if (Customer::where("name", $row[1])->first())
            return null;
        
        try {
            
            $city = City::where("name", $row[4])->first();
            
            if (!$city)
                $city = City::create(['name' => $row[4]]);
            
            //
            $area = Area::where("name", $row[3])->first();
            if (!$area)
                $area = Area::create(['name' => $row[3], 'city_id' => $city->id]);
            
            $user = User::where("name", $row[7])->first();
            if (!$user) {
                $user = User::create([
                    "name" => $row[7],
                    "code" => rand(111111111, 999999999),
                    "username" => rand(111111111, 999999999),
                    "password" => rand(111111111, 999999999),
                    "city_id" => $city->id,
                    "role_id" => null,
                ]);
            }
            
            return new Customer([
               'code'            => $row[0],
               'name'            => $row[1],
               'address'            => $row[2],
               'area_id'            => $area->id,
               'city_id'            => $city->id,
               'agent_name'            => $row[5],
               'user_id'            => $user->id,
               'notes'            => isset($row[8])? $row[8] : '',
            ]);
        } catch (Exception $ex) {
            
        }
        return null;
    }

    
}
