<?php

namespace App\Http\Controllers;

use App\Noon;
use Illuminate\Http\Request;

class NoonController extends Controller
{
 protected $latenight = null;

    public function __construct(Noon $noon)
    {
        $this->noon = $noon;
    }

    public function store(Request $request)
    {
        $noon = $this->noon->create($request->all());
        return redirect()->route('mornings.index');
    }

}
