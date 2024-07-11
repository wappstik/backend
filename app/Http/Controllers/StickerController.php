<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pack $pack)
    {
        return $pack->stickers();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pack $pack)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Pack $pack, Sticker $sticker)
    {
        return $sticker;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pack $pack, Sticker $sticker)
    {
        $sticker->delete();
        return response()->json(['message' => 'Sticker deleted successfully.']);
    }
}
