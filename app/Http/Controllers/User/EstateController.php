<?php

namespace App\Http\Controllers\User;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use App\Models\Address;
use App\Models\Estate;
use App\Models\Image;
use App\Models\Service;
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
        $estates = Estate::all()->where('user_id', Auth::user()->id);
        return view('user.estates.index', compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ['casa', 'appartamento', 'villa', 'attico', 'tenuta', 'mansarda', 'castello', 'stanza privata', 'masseria', 'baita'];
        $services = Service::all();
        return view('user.estates.create', compact('types', 'services'));
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

        // $street = $form_data['street'];
        // $street_code = $form_data['street_code'];
        // $city = $form_data['city'];

        $form_data['slug'] = Helpers::generateSlug($form_data['title']);
        $path = Storage::put('cover', $request->cover_img);
        $form_data['cover_img'] = $path;
        $form_data['user_id'] = Auth::user()->id;

        if ($request->has('is_visible')) {
            $form_data['is_visible'] = 1;
        } else {
            $form_data['is_visible'] = 0;
        }
        $new_estate = Estate::create($form_data);
        if ($request->has('services')) {
            $new_estate->services()->attach($form_data['services']);
        }

        $endpoint = "https://api.tomtom.com/search/2/geocode/" . $form_data['street'] . "," . $form_data['street_code'] . "," . $form_data['city'] .".json?key=e3ENGW4vH2FBakpfksCRV16OTNwyZh0e";
        $client = new \GuzzleHttp\Client(["verify"=>false ]);

        $response = $client->request('GET', $endpoint,);
        $tom_result = json_decode($response->getBody(), true);
        if ($tom_result["summary"]["totalResults"] == 1) {
            // $form_data['estate_id'] = $new_estate->id;
            $form_data['estate_id'] = $new_estate->id;
            $form_data['long'] =  $tom_result['results'][0]['position']['lon'];
            $form_data['lat'] =  $tom_result['results'][0]['position']['lat'];
            $new_address = Address::create($form_data);
            // $new_estate->address()->update($address_data);
        } else {
            $new_estate->update(["is_visible" => 0]);
            return redirect()->route('user.estates.index')->with("wrong_address", "L'indirizzo di $new_estate->title sembra essere sbagliato, per rendere l'annuncio visibile inserisci un indirizzo valido");
        }


        $form_data['long'] =  $tom_result['results'][0]['position']['lon'];
        $form_data['lat'] =  $tom_result['results'][0]['position']['lat'];
        $new_address = Address::create($form_data);

        if($request->hasFile('images')){
            foreach($request->file('images') as $img){
                $img_path = Storage::put('images', $img);
                $form_data['path'] = $img_path;
                $new_img = Image::create($form_data);
            }
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
        if (Auth::user()->id === $estate->user_id) {
            return view('user.estates.show', compact('estate'));
        } else {
            return view('not-auth');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $estate)
    {
        $types = ['casa', 'appartamento', 'villa', 'attico', 'tenuta', 'mansarda', 'castello', 'stanza privata', 'masseria', 'baita'];
        $services = Service::all();
        return view('user.estates.edit', compact('types', 'services', 'estate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstateRequest $request, Estate $estate)
    {

        $form_data = $request->validated();
        $form_data['slug'] = Helpers::generateSlug($form_data['title']);

        /* Add cover_img file to public storage */
        if ($request->hasFile("cover_img")) {
            if($estate->cover_img) Storage::delete($estate->cover_img);
            $path = Storage::put('cover', $request->cover_img);
            $form_data['cover_img'] = $path;
        }

        $form_data['user_id'] = Auth::user()->id;

        /* Set is_visible */
        if ($request->has('is_visible')) {
            $form_data['is_visible'] = 1;
        } else {
            $form_data['is_visible'] = 0;
        }

        $estate->update($form_data);

        /* Add Services to estates */
        if ($request->has('services')) {
            $estate->services()->sync($form_data['services']);
        } else {
            $estate->services()->detach();
        }

        /* Do a validation to addresses */
        $address_data = $request->validate([
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'country' => ['required', 'max:255'],
            'street_code' => ['required', 'max:35'],
        ]);

        /* Call Tom Tom Api */
        $endpoint = "https://api.tomtom.com/search/2/geocode/" . $address_data['street'] . "," . $address_data['street_code'] . "," . $address_data['city'] .".json?key=e3ENGW4vH2FBakpfksCRV16OTNwyZh0e";
        $client = new \GuzzleHttp\Client(["verify"=>false ]);

        $response = $client->request('GET', $endpoint,);
        $tom_result = json_decode($response->getBody(), true);
        
        /* If the address is correct add it to database, else redirect to index with error */
        if ($tom_result["summary"]["totalResults"] == 1) {
            
            $address_data['long'] =  $tom_result['results'][0]['position']['lon'];
            $address_data['lat'] =  $tom_result['results'][0]['position']['lat'];

            /* If there's another address, update it */
            if (isset($estate->address->street)) {
                $estate->address()->update($address_data);
            } else{
                $address_data["estate_id"] = $estate->id;
                $new_address = Address::create($address_data);
            }

        } else {
            $estate->update(["is_visible" => 0]);
            return redirect()->route('user.estates.index')->with("wrong_address", "L'indirizzo di $estate->title sembra essere sbagliato, l'ultima modifica dell'indirizzo non è stata salvata");
        }

        /* If there are files */
        if($request->hasFile('images')){

            /* Validate them */
            $img_validator = $request->validate([
                'images.*' => ['nullable', 'max:550', 'image'],
                'images' => ['max:4'],
            ]);

            $img_validator["estate_id"] = $estate->id;

            $images = Image::all()->where('estate_id', $estate->id)->toArray();

            
            if(count($images) >= 1){
                $New_start_index = 0;
                $images = array_combine(range($New_start_index, count($images) + ($New_start_index - 1)), array_values($images));
            }

            $path = [];
            
            foreach ($request->file('images') as $key => $img) {

                if(isset($images[$key]['path'])){
                    Storage::delete($images[$key]['path']);
                }

                $img_path = Storage::put('images', $img);
                array_push($path, $img_path);
                $img_validator['path'][$key] = $path[$key];

                if(isset($images[$key]['path'])){
                    Image::where("id", $images[$key]['id'])->update(["path" => $img_validator['path'][$key]]);
                } else {
                    Image::create([
                        'path' => $img_validator['path'][$key],
                        'estate_id' => $estate->id
                    ]);
                }
            }
        }


        return redirect()->route('user.estates.index')->with('message', "$estate->title è stato aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estate $estate)
    {
        $images = Image::all()->where('estate_id', $estate->id)->toArray();
        
        if(count($images) > 0){
            foreach($images as $image){
                Storage::delete($image['path']);
            };
        }

        Storage::delete($estate->cover_img);
        $estate->services()->detach();
        $estate->delete();
        return redirect()->route('user.estates.index')->with('message', "$estate->title è stato eliminato con successo");
    }
}
