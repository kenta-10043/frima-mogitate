<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\ProductSeason;


class SeasonController extends Controller
{
    public function store(SeasonRequest $request)
    {
        $season = $request->only([
            'name',
        ]);
        Season::create($season);
        return redirect('/');
    }
}
