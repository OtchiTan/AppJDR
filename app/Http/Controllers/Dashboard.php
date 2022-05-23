<?php

namespace App\Http\Controllers;

use App\Models\PlayerInRoom;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function Index(Request $request)
    {
        $rooms = Room::all()->toArray();
        $roomList = [];


        foreach ($rooms as $room) {
            $newRoom = $room;
            $newRoom['players'] = PlayerInRoom::where('roomID',$room['id'])->get()->toArray();
            $newRoom['owner'] = User::find($newRoom['owner_id'])->first()->name;
            array_push($roomList,$newRoom);
        }

        return Inertia::render('Dashboard', [
            'rooms' => $roomList
        ]);
    }
}
