<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'over_name' => '光',
        'under_name' => '宙',
        'over_name_kana' => 'ピカ',
        'under_name_kana' => 'チュウ',
        'mail_address' => 'pika@pika',
        'sex' => '1',
        'birth_day' => '1996-02-27',
        'role' => '4',
        'password' => bcrypt('pikapika'),
      ]);

      User::create([
        'over_name' => '雅',
        'under_name' => 'マモル',
        'over_name_kana' => 'ミヤビ',
        'under_name_kana' => 'マモル',
        'mail_address' => 'mamo@mamo',
        'sex' => '1',
        'birth_day' => '2000-06-08',
        'role' => '3',
        'password' => bcrypt('mamomamo'),
      ]);
    }
}
