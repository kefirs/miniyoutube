<?php
use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $category = new Category();
       $category->name='Music';
       $category->save();
       $category = new Category();
       $category->name='Jokes';
       $category->save();
       $category = new Category();
       $category->name='Sport';
       $category->save();
       $category = new Category();
       $category->name='Games';
       $category->save();
       $category = new Category();
       $category->name='News';
       $category->save();

    }
}
