<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter($query, $request)
    {
        $param = $request->all();
        foreach ($param as $field => $value) {
            // dd($param);
            $method = 'filter' . Str::studly($field);

            
        }

        return $query;
    }
}
