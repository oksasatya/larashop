<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@gmail.com";
        $administrator->roles = json_encode((['ADMIN']));
        $administrator->password = Hash::make('larashop');
        $administrator->avatar = "Saat-ini-tidak-ada-file-png";
        $administrator->address = "Sarmilim,Bintaro,Tangerang Selatan";

        $administrator->save();

        $this->command->info("User Admin berhasil Diinsert");
    }
}
