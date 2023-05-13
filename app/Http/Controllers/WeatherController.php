<?php

namespace App\Http\Controllers;


use App\Models\Weather;
use App\Models\Location;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherController extends Controller
{
    public function index()
    {
        $weathers = Weather::all();

        return response()->json([
            'status' => 'success',
            'data' => $weathers
        ]);
    }

    public function show($id)
    {
        $weather = Weather::find($id);

        if (!$weather) {
            return response()->json([
                'status' => 'error',
                'message' => 'Weather data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $weather
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|integer|exists:locations,id',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'description' => 'required|string'
        ]);


        $weather = Weather::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Weather data created successfully',
            'data' => $weather
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'sometimes|required|integer|exists:locations,id',
            'temperature' => 'sometimes|required|numeric',
            'humidity' => 'sometimes|required|numeric',
            'wind_speed' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string'
        ]);

        $weather = Weather::find($id);

        if (!$weather) {
            return response()->json([
                'status' => 'error',
                'message' => 'Weather data not found'
            ], 404);
        }

        $weather->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Weather data updated successfully',
            'data' => $weather
        ]);
    }

    public function destroy($id)
    {
        $weather = Weather::find($id);

        if (!$weather) {
            return response()->json([
                'status' => 'error',
                'message' => 'Weather data not found'
            ], 404);
        }

        $weather->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Weather data deleted successfully'
        ]);
    }

    // for location function class

    public function indexLocation()
    {
        $locations = Location::all();

        return response()->json([
            'status' => 'success',
            'data' => $locations
        ]);
    }

    public function showLocation($id)
    {
        $location = Location::find($id);

        if ($location) {
            return response()->json([
                'status' => 'success',
                'data' => $location
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'location not found for the given location ID'
            ], 404);
        }
    }


    public function storeLocation(Request $request)
    {
        $location = new Location();
        $location->name = $request->name;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return response()->json($location, Response::HTTP_CREATED);
    }

    public function updateLocation(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

        ]);

        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'status' => 'error',
                'message' => 'location data not found'
            ], 404);
        }

        $location->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'location data updated successfully',
            'data' => $location
        ]);
    }

    public function destroyLocation($id)
    {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        $location->delete();

        // return response()->json(null, Response::HTTP_NO_CONTENT);

        return response()->json([
            'status' => 'success',
            'message' => 'Location data deleted successfully'
        ]);
    }
}
