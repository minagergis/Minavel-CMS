<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LanguageTableSeeder extends Seeder {

	public function run()
	{

		\DB::table('language')->delete();
		\DB::table('language')->insert(
			[
				['name'=>'Arabic'  ,'icon' => 'EG', 'locale'=>'ar'],
				['name'=>'English' ,'icon' => 'US', 'locale'=>'en'],
			]
		);


	}
}