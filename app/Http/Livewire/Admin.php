<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 30;
    public $selected = [];
    public $sortField = 'country';
    public $sortAsc = true;


    public function updateProperty($id = '')
    {
        if (empty($id))
            return '';

        return redirect()->to('/update-property/' . $id);
    }


    public function deleteProperties($id = '')
    {
        if (empty($id))
            Property::destroy($this->selected);
        else
            Property::destroy($id);
    }


    public function render()
    {
        return view('livewire.admin', [
            'property' => Property::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage)
        ]);
    }
}
