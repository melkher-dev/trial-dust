<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function getCards()
    {
        $cards = auth()->user()->columns()->with('cards')->get();

        return $cards;
    }
}
