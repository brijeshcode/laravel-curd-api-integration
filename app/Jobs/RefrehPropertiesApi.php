<?php

namespace App\Jobs;

use App\Models\Admin\Properties\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RefrehPropertiesApi implements ShouldQueue
{
    private $perPageJobs;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($perPageJobs)
    {
        //
        $this->perPageJobs = $perPageJobs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $apiKey = "3NLTTNlXsi6rBWl7nYGluOdkl2htFHug";
        $baseUrl = "https://trial.craig.mtcserver15.com/";
        $apiNode = "api/properties";
        $parameters = array();
        $parameters['api_key'] = $apiKey;

        $url = $baseUrl . $apiNode;
        $parameters['page[size]'] = 100;

        $properties = array();
        $parameters['page[number]'] = $this->perPageJobs;
        $response = Http::get($url, $parameters);
        $propertiesResponse = $response->json();

        foreach ($propertiesResponse['data'] as $key => $property) {
            $property['is_created_by_api'] = true;
            $property['for'] = $property['type'];
            $properties[] = [
                'updated_at' => $property['updated_at'],
                'property_type_id' => $property['property_type_id'],
                'county' => $property['county'],
                'country' => $property['country'],
                'town' => $property['town'],
                'price' => $property['price'],
                'description' => $property['description'],
                'address' => $property['address'],
                'image_full' => $property['image_full'],
                'image_thumbnail' => $property['image_thumbnail'],
                'latitude' => $property['latitude'],
                'longitude' => $property['longitude'],
                'num_bedrooms' => $property['num_bedrooms'],
                'num_bathrooms' => $property['num_bathrooms'],
                'for' => $property['type'],
                'created_at' => $property['created_at'],
                'uuid' => $property['uuid'],
                'is_created_by_api' => true
            ];
        }

        Property::upsert(
            $properties,
            ['uuid'],[ 'property_type_id', 'county','country', 'town', 'description', 'address', 'image_full', 'image_thumbnail', 'latitude',  'longitude', 'num_bedrooms', 'num_bathrooms', 'price', 'for']
        );


    }
}
