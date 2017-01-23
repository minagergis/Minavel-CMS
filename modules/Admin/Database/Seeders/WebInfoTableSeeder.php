<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WebInfoTableSeeder extends Seeder {

    public function run()
    {

        // Permissions
        \DB::table('web_info')->delete();
        \DB::table('web_info')->insert(
            [
                ['title'=>'default' ,'desc'=>'default desc' ,'tags'=>'web,site,tags', 'locale' => 'en'],
                ['title'=>'نمطي' ,'desc'=>'وصف نمطي' ,'tags'=>'وصف,موقع,نمطي', 'locale' => 'ar'],
            ]
        );


    }
}