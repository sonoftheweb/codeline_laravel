<?php

namespace App\Http\Middleware;

class ResourceMap
{
    /**
     * @return array
     */
    public static function getMapping()
    {
        return array(
            [
                'resource' => 'films',
                'model' => '\App\Models\Film',
                'controller' => '\App\Http\Controllers\FilmsController'
            ]
        );
    }
}
