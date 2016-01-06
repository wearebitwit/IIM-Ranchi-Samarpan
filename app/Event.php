<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    public function insert()
    {
        $maxIndex = Event::max('index');
        $maxIndex = $maxIndex + 1;
        
        $this->index = $maxIndex;

        if($this->save())
            return true;
        else
            return false;                    
    }

    public static function reorder($id, $prevIndex, $diff)
    {
        $newIndex = $prevIndex + $diff;    
        return DB::transaction(function () use ($id, $prevIndex, $newIndex) {
            if($prevIndex < $newIndex)
                Event::whereBetween('index', [$prevIndex, $newIndex])->decrement('index');
            else
                Event::whereBetween('index', [$prevIndex, $newIndex])->increment('index');

            Event::where('id',$id)->update(['index' => $newIndex]);
        });        
    }  

}
