<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class Personnage extends Controller
{
    public function Liste(Request $request)
    {
        return Inertia::render('Personnages/Liste', [
            'personnages' => [
                ['nom' => 'Arsene Riviere'],
                ['nom' => 'Maxou La Bestou'],
            ]
        ]);
    }
}
