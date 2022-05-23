<?php

namespace App\Http\Controllers;

use App\Models\PlayerInRoom;
use App\Models\Room as ModelsRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Room extends Controller
{
    public function CreateRoom(Request $request)
    {
        $rooms = ModelsRoom::all();

        $room = new ModelsRoom;

        $room->player_max = 4;
        $room->owner_id = Auth::user()->id;

        $keyIsUnique = true;
        $key = "";

        do {
            $key = $this->RandomString(5);

            foreach ($rooms as $room)
                if ($room->id == $key)
                    $keyIsUnique = false;

        } while (!$keyIsUnique);

        $room->id = $key;
        
        ModelsRoom::create([
            'player_max' => 4,
            'owner_id' => Auth::user()->id,
            'id' => $key
        ]);

        return redirect("/room/$key");
    }

    public function RoomPage(Request $request, $id)
    {
        $user = [
            'id' => Auth::user()->id,
            'username' => Auth::user()->name,
        ];
        
        return Inertia::render('Room', [
            'room' => ModelsRoom::find($id),
            'user' => $user
        ]);
    }

    public function JoinRoom(Request $request)
    {
        $roomID = $request->roomID;
        $userID = $request->userID;
        
        $player = PlayerInRoom::where([
            ['roomID', '=', $roomID],
            ['playerID', '=', $userID]
        ])->get();
        
        if ($player->isEmpty()) {
            PlayerInRoom::create([
                'roomID' => $roomID,
                'playerID' => $userID
            ]);
        }
    }

    public function LeftRoom(Request $request)
    {
        $roomID = $request->roomID;
        $userID = $request->userID;

        PlayerInRoom::where([
            ['roomID', '=', $roomID],
            ['playerID', '=', $userID]
        ])->delete();

        /*$players = PlayerInRoom::where('roomID', $roomID)->get();
        if(count($players) == 0) {
            ModelsRoom::find($roomID)->delete();
        }*/
    }

    private function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring[$i] = $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
}
