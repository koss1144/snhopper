<div class=" container add-property">
    @if($success)
        <div wire:click="closeSuccess"
             class="scroll-to w-3/6 mx-auto relative flex flex-col sm:flex-row sm:items-center bg-green-200 shadow rounded-md mb-6
            py-5 pl-6 pr-8 sm:pr-6 ">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                <div class="text-green-500">
                    <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-sm font-medium ml-3">Success.</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">{{$success}}</div>
            <div
                class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-800 hover:text-gray-800 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="addProperty" id="addProperty">
        <div class="w-3/6 mx-auto">
            <label for="country">Country</label>
            <input wire:model.lazy="country" type="text" id="country"
                   class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">
            @error('country')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="county">County</label>
            <input wire:model.lazy="county" type="text" id="county" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('county')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="town">Town</label>
            <input wire:model.lazy="town" type="text" id="town" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('town')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div x-data="{focused: false}" class="w-3/6 mx-auto">
            <label for="description">Image</label>
            <input type="file" wire:model="image_full" id="proimage" class="sr-only">

            <label :class="{'outline-none p-8': focused}" @focus="focused = true" @blur="focused = false" for="proimage"
                   class="cursor-pointer block appearance-none bg-gray-700 border
            border-gray-200 text-white p-4 rounded leading-tight text-center">Upload Image
             @if($image_full) ( 1 image added )@endif </label>

            @error('image_full')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="description">General description</label>
            <textarea wire:model.lazy="description" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500" id="exampleFormControlTextarea1" rows="3"></textarea>

            @error('description')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="address">Address</label>
            <input wire:model.lazy="address" type="text" id="address" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('address')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>


        <div class="w-3/6 mx-auto">
            <label for="latitude">Latitude</label>
            <input wire:model.lazy="latitude" type="text" id="latitude" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('latitude')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="longitude">Longitude</label>
            <input wire:model.lazy="longitude" type="text" id="longitude" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('longitude')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="num_bedrooms">Bedrooms</label>
            <input wire:model.lazy="num_bedrooms" type="text" id="num_bedrooms" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('num_bedrooms')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="num_bathrooms">Bathrooms</label>
            <input wire:model.lazy="num_bathrooms" type="text" id="num_bathrooms" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('num_bathrooms')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="price">Price</label>
            <input wire:model.lazy="price" type="text" id="price" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('price')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto mb-4">
            <label for="type">Type</label>

            <div class="w-1/6 relative mx-1">
                <select wire:model.lazy="type" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500" id="grid-state">
                    <option value="sale" selected>Sale</option>
                    <option value="rent">Rent</option>
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="w-3/6 mx-auto">
            <label for="p_title">Property title</label>
            <input wire:model.lazy="p_title" type="text" id="p_title" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500">

            @error('p_title')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto">
            <label for="p_description">Property description</label>
            <textarea wire:model.lazy="p_description" class="appearance-none block w-full bg-gray-200 text-gray-700 border
                   border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                   focus:bg-white focus:border-gray-500" id="exampleFormControlTextarea1" rows="3"></textarea>

            @error('p_description')
            <p class="scroll-to text-red-500 text-sm mb-6">{{$message}}</p>
            @enderror
        </div>

        <div class="w-3/6 mx-auto mt-5">
            <button type="submit" class="block appearance-none w-full bg-green-700 border
            border-gray-200 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none">Submit
            </button>
        </div>
    </form>
</div>
