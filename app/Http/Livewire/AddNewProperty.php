<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNewProperty extends Component
{
    use WithFileUploads;

    public $country;
    public $county;
    public $town;
    public $description;
    public $address;
    public $image_full;
    public $latitude;
    public $longitude;
    public $num_bedrooms;
    public $num_bathrooms;
    public $price;
    public $type = 'sale';
    public $p_title;
    public $p_description;
    public $message;
    public $success;

    protected $rules = [
        'county' => 'required|max:100',
        'country' => 'required|max:100',
        'town' => 'required|max:50',
        'description' => 'required|max:500',
        'address' => 'required|max:200',
        'image_full' => 'required|image|max:1024',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'num_bedrooms' => 'required|integer|max:100',
        'num_bathrooms' => 'required|integer|max:100',
        'price' => 'required|integer|max:100000000',
        'p_title' => 'required|max:50',
        'p_description' => 'required|max:500'
    ];

    public function addProperty()
    {
        $this->dispatchBrowserEvent('submit-scroll:scroll-to', [
            'query' => '.scroll-to',
        ]);

        $this->validate($this->rules);

        $image_name = $this->image_full->store('/', 'properties');
        Image::make(storage_path('app/properties/'.$image_name))
            ->resize(100, 100)
            ->save(storage_path('app/properties/_'.$image_name));

        $uuid = Str::uuid()->toString();

        Property::create([
            'id' => $uuid,
            'property_type_id' => 1,
            'help_id' => $uuid,
            'county' => $this->county,
            'country' => $this->country,
            'town' => $this->town,
            'description' => $this->description,
            'address' => $this->address,
            'image_full' => $image_name,
            'image_thumbnail' => '_' . $image_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'num_bedrooms' => (int)$this->num_bedrooms,
            'num_bathrooms' => (int)$this->num_bathrooms,
            'price' => (int)$this->price,
            'type' => $this->type,
            'updated_at' => date('Y-m-d H:i:s'),
            'p_updated_at' => date('Y-m-d H:i:s'),
            'p_title' => $this->p_title,
            'p_description' => $this->p_description
        ]);

        $this->reset(['county', 'country', 'town', 'description', 'address', 'image_full', 'latitude', 'longitude',
            'num_bedrooms', 'num_bathrooms', 'price', 'p_title', 'p_description']);

        $this->success = "Your property has been added successfully!";
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function closeSuccess()
    {
        $this->success = '';
    }

    public function render()
    {
        return view('livewire.add-new-property');
    }
}
