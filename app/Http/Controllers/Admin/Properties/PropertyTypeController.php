<?php

namespace App\Http\Controllers\Admin\Properties;

use App\Http\Controllers\Controller;
use App\Models\Admin\Properties\PropertyType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyTypeController extends Controller
{
    protected $files = [
        'index' => 'Admin/Properties/Type/Index',
        'create' => 'Admin/Properties/Type/Create'
    ];

    protected $routes = [
        'index' => 'admin.property_types.index',
    ];

    public function index()
    {
        $types = PropertyType::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return Inertia::render($this->files['index'], compact('types' ));
    }

    public function create()
    {
        return Inertia::render($this->files['create']);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'string'
            ]
        );
         PropertyType::create($request->all());
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Type Added Successfully !!');
    }

    public function show($id)
    {
    }

    public function edit(PropertyType $propertyType)
    {
        return Inertia::render($this->files['create'], compact('propertyType'));
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'string'
            ]
        );
        $propertyType->update($request->all());
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Type Updated Successfully !!');
    }

    public function destroy(PropertyType $propertyType)
    {
        dd('not allowed');
        $propertyType->delete();
        return redirect(route($this->routes['index']))->with('type', 'success')->with('message', 'Property Type Deleted Successfully !!');
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
}
