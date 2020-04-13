<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('linimasas')->insert([
        	'linimasa_judul'      => 'Kopi Dan Kenangan',
        	'linimasa_gambar'	=> 'kopinya'
        ]);

        DB::table('linimasas')->insert([
        	'linimasa_judul'      => 'Kopi kenangan',
        	'linimasa_gambar'	=> 'kopinya'
        ]);
    }
}
