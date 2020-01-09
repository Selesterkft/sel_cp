<?php

namespace App\SearchAspects;

use App\Models\base\CompanyModel;
use App\User;
use Illuminate\Support\Collection;
use Spatie\Searchable\SearchAspect;

class UsersSearchAspect extends SearchAspect
{

    public function getResults(string $term): Collection
    {
        $companyID = CompanyModel::raw(config('appConfig.raw'))
            ->where('Nev1', 'like', "%{$term}%")
            ->first()
            ->ID;
        $users = User::raw(config('appConfig.raw'))
            ->where('CompanyID', '=', $companyID)
            ->get();

        return $users;
    }
}