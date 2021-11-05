<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'feed' => 'required|numeric',
        ]);

        return (new CarType($request->all()))->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return int
     */
    public function update(Request $request, $id)
    {
        if ($carType = CarType::find($id)) {
            return $carType->update($request->all());
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return CarType::find($id)->delete();
    }
}
