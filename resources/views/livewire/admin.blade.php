<div>
    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   placeholder="Search properties...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="sortField"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                <option value="country">Country</option>
                <option value="num_bedrooms">Bedrooms</option>
                <option value="num_bathrooms">Bathrooms</option>
                <option value="type">Type</option>
                <option value="p_title">Prop Title</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="sortAsc"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <button wire:click="deleteProperties" @if(!$selected)disabled="disabled" @endif class="block appearance-none
            w-full @if($selected) bg-red-700 @else cursor-not-allowed bg-red-300 @endif border border-gray-200 text-white py-3 px-4 pr-8
            rounded leading-tight focus:outline-none">Bulk Delete
            </button>
        </div>
    </div>

    @if($property->isNotEmpty())
        <table class="table-auto w-full mb-6">
            <thead>
            <tr>
                <th class="px-1 py-2"></th>
                <th class="px-1 py-2">ID</th>
                <th class="px-1 py-2">Country</th>
                <th class="px-1 py-2">County</th>
                <th class="px-1 py-2">Town</th>
                <th class="px-1 py-2">Description</th>
                <th class="px-1 py-2">Address</th>
                <th class="px-1 py-2">Bedrooms</th>
                <th class="px-1 py-2">Bathrooms</th>
                <th class="px-1 py-2">Price</th>
                <th class="px-1 py-2">Type</th>
                <th class="px-1 py-2">Prop Title</th>
                <th class="px-1 py-2">Image</th>
                <th class="px-1 py-2"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($property as $item)
                <tr>
                    <td class="border px-1 py-2">
                        <input wire:model="selected" value="{{ $item->help_id }}" class="cursor-pointer"
                               type="checkbox">
                    </td>
                    <td class="border px-1 py-2">{{ $item->help_id }}</td>
                    <td class="border px-1 py-2">{{ $item->country }}</td>
                    <td class="border px-1 py-2">{{ $item->county }}</td>
                    <td class="border px-1 py-2">{{ $item->town }}</td>
                    <td class="border px-1 py-2">{{ \Illuminate\Support\Str::limit($item->description, 50, $end='...')  }}</td>
                    <td class="border px-1 py-2">{{ $item->address }}</td>
                    <td class="border px-1 py-2">{{ $item->num_bedrooms }}</td>
                    <td class="border px-1 py-2">{{ $item->num_bathrooms }}</td>
                    <td class="border px-1 py-2">{{ $item->price }}</td>
                    <td class="border px-1 py-2">{{ ucfirst($item->type) }}</td>
                    <td class="border px-1 py-2">{{ $item->p_title }}</td>
                    <td class="border px-1 py-2"><img
                            src="{{ \App\Models\Property::thumbnailUrl($item->image_thumbnail) }}" class=""/></td>
                    <td class="border px-1 py-2">
                        <button wire:click="updateProperty('{{ $item->help_id }}')" class="block appearance-none w-full
                        bg-green-700 border border-gray-200 text-white py-3 px-4 rounded leading-tight focus:outline-none">
                            Update
                        </button>
                        <button wire:click="deleteProperties('{{ $item->help_id }}')" wire:model="selected"
                                class="block appearance-none w-full bg-red-700 border border-gray-200 text-white py-3
                                px-4 rounded leading-tight focus:outline-none">Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $property->links() !!}
    @else
        <p class="text-center">Whoops! No properties were found 🙁</p>
    @endif
</div>
