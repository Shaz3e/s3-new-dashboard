<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email_templates = [
            ['header' => 'template header', 'footer' => 'teamplate footer', 'name' => 'welcome_email', 'subject' => 'Welcome to {app_name}', 'body' => 'This is body content {name} or this is URL {app_url}', 'placeholders' => '["app_name", "name", "app_url"]', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('email_templates')->insert($email_templates);
    }
}
