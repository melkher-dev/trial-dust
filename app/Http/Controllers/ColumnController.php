<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColumnController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $column = $user->columns()->orderByDesc('order')->select('order')->get()->last();

        $order = 1;

        if (!empty($column)) {
            $order = $column->order + 1;
        };

        $column = new Column();
        $column->user_id = $user->id;
        $column->name = $request->input('name');
        $column->order = $order;
        $column->save();

        return $column->load('cards');
    }

    public function delete(Column $column)
    {
        $column->delete();
    }
}
