<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);

        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }
    
    public function show($id)
    {
        $room = Room::find($id);
        

        return view('rooms.show', [
            'room' => $room,
        ]);
    }
    
        public function create()
    {
        $room = new Room;

        return view('rooms.create', [
            'room' => $room,
        ]);
    }
    
    public function store(Request $request)
    {
        $room = new Room;
        $room->roomname = $request->roomname;
        $room->number = $request->number;
        $room->save();

        return redirect('/admin/home');
    }
    
    public function edit($id)
    {
        $room = Room::find($id);

        return view('rooms.edit', [
            'room' => $room,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->roomname = $request->roomname;
        $room->number = $request->number;
        $room->save();

        return redirect('/admin/home');
    }
    
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect('/admin/home');
    }
}
