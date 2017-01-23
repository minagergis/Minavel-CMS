<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsRolesTableSeeder extends Seeder {

	public function run()
	{

		// Permissions
		\DB::table('permissions')->delete();
		\DB::table('permissions')->insert(
			[
				['name'=>'admin.login'     ,'display_name'=>'Admin Login'     ,'description'=>'', 'category' => 'dashboard'],
				['name'=>'comment.manage'  ,'display_name'=>'Manage Comments' ,'description'=>'', 'category' => 'comment'],
				['name'=>'settings.manage' ,'display_name'=>'Manage Settings' ,'description'=>'', 'category' => 'settings'],

				['name'=>'post.view'   ,'display_name'=>'View Post' ,'description'=>'' , 'category' => 'post'],
				['name'=>'post.add'    ,'display_name'=>'Add Post' ,'description'=>'' , 'category' => 'post'],
				['name'=>'post.edit'   ,'display_name'=>'Edit Post' ,'description'=>'' , 'category' => 'post'],
				['name'=>'post.delete' ,'display_name'=>'Delete Post' ,'description'=>'' , 'category' => 'post'],

				['name'=>'page.view'   ,'display_name'=>'View Page' ,'description'=>'' , 'category' => 'page'],
				['name'=>'page.add'    ,'display_name'=>'Add Page' ,'description'=>'' , 'category' => 'page'],
				['name'=>'page.edit'   ,'display_name'=>'Edit Page' ,'description'=>'' , 'category' => 'page'],
				['name'=>'page.delete' ,'display_name'=>'Delete Page' ,'description'=>'' , 'category' => 'page'],

				['name'=>'gallery.view'   ,'display_name'=>'View Gallery' ,'description'=>'' , 'category' => 'gallery'],
				['name'=>'gallery.add'    ,'display_name'=>'Add Gallery' ,'description'=>'' , 'category' => 'gallery'],
				['name'=>'gallery.edit'   ,'display_name'=>'Edit Gallery' ,'description'=>'' , 'category' => 'gallery'],
				['name'=>'gallery.delete' ,'display_name'=>'Delete Gallery' ,'description'=>'' , 'category' => 'gallery'],

				['name'=>'category.view'   ,'display_name'=>'View Category' ,'description'=>'' , 'category' => 'category'],
				['name'=>'category.add'    ,'display_name'=>'Add Category' ,'description'=>'' , 'category' => 'category'],
				['name'=>'category.edit'   ,'display_name'=>'Edit Category' ,'description'=>'' , 'category' => 'category'],
				['name'=>'category.delete' ,'display_name'=>'Delete Category' ,'description'=>'' , 'category' => 'category'],

				['name'=>'user.view'   ,'display_name'=>'View User' ,'description'=>'' , 'category' => 'user'],
				['name'=>'user.add'    ,'display_name'=>'Add User' ,'description'=>'' , 'category' => 'user'],
				['name'=>'user.edit'   ,'display_name'=>'Edit User' ,'description'=>'' , 'category' => 'user'],
				['name'=>'user.delete' ,'display_name'=>'Delete User' ,'description'=>'' , 'category' => 'user'],

				['name'=>'media.view'   ,'display_name'=>'View Media' ,'description'=>'' , 'category' => 'media'],
				['name'=>'media.add'    ,'display_name'=>'Add Media' ,'description'=>'' , 'category' => 'media'],
				['name'=>'media.edit'   ,'display_name'=>'Edit Media' ,'description'=>'' , 'category' => 'media'],
				['name'=>'media.delete' ,'display_name'=>'Delete Media' ,'description'=>'' , 'category' => 'media'],
				
			]
		);


		// Roles
		\DB::table('roles')->delete();
		\DB::table('roles')->insert([['name'=>'admin' ,'display_name'=>'Admin' ,'description'=>'']]);

		// Permission_Role
		\DB::table('permission_role')->delete();

		$arr = [];

		foreach (range(1, 27) as $permission_id) {
			$arr[] = ['role_id'=> 1 ,'permission_id'=> $permission_id];
		}
		
		\DB::table('permission_role')->insert($arr);

		// Role_User
		\DB::table('role_user')->delete();
		\DB::table('role_user')->insert([['user_id'=> 1 ,'role_id'=> 1]]);
	}
}