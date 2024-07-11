<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pack $pack)
    {
        //
        return $pack->stickers;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pack $pack)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'image' => File::image()->max('10MB'),
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // store image
        $path = $request->file('image')->store('stickers');
        $request->merge(['image' => $path]);
    
        $sticker = $pack->stickers()->create($validator->validated());

        return response()->json([
            'message' => 'Sticker created successfully',
            'sticker' => $sticker
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pack $pack, Sticker $sticker)
    {
        if ($request->has('download')) {
            return response()->download(Storage::path($sticker->image));
        }

        return $sticker;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack, Sticker $sticker)
    {
        //
        $sticker->delete();
        return response()->json(['message' => 'Sticker deleted successfully.']);
    }
}
