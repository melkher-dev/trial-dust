<?php

use App\Models\Card;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Card::insert([
            [
                'user_id'    => 1,
                'column_id'  => 1,
                'card'       => 'card 1-1',
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 1,
                'card'       => 'card 1-2',
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 2,
                'card'       => 'card 2-1',
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 2,
                'card'       => 'card 2-2',
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 3,
                'card'       => 'card 3-1',
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 3,
                'card'       => 'card 3-2',
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 4,
                'card'       => 'card 4-1',
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column_id'  => 4,
                'card'       => 'card 4-2',
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Card::truncate();
    }
}
