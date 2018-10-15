<?php

use Illuminate\Database\Seeder;
use App\Record;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Record::class, 50)->create();
    }
}
