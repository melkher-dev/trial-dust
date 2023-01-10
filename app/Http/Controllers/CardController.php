<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        $cards = auth()->user()->columns()->with('cards')->get();

        return $cards;
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $columnId = $request->input('columnId');

        $card = $user->columns()
            ->find($columnId)
            ->cards()
            ->orderByDesc('order')
            ->select('order')
            ->get()
            ->last();

        $order = 1;

        if (!empty($card)) {
            $order = $card->order + 1;
        };

        $card               = new Card();
        $card->user_id      = $user->id;
        $card->column_id    = $columnId;
        $card->name         = $request->input('name');
        $card->description  = $request->input('description');
        $card->order        = $order;
        $card->save();
    }
}
