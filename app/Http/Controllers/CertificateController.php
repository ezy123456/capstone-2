<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function create(Registration $registration)
    {
        $registration = Registration::findOrFail($registration->id);
        return view('certificate.create', compact('registration'));
    }

    public function store(Request $request, Registration $registration)
    {
        $validatedData = validator($request->all(), [
            'txtCertificate' => 'image|mimes:jpg,jpeg,png,gif',
        ])->validate();

        $certificate = new Certificate();
        $certificate->registration_id = $registration->id;
        $certificate->save();

        if ($request->hasFile('txtCertificate')) {
            $image = $request->file('txtCertificate');
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = $certificate->id . '.' . $extension;
                $image->move('img/certificate/', $imageName);
                $certificate->certificate_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }
        $certificate->save();

        return redirect(route('paymentList', ['eventId' => $registration->event_id]));
    }

    public function edit(Certificate $certificate)
    {
        $certificate = Certificate::findOrFail($certificate->id);
        $registration = Registration::findOrFail($certificate->registration_id);
        return view('certificate.edit', compact(['certificate', 'registration']));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $registration = Registration::findOrFail($certificate->registration_id);

        $validatedData = validator($request->all(), [
            'txtCertificate' => 'image|mimes:jpg,jpeg,png,gif',
        ])->validate();

        if ($request->hasFile('txtCertificate')) {
            $image = $request->file('txtCertificate');
            if ($image->isValid()) {
                if (!empty($certificate->certificate_url)) {
                    unlink(public_path('img/certificate/' . $certificate->certificate_url));
                }
                $extension = $image->getClientOriginalExtension();
                $imageName = $certificate->id . '.' . $extension;
                $image->move('img/certificate/', $imageName);
                $certificate->certificate_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }

        $certificate->save();
        return redirect(route('paymentList', ['eventId' => $registration->event_id]));
    }
}
