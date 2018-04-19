<?php

namespace  App\Services;


use App\Models\Car;
use App\Models\Make;
use App\Models\Model;

class CarImport
{
    public function import()
    {
        $xml = simplexml_load_file(storage_path('test_task.xml'));

        foreach ($xml->Ad as $row) {

            // create make
            $make = Make::where('name', '=', $row->Make)->first();

            if (is_null($make)) {
                $make = new Make();
                $make->name = $row->Make;
                $make->save();
            }

            // create model
            $model = Model::where('name', '=', $row->Model)->first();

            if (is_null($model)) {
                $model = new Model();
                $model->make_id = $make->id;
                $model->name = $row->Model;
                $model->save();
            }

            // create car
            $car = Car::where('import_id', '=', $row->Id)->first();

            if (is_null($car)) {
                $car = new Car();
                $car->model_id = $model->id;
                $car->import_id = $row->id;
                $car->price = $row->Price;
                $car->kilometrage = $row->Kilometrage;
                $car->year = $row->Year;
                $car->body_type = $row->bodyType;

                // did not make validation for all fields but made for this one because there is no doors field in one model
                $car->doors = ($row->Doors != '') ?  $row->Doors : 0;
                $car->color = $row->Color;
                $car->fuel_type = $row->FuelType;
                $car->engine_size = $row->EngineSize;
                $car->power = $row->Power;
                $car->transmission = $row->Transmission;
                $car->drive_type = $row->DriveType;

                // saving images
                $images = [];
                foreach ($row->Images->Image as $image) {
                    array_push($images, $image->attributes()[0]);
                }
                $car->images = implode(',', $images);

                $car->save();
            }

        }

        return $xml;
    }
}
