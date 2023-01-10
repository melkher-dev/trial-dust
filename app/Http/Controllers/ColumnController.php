<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColumnController extends Controller
{
    public function addColumn(Request $request)
    {
        $user = Auth::user();

        $column = $user->columns()->orderByDesc('order')->select('order')->get()->last();

        Column::insert([
            'user_id' => $user->id,
            'column' => $request->columnName,
            'order' => ++$column->order,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
