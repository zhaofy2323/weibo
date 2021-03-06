<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(50)->create();

        $user = User::find(1);
        $user->name = 'zhaofy';
        $user->email = 'zhaofy@steelhome.cn';
        $user->is_admin = true;
        $user->password = bcrypt('zfy520100');
        $user->save();
    }
}
