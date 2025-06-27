<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Registration;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function create(Registration $registration)
    {
        $registration = Registration::findOrFail($registration->id);
        return view('presence.create', compact('registration'));
    }

    public function store(Request $request, Registration $registration)
    {
        $validatedData = validator($request->all(), [
            'txtCode' => 'required|string|max:20',
        ])->validate();

        if ($registration->qr_code == $validatedData['txtCode']) {
            $presence = new Presence();
            $presence->registration_id = $registration->id;
            $presence->scanned_at = now()->setTimezone('UTC')->format('Y-m-d H:i:s');
            $presence->save();
            return redirect(route('paymentList', ['eventId' => $registration->event_id]));
        } else {
            return redirect()->back()->with('error', 'QR Code is not valid.');
        }
    }

    public function scan(string $qr_code)
    {
        if (!$qr_code) {
            return redirect()->back()->with('error', 'QR Code tidak valid atau belum tersedia.');
        }

        $registration = Registration::where('qr_code', $qr_code)->first();

        if (!$registration) {
            return response()->json(['message' => 'QR Code tidak valid'], 404);
        }

        if ($registration->presence) {
            return response()->json(['message' => 'Peserta sudah melakukan presensi'], 400);
        }

        Presence::create([
            'registration_id' => $registration->id,
            'scanned_at' => now()
        ]);

        return response()->json(['message' => 'Presensi berhasil']);
    }
}