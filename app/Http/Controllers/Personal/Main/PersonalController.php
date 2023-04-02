<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;


class PersonalController extends Controller
{
    public function __invoke()
    {
        return view('personal.main.index');
    }
}
