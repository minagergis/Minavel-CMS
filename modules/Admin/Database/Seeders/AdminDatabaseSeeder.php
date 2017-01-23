<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call(LanguageTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(PermissionsRolesTableSeeder::class);
		$this->call(CountriesTableSeeder::class);
		$this->call(WebInfoTableSeeder::class);

	}

}