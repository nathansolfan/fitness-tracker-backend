<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $workouts = Workout::where('user_id', $request->user()->id)->get();
        return response()->json($workouts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string|max:255',
            'sets' => 'required|integer|min:1',
            'reps' => 'required|integer|min:1',
            'weight' => 'nullable|numeric|min:0',
            'category' => 'required|in:strength,cardio',
        ]);

        $workout = Workout::create([
            'user_id' => $request->user()->id,
            'exercise' => $request->exercise,
            'sets' => $request->sets,
            'reps' => $request->reps,
            'weight' => $request->weight,
            'category' => $request->category,
        ]);

        return response()->json($workout, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        // Ensure the workout belongs to the authenticated user
        if ($workout->user_id !== request()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($workout);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        // Ensure the workout belongs to the authenticated user
        if ($workout->user_id !== $request->user()->id) {
            # code...
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
