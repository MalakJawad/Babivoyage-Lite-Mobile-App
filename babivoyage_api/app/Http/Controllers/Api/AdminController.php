<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function cleanupPastFlights()
    {
        Flight::where('date', '<', now()->toDateString())->delete();
    }

    public function listAirports()
    {
        return response()->json([
            'data' => Airport::orderBy('city')->get(['code','city','name'])
        ]);
    }

    public function createAirport(Request $request)
    {
        $data = $request->validate([
            'code' => ['required','string','min:2','max:8'],
            'city' => ['required','string'],
            'name' => ['required','string'],
        ]);

        $data['code'] = strtoupper($data['code']);

        $airport = Airport::updateOrCreate(
            ['code' => $data['code']],
            $data
        );

        return response()->json(['data' => $airport], 201);
    }

    public function deleteAirport(string $code)
    {
        Airport::where('code', strtoupper($code))->delete();
        return response()->json(['status' => 'ok']);
    }

    public function listFlights()
    {
        $this->cleanupPastFlights();

        $flights = Flight::orderBy('date')->orderBy('depart_time')->get();

        $data = $flights->map(function ($f) {
            return [
                'id' => $f->id,
                'airline' => $f->airline,
                'flight_no' => $f->flight_no ?? '',
                'from' => ['code' => $f->from_code, 'city' => $f->from_code],
                'to' => ['code' => $f->to_code, 'city' => $f->to_code],
                'depart_time' => $f->depart_time,
                'arrive_time' => $f->arrive_time,
                'duration_min' => (int)$f->duration_min,
                'non_stop' => (bool)$f->non_stop,
                'price' => (float)$f->price,
                'cabin' => $f->cabin ?? 'Economy',
                'status' => $f->status ?? 'On Time',
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createFlight(Request $request)
    {
        $this->cleanupPastFlights();

        $data = $request->validate([
            'airline' => ['required','string'],
            'flight_no' => ['nullable','string'],
            'from_code' => ['required','string'],
            'to_code' => ['required','string'],
            'date' => ['required','date'],
            'depart_time' => ['required','string'],
            'arrive_time' => ['required','string'],
            'duration_min' => ['required','integer','min:1'],
            'non_stop' => ['required'],
            'price' => ['required','numeric','min:0'],
            'cabin' => ['required','string'],
            'status' => ['required','string'],
        ]);

        if ($data['date'] < now()->toDateString()) {
            return response()->json(['message' => 'Date must be today or future'], 422);
        }

        $flight = Flight::create([
            'airline' => $data['airline'],
            'flight_no' => $data['flight_no'] ?? '',
            'from_code' => strtoupper($data['from_code']),
            'to_code' => strtoupper($data['to_code']),
            'date' => $data['date'],
            'depart_time' => $data['depart_time'],
            'arrive_time' => $data['arrive_time'],
            'duration_min' => (int)$data['duration_min'],
            'non_stop' => (bool)$data['non_stop'],
            'price' => (float)$data['price'],
            'cabin' => $data['cabin'],
            'status' => $data['status'],
        ]);

        return response()->json(['data' => $flight], 201);
    }

    public function deleteFlight(int $id)
    {
        Flight::where('id', $id)->delete();
        return response()->json(['status' => 'ok']);
    }
}