<?php

namespace App\Http\Controllers\User;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use App\Models\Address;
use App\Models\Estate;
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
        // dd(json_decode($response->getBody(), true));

        $form_data['estate_id'] = $new_estate->id;
        $form_data['long'] =  $tom_result['results'][0]['position']['lon'];
        $form_data['lat'] =  $tom_result['results'][0]['position']['lat'];
        // dd($form_data['long']);
        $new_address = Address::create($form_data);

        

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
        Storage::delete($estate->cover_img);
        $path = Storage::put('cover', $request->cover_img);
        $form_data['cover_img'] = $path;

        $form_data['user_id'] = Auth::user()->id;

        if ($request->has('is_visible')) {
            $form_data['is_visible'] = 1;
        } else {
            $form_data['is_visible'] = 0;
        }

        $estate->update($form_data);
        if ($request->has('services')) {
            $estate->services()->sync($form_data['services']);
        } else {
            $estate->services()->detach();
        }

        $address_data = $request->validate([
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'country' => ['required', 'max:255'],
            'street_code' => ['required', 'max:35'],
        ]);

        $endpoint = "https://api.tomtom.com/search/2/geocode/" . $address_data['street'] . "," . $address_data['street_code'] . "," . $address_data['city'] .".json?key=e3ENGW4vH2FBakpfksCRV16OTNwyZh0e";
        $client = new \GuzzleHttp\Client(["verify"=>false ]);

        $response = $client->request('GET', $endpoint,);
        $tom_result = json_decode($response->getBody(), true);
        // dd(json_decode($response->getBody(), true));

        // $form_data['estate_id'] = $new_estate->id;
        $address_data['long'] =  $tom_result['results'][0]['position']['lon'];
        $address_data['lat'] =  $tom_result['results'][0]['position']['lat'];
        // dd($form_data['long']);
        // $new_address = Address::create($form_data);

        $estate->address()->update($address_data);


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
        Storage::delete($estate->cover_img);
        $estate->services()->detach();
        $estate->delete();
        return redirect()->route('user.estates.index')->with('message', "$estate->title è stato eliminato con successo");
    }
}
