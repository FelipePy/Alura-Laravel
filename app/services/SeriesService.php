<?php

namespace App\services;

use App\Http\Requests\SeriesFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SeriesService
{
    static public function create_path(SeriesFormRequest $request)
    {
        $now = Carbon::now();
        $path = Auth::user()->name . '-' . $request->all()['name'] . '-' . $now . '.'.$request->file('cover')->extension();
        return str_replace(" ", "-", trim($path));
    }
}
