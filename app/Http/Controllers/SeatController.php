<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;

class SeatController extends Controller {
    public function reserveSeat(Request $request) {
        if (!Auth::check()) {
            return redirect('/register')->with('error', 'Debes iniciar sesión para reservar.');
        }

        $seat = Seat::where('movie_id', $request->movie_id)
                    ->where('seat_number', $request->seat_number)
                    ->first();

        if ($seat && $seat->is_reserved) {
            return back()->with('error', 'Esta butaca ya está reservada.');
        }

        if (!$seat) {
            $seat = Seat::create([
                'user_id' => Auth::id(),
                'movie_id' => $request->movie_id,
                'seat_number' => $request->seat_number,
                'is_reserved' => true
            ]);
        } else {
            $seat->update(['user_id' => Auth::id(), 'is_reserved' => true]);
        }

        return back()->with('success', 'Butaca reservada con éxito.');
    }
}

