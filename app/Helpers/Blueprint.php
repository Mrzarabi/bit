<?php

namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint as BaseBlueprint;
use Illuminate\Support\Str;

class Blueprint extends BaseBlueprint
{        
    /**
     * Add an mediumtext fieild to the table that represents an json array
     * 
     * @param string        $column
     * @param string|null   $comment
     * @param boolean|true  $nullable
     * @return void
     */
    public function array ($column, $comment = null, $nullable = true)
    {
        if (!$comment)
        {
            $table = Str::singular( $this->table );
            $comment = "Array of the {$table} {$column}";
        }

        if ( $nullable )
            return $this->mediumText($column)->nullable()->comment($comment);
        else
            return $this->mediumText($column)->comment($comment);
    }

    /**
     * Add all the deleted_at, created_at & updated_at timestamp feilds to the table
     *
     * @return void
     */
    public function full_timestamps(Array $other_times = [])
    {
        if ( $other_times )
        {
            foreach ( $other_times as $item )
                $this->timestamp($item)->nullable();
        }
        $this->softDeletes();
        $this->timestamps();
    }

    /**
     * Add full foreign key column for the given feild on the table.
     *
     * @param  string       $feild
     * @param  string|null  $table
     * @param  string|null  $type           name of the feild method
     * @param  string|null  $references     references feild name
     * @param  string|null  $cascade        cascade, set null, restrict
     * @return void
     */
    public function foreign_key ($feild, $nullable = false, $table = null, $type = 'unsignedInteger', $references = 'id', $cascade = 'cascade')
    {
        if ( is_null( $table ) )
            $table = Str::plural( Str::replaceLast('_id', '', $feild) );
        
        if ( $nullable )
            $this->$type( $feild )->nullable();
        else
            $this->$type( $feild );

        $this->foreign( $feild )
            ->references( $references )
            ->on( $table )
            ->onDelete( $cascade )
            ->onUpdate( $cascade );
    }
}