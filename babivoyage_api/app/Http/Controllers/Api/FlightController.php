<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function airportSearch(Request $request)
    {
        $data = $request->validate([
            'q' => ['required','string','min:2'],
        ]);

        $q = $data['q'];

        $airports = Airport::query()
            ->where('city', 'like', "%$q%")
            ->orWhere('code', 'like', "%$q%")
            ->orWhere('name', 'like', "%$q%")
            ->limit(20)
            ->get(['code','city','name']);

        return response()->json(['data' => $airports]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'from'   => ['required','string'],
            'to'     => ['required','string'],
            'date'   => ['required','date'],
            'adults' => ['required','integer','min:1','max:9'],
            'cabin'  => ['required','string'],
        ]);

        $fromAirport = Airport::where('code', $data['from'])->first();
        $toAirport   = Airport::where('code', $data['to'])->first();

        $flights = Flight::query()
            ->where('from_code', $data['from'])
            ->where('to_code', $data['to'])
            ->where('date', $data['date'])
            ->orderBy('price')
            ->limit(50)
            ->get();

        $mapped = $flights->map(function ($f) use ($fromAirport, $toAirport, $data) {
            return [
                'id' => $f->id,
                'airline' => $f->airline,
                'flight_no' => $f->flight_no ?? '',
                'from' => [
                    'code' => $f->from_code,
                    'city' => $fromAirport?->city ?? $f->from_code,
                ],
                'to' => [
                    'code' => $f->to_code,
                    'city' => $toAirport?->city ?? $f->to_code,
                ],
                'depart_time' => $f->depart_time,
                'arrive_time' => $f->arrive_time,
                'duration_min' => (int) $f->duration_min,
                'non_stop' => (bool) $f->non_stop,
                'price' => (float) $f->price,
                'cabin' => $data['cabin'],   // from request (Economy/Business/First)
                'status' => $f->status ?? 'On Time',
            ];
        });

        return response()->json(['data' => $mapped]);
    }

    public function details(Request $request)
    {
        $data = $request->validate([
            'id' => ['required','integer','exists:flights,id'],
        ]);

        $f = Flight::findOrFail($data['id']);

        $fromAirport = Airport::where('code', $f->from_code)->first();
        $toAirport   = Airport::where('code', $f->to_code)->first();

        return response()->json([
            'data' => [
                'id' => $f->id,
                'airline' => $f->airline,
                'flight_no' => $f->flight_no ?? '',
                'from' => ['code' => $f->from_code, 'city' => $fromAirport?->city ?? $f->from_code],
                'to'   => ['code' => $f->to_code,   'city' => $toAirport?->city ?? $f->to_code],
                'depart_time' => $f->depart_time,
                'arrive_time' => $f->arrive_time,
                'duration_min' => (int) $f->duration_min,
                'non_stop' => (bool) $f->non_stop,
                'price' => (float) $f->price,
                'cabin' => $f->cabin ?? 'Economy',
                'status' => $f->status ?? 'On Time',
            ]
        ]);
    }

    public function createBooking(Request $request)
    {
        $data = $request->validate([
            'flight_id' => ['required','integer','exists:flights,id'],
            'adults'    => ['required','integer','min:1','max:9'],
        ]);

        $booking = Booking::create([
            'user_id' => null,
            'flight_id' => $data['flight_id'],
            'adults' => $data['adults'],
            'status' => 'confirmed',
        ]);

        return response()->json(['data' => $booking], 201);
    }
}