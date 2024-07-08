<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\PackCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pack::all();
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @bodyParam name string required The name of the pack
     * @bodyParam categories array required The categories **id** of the pack
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'categories' => 'required|array|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pack = Pack::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
        ]);

        // add categories
        $categories = collect($request->categories)->map(fn($item) => ['category_id' => $item]);
        try {
            $pack->categories()->createMany($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to add categories to pack',
            ]);
        }
        
        return response()->json([
            'message' => 'Pack created successfully',
            'pack' => $pack
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pack $pack)
    {
        return $pack->load('categories.category');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pack $pack)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:32',
            'categories' => 'array|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pack->update($request->all());
        return response()->json([
            'message' => 'Pack updated successfully',
            'pack' => $pack
        ], 200);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack)
    {
        $pack->delete();
        return response()->json(['message' => 'Pack deleted successfully.']);
    }
}
