<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		// Permissions
		\DB::table('users')->delete();
		\DB::table('users')->insert(
			[
				['username'=>'admin' ,'email'=>'admin@admin.com' ,'name'=>'admin', 'status' => 1, 'password' => bcrypt(123456)],
			]
		);


	}
}