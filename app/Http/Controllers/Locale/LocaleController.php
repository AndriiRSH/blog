<?php

namespace App\Http\Controllers\Locale;

use Illuminate\Support\Facades\App;

class LocaleController
{
    public function __invoke($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
