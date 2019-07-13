<?php

use Illuminate\Database\Seeder;
use App\Models\Grouping\Category;
use App\Models\Opinion\Review;

class CategoryTableSeeder extends Seeder
{
    // Return random value in given range
    public function getCount($label = 'Data')
    {
        $count = $this->command->ask("How many {$label} do you need ?", 'radnom between 1 and 10');
        
        if ( $count === 'radnom between 1 and 10' ) 
            return rand(1, 10);

        return $count;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //For using all memory limit
        ini_set('memory_limit', '-1');
        
        // How many genres you need, defaulting 1 to 10
        $categorycount = $this->getCount('categories');

        $this->command->info("Creating {$categorycount} Categories.");

        $subcategory = $this->getCount('sub category');

        $this->command->info("Creating {$subcategory} Sub Categories for each Category.");

        //Showing all important Data in table
        $this->command->table(['id', 'parent', 'created_at'], Category::all()->map( function($category)
        {
            return [
                $category->id,
                $category->parent,
                $category->created_at
            ];
        }));

        // Create the Categoris 
        $categories = factory(App\Models\Grouping\Category::class, $categorycount)->create();

        // Create the Sub Categories 
        $categories->each( function($category) use(&$categories, $subcategory)
        {
            $categories = $categories->merge(
                $category->childs()->saveMany(
                factory(App\Models\Grouping\Category::class, $subcategory)->create()
            ));
        });

        //Return all User
        $users = App\User::all();

        // How many genres you need, defaulting 1 to 10
        $currencycount = $this->getCount('currencies');

        $this->command->info("Creating a range of {$currencycount} Currencies for {$users->count()} users.");
        
        // How many genres you need, defaulting 1 to 10
        $reviewcount = $this->getCount('reviews');
        
        $this->command->info("Creating a range of {$reviewcount} Reviews for {$users->count()} users.");

        //Showingall important Data in table
        $this->command->table(['id', 'user_id', 'currency_id', 'created_at'], Review::all()->map( function($review)
        {
            return [
                $review->id,
                $review->user_id,
                $review->currency_id,
                $review->created_at,
            ];
        }));

        // How many genres you need, defaulting 1 to 10
        $speccount = $this->getCount('specs');

        $this->command->info("Creating a range of {$speccount} Specs .");

        $specs = factory(App\Models\Spec\Spec::class, $speccount)-> create();

        // Create the Currencies & relation Users
        $users->each( function($user) use($reviewcount, $currencycount, $users, $categories, $specs)
        {
            $user->currencies()->saveMany(
                factory(App\Models\Currency\Currency::class, $currencycount)->create([
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id,
                    'spec_id' => $specs->random()->id,
                ])
                // Create the reviews & relation Users & Currencies
                );
            // ->each( function($currency) use($reviewcount, $users)
            // {
            //     //For using all memory limit
            //     ini_set('memory_limit', '-1');
        
            //     $currency->reviews()->saveMany(
            //         factory(App\Models\Opinion\Review::class, $reviewcount)->make([
            //         'currency_id' => $currency->id,
            //         'user_id' => $users->random()->id
            //         ])
            //     );
            // });
        });
        
        $this->command->info("Categories , SubCategories , Currencies & Reviwes Created! '-'");
    }
}
