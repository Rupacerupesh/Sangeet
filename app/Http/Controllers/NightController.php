<?php

namespace App\Http\Controllers;

use App\Night;
use Illuminate\Http\Request;

class NightController extends Controller
{
 protected $night = null;

    public function __construct(Night $night)
    {
        $this->night = $night;
    }

    public function store(Request $request)
    {
        $night = $this->night->create($request->all());
        return redirect()->route('mornings.index');
    }

}
