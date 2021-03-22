<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VoyageResource;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voyages = Voyage::all();
        return response(
            [
                'voyages' => VoyageResource::collection($voyages),
                'message' => 'Retrieved successfully'
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'start' => 'required|max:255',
            'destination' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'car_model' => 'required',
            'num_passengers' => 'required',
            'cotisation' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'error' => $validator->errors(), 'Validation Error'
                ]
            );
        }

        $voyage = Voyage::create($data);

        return response(
            [
                'voyage' => new VoyageResource($voyage),
                'message' => 'Created successfully'
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voyage  $voyage
     * @return \Illuminate\Http\Response
     */
    public function show(Voyage $voyage)
    {
        return response(
            [
                'voyage' => new VoyageResource($voyage),
                'message' => 'Retrieved successfully'
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voyage  $voyage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voyage $voyage)
    {
        $voyage->update($request->all());

        return response(
            [
                'voyage' => new VoyageResource($voyage),
                'message' => 'Update successfully'
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voyage  $voyage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voyage $voyage)
    {
        $voyage->delete();

        return response(
            [
                'message' => 'Deleted'
            ]
        );
    }
}
