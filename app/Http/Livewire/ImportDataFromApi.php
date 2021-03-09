<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class ImportDataFromApi extends Component
{
    public $import_completed = false;
    public $curpage = 0;
    public $imported = 0;
    public $updated_items = 0;

    private $last_import = '';
    private $nullable_date = '';
    private $api_url = 'https://trial.craig.mtcserver15.com/api/properties';

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->setImportCompleted();
        $this->nullable_date = new Carbon('2000-01-01 00:00:00');

        $this->last_import = DB::table('helper')
            ->select('last_update')
            ->where('id', '=', 1)
            ->first();

        if (!empty($this->last_import))
            $this->last_import = $this->last_import->last_update;
        else
            $this->last_import = '2000-01-01 00:00:00';
    }

    public function importDataFromApi($property = [])
    {
        if (empty($property))
            return '';

        $this->imported = $this->imported + 1;

        $property_type = $property['property_type'];
        $uuid = $property['uuid'];

        Property::create([
            'id' => $uuid,
            'property_type_id' => $property['property_type_id'],
            'help_id' => $uuid,
            'county' => $property['county'],
            'country' => $property['country'],
            'town' => $property['town'],
            'description' => $property['description'],
            'address' => $property['address'],
            'image_full' => $property['image_full'],
            'image_thumbnail' => $property['image_thumbnail'],
            'latitude' => $property['latitude'],
            'longitude' => $property['longitude'],
            'num_bedrooms' => (int)$property['num_bedrooms'],
            'num_bathrooms' => (int)$property['num_bathrooms'],
            'price' => (int)$property['price'],
            'type' => $property['type'],
            'updated_at' => $this->nullableDate($property['updated_at']),
            'p_updated_at' => $this->nullableDate($property_type['updated_at']),
            'p_title' => $property_type['title'],
            'p_description' => $property_type['description'],
        ]);
    }

    public function updateDataFromApi($property = [])
    {
        if (empty($property))
            return '';

        if (strtotime($this->last_import) > strtotime($property['updated_at']))
            return '';

        $this->updated_items = $this->updated_items + 1;
        $property_type = $property['property_type'];

        $import_arg = [
            'property_type_id' => $property['property_type_id'],
            'county' => $property['county'],
            'country' => $property['country'],
            'town' => $property['town'],
            'description' => $property['description'],
            'address' => $property['address'],
            'latitude' => $property['latitude'],
            'longitude' => $property['longitude'],
            'num_bedrooms' => (int)$property['num_bedrooms'],
            'num_bathrooms' => (int)$property['num_bathrooms'],
            'price' => (int)$property['price'],
            'type' => $property['type'],
            'updated_at' => $this->nullableDate($property['updated_at']),
            'p_updated_at' => $this->nullableDate($property_type['updated_at']),
            'p_title' => $property_type['title'],
            'p_description' => $property_type['description'],
        ];

        if (Str::contains($property['image_full'], 'http')) {
            $import_arg['image_full'] = $property['image_full'];
            $import_arg['image_thumbnail'] = $property['image_thumbnail'];
        }


        Property::where('id', $property['uuid'])->update($import_arg);
    }

    public function handleDataFromApi()
    {
        $url_suffix = '?page[number]=';

        $this->on_load = false;
        $this->updateLastImportTime();

        $touch_api = Http::get($this->api_url)->json();
        $last_page_number = $touch_api['last_page'];

        for ($i = 1; $i < 50; $i++) {
            $this->curpage = $i;

            $response = Http::get($this->api_url . $url_suffix . $i);

            $api_page = $response->json();

            if ($response->status() === 200) {
                foreach ($api_page['data'] as $property) {

                    if (!empty($this->import_completed))
                        $this->updateDataFromApi($property);
                    else
                        $this->importDataFromApi($property);

                }
                sleep(1);
            }
        }

        $this->setImportCompleted();
        return '';
    }

    private function updateLastImportTime()
    {
        DB::table('helper')
            ->where('id', 1)
            ->updateOrInsert(
                ['last_update' => date('Y-m-d H:i:s')]
            );
    }

    private function nullableDate($date)
    {
        if (empty($date))
            return $this->nullable_date;

        return $date;
    }

    private function setImportCompleted()
    {
        if (!empty(DB::table('properties')->first()))
            $this->import_completed = true;
    }

    public function render()
    {
        return view('livewire.import-data-from-api');
    }
}
