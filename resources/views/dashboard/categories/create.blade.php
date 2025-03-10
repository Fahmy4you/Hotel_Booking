@extends('layouts/dashboard/main')

@section('container')

<h1 class="text-2xl font-bold text-gray-800 mb-4">Create Data Category Rooms</h1>
    <form action="{{ route('categories.store') }}" method="POST" class="w-[90%]">
        @csrf
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="name" class="block mb-1 text-gray-700 font-medium">Name Category</label>
        <input type="text" id="name" name="name" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Category name..." value="{{ old('name') }}"/>
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="class_category" class="block mb-1 text-gray-700 font-medium">Class Category</label>
        <input type="text" id="class_category" name="class_category" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Category class..." value="{{ old('class_category') }}"/>
        @error('class_category')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
          <p class="text-gray-800 text-sm mt-1">Category data will be sorted alphabetically, for example AB, then class A is part 2</p>
      </div>

      <div class="my-8">
        <h4 class="mb-5 text-xl font-semibold">Feature Rooms</h4>

        <div id="feature-container">
          @php $oldFeatures = old('features', [['name' => '', 'information' => '']]); @endphp
          
          @foreach($oldFeatures as $index => $feature)
            <div class="mb-3 flex flex-row gap-x-4">
              <div>
                <label for="features[{{ $index }}][name]" class="block mb-1 text-gray-700 font-medium">Feature</label>
                <input type="text" id="features[{{ $index }}][name]" name="features[{{ $index }}][name]" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Feature..." value="{{ old('name') }}"/>
                @error("features.$index.name")
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
      
              <div>
                <label for="features[{{ $index }}][information]" class="block mb-1 text-gray-700 font-medium">Information</label>
                <input type="text" id="features[{{ $index }}][information]" name="features[{{ $index }}][information]" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Information..." value="{{ old("features.$index.information", $feature['information']) }}"/>
                @error("features.$index.information")
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              {{-- <button type="button" class="remove-feature bg-red-500 text-white px-4 rounded-md">X</button> --}}
            </div>

            @endforeach
        </div>
          
          <button id="add-feature" type="button" class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Add Feature</button>
      </div>

      <!-- Tombol Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Add Data
      </button>
    </form>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
    let featureContainer = document.getElementById("feature-container");
    let addFeatureButton = document.getElementById("add-feature");

    // Fungsi untuk menambah input baru
    addFeatureButton.addEventListener("click", function () {
        let index = featureContainer.children.length;
        let featureGroup = document.createElement("div");
        featureGroup.classList.add("mb-3", "flex", "flex-row", "gap-x-4", "feature-group");
        featureGroup.innerHTML = `
            <div>
                <label class="block mb-1 text-gray-700 font-medium">Feature</label>
                <input type="text" name="features[${index}][name]" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Feature..."/>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">Information</label>
                <input type="text" name="features[${index}][information]" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Information..."/>
            </div>

            <button type="button" class="remove-feature bg-red-500 text-white px-4 rounded-md">X</button>
        `;
        featureContainer.appendChild(featureGroup);
    });

    // Fungsi untuk menghapus input
    featureContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-feature")) {
            event.target.parentElement.remove();
        }
    });

});
    </script>
@endsection