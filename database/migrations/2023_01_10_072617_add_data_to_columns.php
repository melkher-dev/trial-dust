<?php

use App\Models\Column;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Column::insert([
            [
                'user_id'    => 1,
                'column'     => 'column 1',
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column'     => 'column 2',
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column'     => 'column 3',
                'order'      => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id'    => 1,
                'column'     => 'column 4',
                'order'      => 4,
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
        Column::truncate();
    }
}
