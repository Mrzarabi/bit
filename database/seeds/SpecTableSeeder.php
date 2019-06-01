<?php

use Illuminate\Database\Seeder;
use App\Models\Spec\Spec;
use App\Models\Spec\SpecHeader;
use App\Models\Spec\SpecRow;
use App\Models\Spec\SpecData;

class SpecTableSeeder extends Seeder
{
    // Return random value in given range
    public function getCount($label = 'Data')
    {
        $count = $this->command->ask("How many {$label} do you need ?", 'radnom between 1 and 5');
        
        if ( $count === 'radnom between 1 and 5' ) 
            return rand(1, 5);

        return $count;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Return all category
        $categories = App\Models\Grouping\Category::all();
        
        //Return all currency
        $currencies = App\Models\Currency\Currency::all();

        //create null property
        $specs = null;
        $spec_headers = null;
        $spec_rows = null;
        $spec_datas = null;

        //For using all memory limit
        ini_set('memory_limit', '-1');        

        // Create spec & relation category 
        $specs = factory(\App\Models\Spec\Spec::class)->create([
            'category_id' => $categories->random()->id
        ]);

        //Showing all important Data in table
        $this->command->table(['id', 'category_id', 'created_at'], $specs->all()->map( function($spec)
        {
            return [
                $spec->id,
                $spec->category_id,
                $spec->created_at
            ];
        }));

        $this->command->info("Creating Specs.");
        
        // How many genres you need, defaulting 1 to 10
        $specheadercount = $this->getCount('specHeader');

        // How many genres you need, defaulting 1 to 10
        $specrowcount = $this->getCount('specRow');

        // Create spec header & spec row & relation spec 
        $specs->each( function ($spec) use (&$spec_rows, $specrowcount, $specheadercount, &$spec_headers )
        {
            $spec_headers = factory(\App\Models\Spec\SpecHeader::class, $specheadercount)->create([
                'spec_id' => $spec->id
            ])->each( function ( $spec_header ) use (&$spec_rows, $specrowcount) {

                $spec_rows = factory(\App\Models\Spec\SpecRow::class, $specrowcount)->create([
                    'spec_header_id' => $spec_header->id
                ]);
            });
        });

        //Showing all important Data in table
        $this->command->table(['id', 'spec_id', 'created_at'], SpecHeader::all()->map( function($spec_header)
        {
            return [
                $spec_header->id,
                $spec_header->spec_id,
                $spec_header->created_at
            ];
        }));

        
        $this->command->info("Creating {$specheadercount} Spec Headers.");

        //Showing all important Data in table
        $this->command->table(['id', 'spec_header_id', 'created_at'], SpecRow::all()->map( function($spec_row)
        {
            return [
                $spec_row->id,
                $spec_row->spec_header_id,
                $spec_row->created_at
            ];
        }));

        $this->command->info("Creating {$specrowcount} Spec Rows.");

        // Create spec data & relation spec row & currency & data 
        $spec_rows->each( function ($spec_row) use ($currencies, &$spec_datas) {

            $spec_datas = factory(\App\Models\Spec\SpecData::class)->create([
                'spec_row_id' => $spec_row->id,
                'currency_id' => $currencies->random()->id,
                'data' => ($spec_row->values)
                        ? rand(0, count($spec_row->values, true) - 1)
                        : Faker::fullName()
            ]);
        });

        //Showing all important Data in table
        $this->command->table(['id', 'spec_row_id', 'currency_id', 'created_at'], $spec_datas::all()->map( function($spec_data)
        {
            return [
                $spec_data->id,
                $spec_data->spec_row_id,
                $spec_data->currency_id,
                $spec_data->created_at
            ];
        }));

        $this->command->info("Creating Specs Data.");

        $this->command->info("Specification , Specificatoin Header , Specification Row & Specification Data Created! '-'");
    }
}
