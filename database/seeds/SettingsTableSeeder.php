<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'key'   => 'name',
                'value' => 'Subsite Newsletter'
            ]
        );
        DB::table('settings')->insert(
            [
                'key'   => 'email',
                'value' => 'noreply@resourcecontracts.com'
            ]
        );
        DB::table('settings')->insert(
            [
                'key'   => 'subject',
                'value' => 'Newsletter'
            ]
        );
        DB::table('settings')->insert(
            [
                'key'   => 'schedule',
                'value' => 'DAILY'
            ]
        );
        DB::table('settings')->insert(
            [
                'key'   => 'time',
                'value' => '00:00:10'
            ]
        );
    }
}
