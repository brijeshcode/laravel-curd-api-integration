<?php

namespace App\Http\Controllers\Admin\Properties;

use App\Http\Controllers\Controller;
use App\Jobs\RefrehPropertiesApi;
use App\Models\Admin\Properties\Property;
use App\Models\Admin\Properties\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Image;
use Inertia\Inertia;

class PropertyController extends Controller
{
    protected $files = [
        'index' => 'Admin/Properties/Index',
        'api' => 'Admin/Properties/IndexApi',
        'create' => 'Admin/Properties/Create'
    ];

    protected $routes = [
        'index' => 'admin.properties.index',
    ];

    public function index(Request $request)
    {
        $propertyTypes = PropertyType::orderBy('title')->get(['id', 'title']);
        $properties = $this->getProperties($request);
        return Inertia::render($this->files['index'], compact('properties' , 'propertyTypes'));
    }

    public function apiProperties(Request $request)
    {
        $propertyTypes = PropertyType::orderBy('title')->get(['id', 'title']);
        $properties = $this->getProperties($request, true);
        return Inertia::render($this->files['api'], compact('properties' , 'propertyTypes' ));
    }

    public function create()
    {
        $propertyTypes = PropertyType::orderBy('title')->get(['id', 'title']);
        return Inertia::render($this->files['create'] , compact('propertyTypes'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'property_type_id' => 'required|integer',
                'county' => 'required|string',
                'country' => 'required|string',
                'town' => 'required|string',
                'description' => 'required|string',
                'address' => 'required|string',
                'postcode' => 'required|string',
                'image_full' => 'required|image',
                'num_bedrooms' => 'required|integer',
                'num_bathrooms' => 'required|integer',
                'price' => 'required|integer|min:0',
                'for' => 'required|string|in:sale,rent'
            ]
        );
        $requestData = $request->all();
        if ($request->hasFile('image_full')) {
            $data = $this->uploadAndResize($request->file('image_full'));
            $requestData['image_full'] = $data['image_full'];
            $requestData['image_thumbnail'] = $data['image_thumbnail'];
        }
        $requestData['is_created_by_api'] = false;
        $property = Property::create($requestData);
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Added Successfully !!');
    }

    public function show($id)
    {
    }

    public function edit(Property $property)
    {
        $propertyTypes = PropertyType::orderBy('title')->get(['id', 'title']);
        return Inertia::render($this->files['create'], compact('property', 'propertyTypes'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate(
            [
                'property_type_id' => 'required|integer',
                'county' => 'required|string',
                'country' => 'required|string',
                'town' => 'required|string',
                'description' => 'required|string',
                'address' => 'required|string',
                'postcode' => 'required|string',
                'num_bedrooms' => 'required|integer',
                'num_bathrooms' => 'required|integer',
                'price' => 'required|integer|min:0',
                'for' => 'required|string|in:sale,rent'
            ]
        );
        $requestData = $request->all();
        if ($request->hasFile('image_full')) {
            $data = $this->uploadAndResize($request->file('image_full'));
            $requestData['image_full'] = $data['image_full'];
            $requestData['image_thumbnail'] = $data['image_thumbnail'];
        }else{
            unset($requestData['image_full']);
        }
        $property->update($requestData);
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Updated Successfully !!');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Deleted Successfully !!');
    }

    public function uploadAndResize($image)
    {
        $imgName = time().'.'.$image->extension();
        $requestData = array();
        $requestData['image_full'] = $image->storeAs('images', $imgName, 'public');

        $requestData['image_thumbnail'] = '';

        $destinationPath =  public_path('thumbnails');
        File::ensureDirectoryExists($destinationPath);

        $imgName = '100x100-' . $imgName;

        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imgName);

        $requestData['image_thumbnail'] = 'thumbnails/'. $imgName ;
        return $requestData;
    }

    public function getApiProperties()
    {

        $apiKey = "3NLTTNlXsi6rBWl7nYGluOdkl2htFHug";
        $baseUrl = "https://trial.craig.mtcserver15.com/";
        $apiNode = "api/properties";
        $parameters = array();
        $parameters['api_key'] = $apiKey;
        // $parameters['page[number]'] = 2;
        $parameters['page[size]'] = 100;

        $url = $baseUrl . $apiNode;
        $first = Http::get($url, $parameters);

        if ($first->successful()) {

            $lastPage = $first->json()['last_page'];
            for ($i=1; $i <= $lastPage ; $i++) {
                RefrehPropertiesApi::dispatch($i);
            }
            return ;
        }
    }

    public function getProperties(Request $request , $fromApiDb = false)
    {
        return Property::with('propertyType')->where('is_created_by_api', $fromApiDb)
            ->when($request->county, function ($query, $county){
                $query->where('county', 'like', '%'. $county . '%');
            })
            ->when($request->country, function ($query, $country){
                $query->where('country', 'like', '%'. $country . '%');
            })
            ->when($request->town, function ($query, $town){
                $query->where('town','like', '%'. $town . '%');
            })
            ->when($request->description, function ($query, $description){
                $query->where('description', 'like', '%'. $description . '%');
            })
            ->when($request->address, function ($query, $address){
                $query->where('address', 'like', '%'. $address . '%');
            })
            ->when($request->postcode, function ($query, $postcode){
                $query->where('postcode', 'like', '%'. $postcode . '%');
            })
            ->when($request->num_bedrooms, function ($query, $num_bedrooms){
                $query->where('num_bedrooms',  $num_bedrooms );
            })
            ->when($request->num_bathrooms, function ($query, $num_bathrooms){
                $query->where('num_bathrooms', $num_bathrooms);
            })
            ->when($request->price, function ($query, $price){
                $query->where('price', $price);
            })
            ->when($request->for, function ($query, $for){
                $query->where('for', $for);
            })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    }

}
