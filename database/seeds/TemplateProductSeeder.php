<?php

use Illuminate\Database\Seeder;
use App\TemplateProducts;

class TemplateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = str_random(8);
        TemplateProducts::create([
            'category_id' => rand(1,3),
            'product_name' => $product,
            'product_slug' => str_slug($product),
        ]);
    }
}
