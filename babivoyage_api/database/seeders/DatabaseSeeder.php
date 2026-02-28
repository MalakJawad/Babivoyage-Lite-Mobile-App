<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;
use App\Models\Flight;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AirportSeeder::class,
            FlightSeeder::class,]); 
        
        Airport::upsert([
            ['code'=>'JFK','city'=>'New York','name'=>'John F. Kennedy International Airport'],
            ['code'=>'LAX','city'=>'Los Angeles','name'=>'Los Angeles International Airport'],
            ['code'=>'CDG','city'=>'Paris','name'=>'Charles de Gaulle Airport'],
            ['code'=>'NRT','city'=>'Tokyo','name'=>'Narita International Airport'],
            ['code'=>'MIA','city'=>'Miami','name'=>'Miami International Airport'],
            ['code'=>'FCO','city'=>'Rome','name'=>'Rome Fiumicino Airport'],
        ], ['code'], ['city','name']);

        $date = now()->addDays(1)->toDateString();

      
        Flight::upsert([
            [
                'airline'=>'American Airlines','flight_no'=>'AA 102',
                'from_code'=>'JFK','to_code'=>'LAX','date'=>$date,
                'depart_time'=>'8:10 AM','arrive_time'=>'11:24 AM','duration_min'=>373,
                'non_stop'=>true,'price'=>320,'cabin'=>'Economy','status'=>'On Time'
            ],
            [
                'airline'=>'American Airlines','flight_no'=>'AA 350',
                'from_code'=>'JFK','to_code'=>'LAX','date'=>$date,
                'depart_time'=>'9:55 AM','arrive_time'=>'1:12 PM','duration_min'=>377,
                'non_stop'=>true,'price'=>350,'cabin'=>'Economy','status'=>'On Time'
            ],
            [
                'airline'=>'Delta Airlines','flight_no'=>'DL 487',
                'from_code'=>'JFK','to_code'=>'LAX','date'=>$date,
                'depart_time'=>'10:30 AM','arrive_time'=>'1:52 PM','duration_min'=>382,
                'non_stop'=>true,'price'=>350,'cabin'=>'Economy','status'=>'On Time'
            ],
            [
                'airline'=>'United','flight_no'=>'UA 210',
                'from_code'=>'JFK','to_code'=>'LAX','date'=>$date,
                'depart_time'=>'11:15 AM','arrive_time'=>'2:40 PM','duration_min'=>385,
                'non_stop'=>true,'price'=>370,'cabin'=>'Economy','status'=>'On Time'
            ],
        ], ['flight_no','date'], [
            'airline','from_code','to_code','depart_time','arrive_time','duration_min','non_stop','price','cabin','status'
        ]);

    }
}