<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['event', 'certificate'])
            ->where('user_id', Auth::id())
            ->get();

        return view('registration.index', ['registrations' => $registrations]);
    }

    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('registration.create', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $validatedData = validator($request->all(), [
            'txtTransaction' => 'image|mimes:jpg,jpeg,png,gif',
        ])->validate();

        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->event_id = $eventId;
        $registration->payment_status = 'pending';
        $registration->save();

        if ($request->hasFile('txtTransaction')) {
            $image = $request->file('txtTransaction');
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = $registration->id . '.' . $extension;
                $image->move('img/transaction/', $imageName);
                $registration->transaction_proof_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }

        $registration->save();

        return redirect(route('registrationList'));
    }

    public function edit(Registration $registration)
    {
        $event = $registration->event;
        return view('registration.edit', compact('registration', 'event'));
    }

    public function update(Request $request, Registration $registration)
    {
        $validatedData = validator($request->all(), [
            'txtTransaction' => 'image|mimes:jpg,jpeg,png,gif',
        ])->validate();

        if ($request->hasFile('txtTransaction')) {
            $image = $request->file('txtTransaction');
            if ($image->isValid()) {
                if (!empty($registration->transaction_proof_url)) {
                    unlink(public_path('img/transaction/' . $registration->transaction_proof_url));
                }
                $extension = $image->getClientOriginalExtension();
                $imageName = $registration->id . '.' . $extension;
                $image->move('img/transaction/', $imageName);
                $registration->transaction_proof_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }

        $registration->save();
        return redirect(route('registrationList'));
    }

    public function listParticipants(Request $request, string $eventId)
    {
        $registrations = Registration::with(['user', 'presence', 'certificate'])
            ->where('event_id', $eventId)
            ->get();

        if ($request->has('filter') && in_array($request->filter, ['pending', 'paid'])) {
            $registrations = $registrations->where('payment_status', $request->filter);
        }

        return view('payment.index', compact('registrations'));
    }

    public function payment(Registration $registration)
    {
        $registration->payment_status = 'paid';
        $registration->qr_code = Str::random(16);
        $registration->save();
        return redirect(route('paymentList', ['eventId' => $registration->event_id]));
    }
}
