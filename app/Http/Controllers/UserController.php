<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->keywordsName;
        $priceFrom = $request->keywordsPriceFrom;
        $priceTo = $request->keywordsPriceTo;
        $bedrooms = $request->keywordsBedrooms;
        $bathrooms = $request->keywordsBathrooms;
        $storeys = $request->keywordsStoreys;
        $garages = $request->keywordsGarages;

        if (isset($name)) {
            $users = User::select('*')
                ->orWhere('name', 'like', "%{$name}%")
                ->orWhere('bedrooms', '=', $bedrooms)
                ->orWhere('bathrooms', '=', $bathrooms)
                ->orWhere('storeys', '=', $storeys)
                ->orWhere('garages', '=', $garages)
                ->orWhereBetween('price', [$priceFrom, $priceTo])
                ->get();
        } else {
            $users = User::select('*')
                ->orWhere('name', '=', $name)
                ->orWhere('bedrooms', '=', $bedrooms)
                ->orWhere('bathrooms', '=', $bathrooms)
                ->orWhere('storeys', '=', $storeys)
                ->orWhere('garages', '=', $garages)
                ->orWhereBetween('price', [$priceFrom, $priceTo])
                ->get();
        }

        return response()->json($users);
    }
}
