<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\Make;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends \App\Http\Controllers\Controller
{
    public function filter(Request $request)
    {
        $makes = Make::all();
        $makesArray = [];

        foreach ($makes as $make) {
            array_push($makesArray, $make->name);
        }
        $validator = Validator::make($request->all(), [
            'priceFrom' => 'integer',
            'yearFrom' => 'integer',
            'yearTo' => 'integer',
            'priceTo' => 'integer',
            'make' => 'in:'. implode(',', $makesArray)

        ]);


        if ($validator->passes()) {
            $cars = Car::select('*');

            if (isset($request->priceFrom)) {
                $cars = $cars->where('price', '>=', $request->priceFrom);
            }
            if (isset($request->priceTo)) {
                $cars = $cars->where('price', '<=', $request->priceTo);
            }
            if (isset($request->yearFrom)) {
                $cars = $cars->where('year', '>=', $request->yearFrom);
            }
            if (isset($request->yearTo)) {
                $cars = $cars->where('year', '<=', $request->yearTo);
            }
            if (isset($request->make)) {
                $cars = $cars->join('models', 'models.id', '=', 'cars.model_id')
                    ->join('makes', 'makes.id', '=', 'models.make_id')
                    ->where('makes.name', '=', $request->make);
            }

            $cars = $cars->get();

            return response()->json(['cars' => $cars]);

        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }
}