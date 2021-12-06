<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class CarInfoController extends Controller
{
    public function inputinfo() {
        return Inertia::render('Home/MyCar', ['user'=>auth()->user()]);
    }

    public function store(Request $request) {

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(400, 250);
        $image->save();

        Car::create([
            'user_id' => $request['id'],
            'carname' => $request['carname'],
            'carnum' => $request['carnum'],
            'brand' => $request['brand'],
            'image' => $imagePath
        ]);

        return Inertia::render('Home/MyCars', ['user'=>auth()->user(), 'cars'=>Auth::user()->car]);
    }

    public function show() {
        $user = auth()->user();

        $cars = Car::where('user_id', $user->id)->get();

        return Inertia::render('Home/MyCars', ['user'=>auth()->user(), 'cars'=>$cars]);
    }
    
    public function delete($id) {
        $car = Car::find($id);
        dd($car->image);
        if($car->image) {
            $imagePath = $car->image;
            Storage::delete($imagePath);
        }
        $car->delete();

        return Redirect::route('showcarinfo', ['user'=>auth()->user(), 'cars'=>Auth::user()->car]);
    }
}
