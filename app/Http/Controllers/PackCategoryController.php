<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\PackCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pack $pack)
    {
        //
        return $pack->categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pack $pack)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pack->categories()->create($request->all());

        return response()->json(['message' => 'Pack Category added successfully.'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack, PackCategory $packCategory)
    {
        //
        $packCategory->delete();
        return response()->json(['message' => 'PackCategory deleted successfully.']);
    }
}
