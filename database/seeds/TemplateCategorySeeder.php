<?php

use Illuminate\Database\Seeder;
use App\TemplateCategory;


class TemplateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$category = str_random(8);
        TemplateCategory::create([
            'category_name' => $category,
            'category_slug' => str_slug($category),
        ]);
    }
}
