<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission for posts
        Permission::create(['name' => 'posts.index']);
        Permission::create(['name' => 'posts.create']);
        Permission::create(['name' => 'posts.edit']);
        Permission::create(['name' => 'posts.delete']);

        //permission for tags
        Permission::create(['name' => 'tags.index']);
        Permission::create(['name' => 'tags.create']);
        Permission::create(['name' => 'tags.edit']);
        Permission::create(['name' => 'tags.delete']);

        //permission for categories
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);

        //permission for events
        Permission::create(['name' => 'events.index']);
        Permission::create(['name' => 'events.create']);
        Permission::create(['name' => 'events.edit']);
        Permission::create(['name' => 'events.delete']);

        //permission for photos
        Permission::create(['name' => 'photos.index']);
        Permission::create(['name' => 'photos.create']);
        Permission::create(['name' => 'photos.delete']);

        //permission for videos
        Permission::create(['name' => 'videos.index']);
        Permission::create(['name' => 'videos.create']);
        Permission::create(['name' => 'videos.edit']);
        Permission::create(['name' => 'videos.delete']);

        //permission for sliders
        Permission::create(['name' => 'sliders.index']);
        Permission::create(['name' => 'sliders.create']);
        Permission::create(['name' => 'sliders.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
    }
}
