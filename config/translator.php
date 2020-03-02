<?php

use Waavi\Translation\Facades\TranslationCache;

return [

    /*
    |--------------------------------------------------------------------------
    | Alapértelmezett fordítási mód
    |--------------------------------------------------------------------------
    |
    | Ez az opció vezérli a fordító csomag működési módját.
    |
    | Supported:
    |
    |   'mixed'         Mind a fájlok, mind az adatbázis nyelvi bejegyzéseket kér, a fájlok elsőbbséget élveznek.
    |   'mixed_db'      Mind a fájlok, mind az adatbázis nyelvi bejegyzéseket igényel, az adatbázis elsőbbséget élvez.
    |   'database'      Az adatbázist használja a nyelvbejegyzés kizárólagos forrásaként.
    |   'files'         A fájlok használata a nyelvbejegyzés kizárólagos forrásaként [Laravel alapértelmezett].
     */
    //'source'            => env('TRANSLATION_SOURCE', 'mixed_db'),
    'source'            => 'database',

    // Ha a fájlforrást választja, kérjük, írja ide ide az alkalmazásának támogatott nyelveit.
    // Pl: ['en', 'es', 'fr']
    'available_locales' => ['en', 'hu'],

    /*
    |--------------------------------------------------------------------------
    | Alapértelmezett fordítási gyorsítótár
    |--------------------------------------------------------------------------
    |
    | Válassza ki, hogy ki akarja-e használni a Laravel gyorsítótár-modulját, és hogyan.
    |
    |   'enabled'       A fordítási gyorsítótár engedélyezése / letiltása. Boolean.
    |   'timeout'       Percben
    |
     */
    'cache'             => [
        // A fordítási gyorsítótár engedélyezése / letiltása
        'enabled' => env('TRANSLATION_CACHE_ENABLED', true),
        // Gyorsítótár frissítése x percenként
        'timeout' => env('TRANSLATION_CACHE_TIMEOUT', 60),
        // Alapértelmezés a „fordítás”. Ez lesz a gyorsítótár utótag, amelyet minden fordítási gyorsítótár-bejegyzésre alkalmaznak.
        'suffix'  => env('TRANSLATION_CACHE_SUFFIX', 'translation'),
    ],
];

// Gyorsítótár kiürítése:
// php artisan translator:flush
// vagy
// aliashoz hozzáadni: 'TranslationCache' => Waavi\Translation\Facades\TranslationCache::class,
// és utána
// TranslationCache::flush();
// TranslationCache::flush($locale, $group, $namespace);
