<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViewsController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $viewsValidation = Validator::make($data,[
            'estate_id' => ['required','exists:estates,id'],
            'guest_id' => ['required'],
        ]);

        if($viewsValidation->fails()){
            return response()->json([
                'success'=>false,
                'errors'=>$viewsValidation->errors(),
            ]);
        }

        $newViews = View::create($data);
        return response()->json([
            'success'=>true,
        ]);
}
}
