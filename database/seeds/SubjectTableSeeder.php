<?php

use Illuminate\Database\Seeder;
use App\Models\Grouping\Subject;
use App\Models\Opinion\Comment;

class SubjectTableSeeder extends Seeder
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
        // How many genres you need, defaulting 1 to 10
        $subjectcount = $this->getCount('subjects');

        $this->command->info("Creating {$subjectcount} subjects.");

        //Showing all important Data in table
        $this->command->table(['id', 'created_at'], Subject::all()->map( function($subject)
        {
            return [
                $subject->id,
                $subject->created_at
            ];
        }));

        // Create the Subjects 
        $subjects = factory(App\Models\Grouping\Subject::class, $subjectcount)->create();

        //Return all User
        $users = App\User::all();

        // How many genres you need, defaulting 1 to 10
        $articlecount = $this->getCount('articles');

        $this->command->info("Creating a range of {$articlecount} articles for {$users->count()} users.");
        
        // How many genres you need, defaulting 1 to 10
        $commentcount = $this->getCount('comments');
        
        $this->command->info("Creating a range of {$commentcount} comments for {$users->count()} users.");

        //For using all memory limit
        // ini_set('memory_limit', '-1');

        //Showing all important Data in table
        $this->command->table(['id', 'user_id', 'article_id', 'created_at'], Comment::all()->map( function($comment)
        {
            return [
                $comment->id,
                $comment->user_id,
                $comment->article_id,
                $comment->created_at,
            ];
        }));

        // Create the articles & relation Users
        $users->each( function($user) use($commentcount, $articlecount, $users)
        {
            $user->articles()->saveMany(
                $articles = factory(App\Models\Article\Article::class, $articlecount)->create([
                    'user_id' => $user->id
                ])
                // Create the comments & relation Users & articles
            )->each( function($article) use($commentcount, $users)
            {
                //For using all memory limit
                // ini_set('memory_limit', '-1');

                $article->comments()->saveMany(
                    factory(App\Models\Opinion\Comment::class, $commentcount)->make([
                    'article_id' => $article->id,
                    'user_id' => $users->random()->id
                    ])
                );
            });
        });

        $this->command->info("Subjects , Articles & Comments Created! '-'");
    }
}
