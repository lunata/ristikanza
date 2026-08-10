<?php

namespace App\Library;

class Text
{
    const routes = [
        2 => 'bible', 
        4 => 'folklore', 
        12 => 'monuments', 
        15 => 'ethnographic'
    ];
        
    public static function routesByCorpusId($corpus_id) {
        return self::routes[$corpus_id] ?? null;
    }

    
}
