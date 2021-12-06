<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home() {

        return Inertia::render('Dashboard', ['locations'=>Location::all()]);
    }

    public function getloc(Request $request) {
        
        $newloc = DB::table('Location')->where('소재지도로명주소', 'LIKE', '%'.$request->add.'%')->get();
        $size = count($newloc);

        // return Inertia::render('Dashboard', ['locations'=>$newloc]);
        return response()->json([
            'data' => $newloc
        ]);
    }
}
