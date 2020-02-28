<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriousTime extends Controller
{
    public function something() {
        echo "echo";
    }

    public function oompa() {
        $oompa = [
            [
                'id' => 1,
                'name' => 'Mister Oompa',
                'email' => 'MisterOompa@OompaLand.com',
                'mark' => 9
            ],
            [
                'id' => 2,
                'name' => 'Miss Oompa',
                'email' => 'MissOompa@OompaLand.com',
                'mark' => 10
            ],
            [
                'id' => 3,
                'name' => 'Oompa Junior',
                'email' => 'OompaJunior@OompaLand.com',
                'mark' => 10
            ]
        ];
        return view('oompaoompa', ['oompa' => $oompa]);
    }
}
