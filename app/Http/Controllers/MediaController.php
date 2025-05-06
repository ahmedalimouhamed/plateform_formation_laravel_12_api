<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Media payload', $request->all());

        
        $path = $request->file('file')->store('media');
        $model = app($request['mediable_type'])::findOrFail($request['mediable_id']);

        return $model->media()->create([
            'path' => $path,
        ]);
        
    }
}
