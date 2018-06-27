<?php

namespace App\Http\Controllers;

use App\Evening;
use Illuminate\Http\Request;

class EveningController extends Controller
{
 protected $evening = null;

    public function __construct(Evening $evening)
    {
        $this->evening = $evening;
    }

    public function store(Request $request)
    {
        $evening = $this->evening->create($request->all());
        return redirect()->route('mornings.index');
    }

}
