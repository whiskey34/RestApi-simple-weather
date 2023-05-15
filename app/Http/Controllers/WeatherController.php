<?php

namespace App\Http\Controllers;


use App\Models\Weather;
use App\Models\Location;
use App\Models\Forecast;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherController extends Controller
{

    /**
     * @OA\Get(
     *     path="/",
     *     summary="Get all weather conditions",
     *     tags={"Weather"},
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     description="ID of the weather condition",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="temperature",
     *                     description="Temperature in Celsius",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="humidity",
     *                     description="Humidity percentage",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     description="Timestamp when the record was created",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     description="Timestamp when the record was last updated",
     *                     type="string",
     *                     format="date-time"
     *                 )
     *             )
     *         )
     *     )
     * )
     * 
     * 
     * @OA\Get(
     *     path="/{id}",
     *     tags={"Weather"},
     *     summary="Get current weather conditions",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Weather condition's ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="location_id",
     *                  type="integer"
     *            
     *             ),
     *             @OA\Property(
     *                 property="temperature",
     *                 type="number",
     *                 format="float"
     *             ),
     *             @OA\Property(
     *                 property="humidity",
     *                 type="number",
     *                 format="float"
     *             ),
     *             @OA\Property(
     *                 property="wind_speed",
     *                 type="number",
     *                 format="float"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             ),
     *             example={
     *                 "id": 1,
     *                 "location_id": 123,
     *                 "temperature": 25.5,
     *                 "humidity": 80.0,
     *                 "wind_speed": 10.0,
     *                 "description": "Sunny"
     *             }
     *         )
     *     )
     * )
     * 
     * @OA\Put(
     *     path="/update/{id}",
     *     summary="Update a specific weather condition",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the weather condition",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="temperature",
     *                 description="Temperature in Celsius",
     *                 type="number"
     *             ),
     *             @OA\Property(
     *                 property="humidity",
     *                 description="Humidity percentage",
     *                 type="number"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Weather condition updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 description="Response message",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Weather condition not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 description="Error message",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     * 
     * 
     * @OA\Post(
     *     path="/",
     *     tags={"Weather"},
     *     summary="Post new weather conditions data",
     *     @OA\RequestBody(
     *         description="JSON Payload containing weather data",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="location_id", type="integer"),
     *             @OA\Property(property="temperature", type="number", format="float"),
     *             @OA\Property(property="humidity", type="number", format="float"),
     *             @OA\Property(property="wind_speed", type="number", format="float"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     *
     * @OA\Delete(
     *     path="/delete/{id}",
     *     tags={"Weather"},
     *     summary="Delete a weather condition data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of weather condition to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Weather Condition deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     */



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

    // function for forecast

    public function indexForecast()
    {
        $forecast = Forecast::all();

        return response()->json([
            'status' => 'success',
            'data' => $forecast
        ]);
    }

    public function showForecast($id)
    {
        $forecast = Forecast::find($id);


        if ($forecast) {
            return response()->json([
                'status' => 'success',
                'data' => $forecast
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'forecast not found for the given forecast ID'
            ], 404);
        }
    }

    public function storeForecast(Request $request)
    {
        $request->validate([
            'location_id' => 'required|integer|exists:locations,id',
            'date' => 'required|date',
            'min_temperature' => 'required|numeric',
            'max_temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'description' => 'required|string'
        ]);


        $forecast = Forecast::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Forecast data created successfully',
            'data' => $forecast,
        ]);
    }

    public function updateForecast(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'required|integer|exists:locations,id',
            'date' => 'required|date',
            'min_temperature' => 'required|numeric',
            'max_temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'wind_speed' => 'required|numeric',
            'description' => 'required|string'
        ]);

        $forecast = Forecast::find($id);

        if (!$forecast) {
            return response()->json([
                'status' => 'error',
                'message' => 'forecast data not found'
            ], 404);
        }

        $forecast->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'forecast data updated successfully',
            'data' => $forecast
        ]);
    }

    public function destroyForecast($id)
    {
        $forecast = Forecast::find($id);
        if (!$forecast) {
            return response()->json(['message' => 'Forecast data not found'], 404);
        }

        $forecast->delete();

        // return response()->json(null, Response::HTTP_NO_CONTENT);

        return response()->json([
            'status' => 'success',
            'message' => 'Forecast data deleted successfully'
        ]);
    }
}
