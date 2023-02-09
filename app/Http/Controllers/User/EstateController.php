<?php

namespace App\Http\Controllers\User;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstateRequest;
use App\Models\Estate;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Index */
        $estates = Estate::all()->where('user_id',Auth::user()->id);
        return view('user.estates.index',compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ['casa','appartamento','villa','attico', 'tenuta','mansarda','castello','stanza privata','masseria','baita'];
        $services = Service::all();
        return view('user.estates.create', compact('types','services'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstateRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Helpers::generateSlug($form_data['title']);
        // dd($form_data);
        $path = Storage::put('cover',$request->cover_img);
        $form_data['cover_img'] = $path;
        // if($request->hasFile('cover_img')){
            
        // }
        $form_data['user_id'] = Auth::user()->id;

        if($request->has('is_visible')){
            $form_data['is_visible'] = 1;
        } else{
            $form_data['is_visible'] = 0;

        }
        $new_estate = Estate::create($form_data);
        if($request->has('services')){
            $new_estate->services()->attach($form_data['services']);
        }

        return redirect()->route('user.estates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Estate $estate)
    {
        return view('user.estates.show',compact('estate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
