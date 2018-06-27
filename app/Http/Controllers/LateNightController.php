<?php

namespace App\Http\Controllers;

use App\LateNight;
use Illuminate\Http\Request;

class LateNightController extends Controller
{
 protected $latenight = null;

    public function __construct(LateNight $latenight)
    {
        $this->latenight = $latenight;
    }

    public function store(Request $request)
    {
        $latenight = $this->latenight->create($request->all());
        return redirect()->route('mornings.index');
    }

}
