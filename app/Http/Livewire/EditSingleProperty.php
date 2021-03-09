<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSingleProperty extends Component
{
    use WithFileUploads;

    public $property;
    public $help_id;
    public $property_type_id;
    public $country;
    public $county;
    public $town;
    public $description;
    public $address;
    public $image_full;
    public $image_thumbnail;
    public $latitude;
    public $longitude;
    public $num_bedrooms;
    public $num_bathrooms;
    public $price;
    public $type;
    public $p_title;
    public $p_description;
    public $message;
    public $success;
    public $change_image = false;

    protected $rules = [
        'county' => 'required|max:100',
        'country' => 'required|max:100',
        'town' => 'required|max:50',
        'description' => 'required|max:500',
        'address' => 'required|max:200',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'num_bedrooms' => 'required|integer|max:100',
        'num_bathrooms' => 'required|integer|max:100',
        'price' => 'required|integer|max:100000000',
        'p_title' => 'required|max:50',
        'p_description' => 'required|max:500'
    ];

    public function mount($id)
    {

        $property = Property::where('id', $id)->first();

        $this->help_id = $property->help_id;
        $this->property_type_id = $property->property_type_id;
        $this->country = $property->country;
        $this->county = $property->county;
        $this->town = $property->town;
        $this->description = $property->description;
        $this->address = $property->address;
        $this->image_full = '';//$property->image_full;
        $this->image_thumbnail = $property->image_thumbnail;
        $this->latitude = $property->latitude;
        $this->longitude = $property->longitude;
        $this->num_bedrooms = $property->num_bedrooms;
        $this->num_bathrooms = $property->num_bathrooms;
        $this->price = $property->price;
        $this->type = $property->type;
        $this->p_title = $property->p_title;
        $this->p_description = $property->p_description;
    }

    public function editProperty()
    {
        $this->dispatchBrowserEvent('submit-scroll:scroll-to', [
            'query' => '.scroll-to',
        ]);

        if (!empty($this->image_full))
            $rules['image_full'] = 'sometimes|required|image|max:1024';

        $this->validate($this->rules);


        if (!empty($this->image_full)) {
            $image_name = $this->image_full->store('/', 'properties');
            Image::make(storage_path('app/properties/' . $image_name))
                ->resize(100, 100)
                ->save(storage_path('app/properties/_' . $image_name));

            $this->image_thumbnail = '_' . $image_name;
        }


        $prop = Property::where('id', $this->help_id)->first();

        $prop->country = $this->country;
        $prop->county = $this->county;
        $prop->town = $this->town;
        $prop->description = $this->description;
        $prop->address = $this->address;

        if (!empty($this->image_full)) {
            $prop->image_full = $image_name;
            $prop->image_thumbnail = '_' . $image_name;
        }

        $prop->latitude = $this->latitude;
        $prop->longitude = $this->longitude;
        $prop->num_bedrooms = $this->num_bedrooms;
        $prop->num_bathrooms = $this->num_bathrooms;
        $prop->price = $this->price;
        $prop->type = $this->type;
        $prop->updated_at = date('Y-m-d H:i:s');
        $prop->p_updated_at = date('Y-m-d H:i:s');
        $prop->p_title = $this->p_title;
        $prop->p_description = $this->p_description;

        $prop->save();

        $this->change_image = false;
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
        return view('livewire.edit-single-property');
    }
}
