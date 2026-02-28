<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $date = now()->addDay()->toDateString(); 

        $flights = [
            ['airline'=>'American Airlines','flight_no'=>'AA 120','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'8:10 AM','arrive_time'=>'11:24 AM','duration_min'=>373,'non_stop'=>1,'price'=>320,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'American Airlines','flight_no'=>'AA 221','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'9:55 AM','arrive_time'=>'1:12 PM','duration_min'=>377,'non_stop'=>1,'price'=>350,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'Delta','flight_no'=>'DL 330','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'10:30 AM','arrive_time'=>'1:52 PM','duration_min'=>382,'non_stop'=>0,'price'=>350,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'United','flight_no'=>'UA 440','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'11:15 AM','arrive_time'=>'2:40 PM','duration_min'=>385,'non_stop'=>1,'price'=>370,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'JetBlue','flight_no'=>'B6 510','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'12:05 PM','arrive_time'=>'3:30 PM','duration_min'=>385,'non_stop'=>1,'price'=>365,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'Alaska Airlines','flight_no'=>'AS 610','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'1:10 PM','arrive_time'=>'4:42 PM','duration_min'=>392,'non_stop'=>0,'price'=>340,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'Delta','flight_no'=>'DL 701','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'2:20 PM','arrive_time'=>'5:58 PM','duration_min'=>398,'non_stop'=>1,'price'=>390,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'United','flight_no'=>'UA 880','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'4:05 PM','arrive_time'=>'7:30 PM','duration_min'=>385,'non_stop'=>1,'price'=>410,'cabin'=>'Economy','status'=>'On Time'],
            ['airline'=>'American Airlines','flight_no'=>'AA 990','from_code'=>'JFK','to_code'=>'LAX','date'=>$date,'depart_time'=>'6:40 PM','arrive_time'=>'10:05 PM','duration_min'=>385,'non_stop'=>0,'price'=>355,'cabin'=>'Economy','status'=>'On Time'],
        ];

        foreach ($flights as $f) {
            Flight::create($f);
        }
    }
}