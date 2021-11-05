<?php

namespace App\Http\Controllers;

use Alcidesrh\Generic\GenericResourceCollection;
use App\Models\CarType;
use App\Models\Parking;
use App\Models\PriceMinute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParkingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new GenericResourceCollection(Parking::all(), ['plate', 'minutes', 'amount']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|string',
            'car_in' => 'required|date',
        ]);

        return (new Parking($request->all()))->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($parking = Parking::find($id)) {

            $input = $request->all();

            if ($carOutDate = $request->car_out) {

                $minutes = (new Carbon($carOutDate))->diffInMinutes(new Carbon($parking->car_in));

                if ($priceMinute = PriceMinute::first()) {
                    $price = $priceMinute->price;
                }

                $amount = round($minutes * ($price ?? 0.5), 2);

                if ($carTypeId = $request->car_type_id) {
                    $carType = CarType::find($carTypeId);
                } else if ($parking->carType) {
                    $carType = $parking->carType;
                }

                if (isset($carType)) {
                    $amount += $carType->feed;
                }

                $input['amount'] = $amount;
            }
            return $parking->update($input);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Parking::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Parking::find($id)->delete();
    }
}
