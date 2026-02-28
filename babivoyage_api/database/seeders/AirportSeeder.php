<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['code'=>'JFK','city'=>'New York City','name'=>'John F. Kennedy International Airport'],
            ['code'=>'LGA','city'=>'New York City','name'=>'LaGuardia Airport'],
            ['code'=>'EWR','city'=>'Newark','name'=>'Newark Liberty International Airport'],
            ['code'=>'LAX','city'=>'Los Angeles','name'=>'Los Angeles International Airport'],
            ['code'=>'SFO','city'=>'San Francisco','name'=>'San Francisco International Airport'],
            ['code'=>'MIA','city'=>'Miami','name'=>'Miami International Airport'],
            ['code'=>'CDG','city'=>'Paris','name'=>'Charles de Gaulle Airport'],
            ['code'=>'HND','city'=>'Tokyo','name'=>'Haneda Airport'],
            ['code'=>'FCO','city'=>'Rome','name'=>'Fiumicino Airport'],
        ];

        foreach ($items as $a) {
            Airport::updateOrCreate(['code' => $a['code']], $a);
        }
    }
}