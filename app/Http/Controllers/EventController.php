<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::orderBy('created_at', 'asc')->get();

        return view('event.index', [
            'events' => $data
        ]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'txtName' => 'required|string|max:255',
            'txtLocation' => 'required|string|max:255',
            'txtSpeaker' => 'required|string|max:255',
            'txtDate' => 'required|date',
            'txtTime' => 'required|date_format:H:i',
            'txtFee' => 'required|integer',
            'txtPeserta' => 'required|integer',
            'txtCover' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ])->validate();

        $event = new Event();
        $event->name = $validatedData['txtName'];
        $event->date = $validatedData['txtDate'];
        $event->time = $validatedData['txtTime'];
        $event->location = $validatedData['txtLocation'];
        $event->speaker = $validatedData['txtSpeaker'];
        $event->registration_fee = $validatedData['txtFee'];
        $event->max_participants = $validatedData['txtPeserta'];
        $event->save();

        if ($request->hasFile('txtCover')) {
            $image = $request->file('txtCover');
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = $event->id . '.' . $extension;
                $image->move('img/event/', $imageName);
                $event->poster_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }

        $event->save();

        return redirect(route('eventList'));
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = validator($request->all(), [
            'txtName' => 'required|string|max:255',
            'txtLocation' => 'required|string|max:255',
            'txtSpeaker' => 'required|string|max:255',
            'txtDate' => 'required',
            'txtTime' => 'required',
            'txtFee' => 'required',
            'txtPeserta' => 'required',
            'txtCover' => 'image|mimes:jpg,jpeg,png,gif',
        ])->validate();

        $event->name = $validatedData['txtName'];
        $event->date = $validatedData['txtDate'];
        $event->time = $validatedData['txtTime'];
        $event->location = $validatedData['txtLocation'];
        $event->speaker = $validatedData['txtSpeaker'];
        $event->registration_fee = $validatedData['txtFee'];
        $event->max_participants = $validatedData['txtPeserta'];

        if ($request->hasFile('txtCover')) {
            $image = $request->file('txtCover');
            if ($image->isValid()) {
                if (!empty($event->poster_url)) {
                    unlink(public_path('img/event/' . $event->poster_url));
                }
                $extension = $image->getClientOriginalExtension();
                $imageName = $event->id . '.' . $extension;
                $image->move('img/event/', $imageName);
                $event->poster_url = $imageName;
            } else {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }

        $event->save();
        return redirect(route('eventList'));
    }

    public function destroy(Event $event)
    {
        if (!empty($event->poster_url)) {
            $image_path = public_path('img/event/' . $event->poster_url);

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $event->delete();
        return redirect(route('eventList'));
    }
}
