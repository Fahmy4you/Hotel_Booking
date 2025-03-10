@extends('layouts/dashboard/main')

@section('container')

<h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Data Category Rooms</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="w-[90%]">
        @method('put')
        @csrf
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="name" class="block mb-1 text-gray-700 font-medium">Name Category</label>
        <input type="text" id="name" name="name" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Category name..." value="{{ old('name', $category->name) }}"/>
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="class_category" class="block mb-1 text-gray-700 font-medium">Class Category</label>
        <input type="text" id="class_category" name="class_category" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Category class..." value="{{ old('class_category', $category->class_category) }}"/>
        @error('class_category')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
          <p class="text-gray-800 text-sm mt-1">Category data will be sorted alphabetically, for example AB, then class A is part 2</p>
        </div>


        <div class="my-8">
          <h4 class="mb-5 text-xl font-semibold">Feature Rooms</h4>
      
          <div id="feature-container">
              @foreach(old('features', $category->fasilitas ?? []) as $index => $feature)
                  <div class="feature-item mb-3 flex flex-row gap-x-4">
                      <input type="hidden" name="features[{{ $index }}][id]" value="{{ $feature['id'] ?? '' }}">
                      
                      <div>
                          <label class="block mb-1 text-gray-700 font-medium">Feature</label>
                          <input type="text" name="features[{{ $index }}][feature]"
                                 class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500"
                                 placeholder="Feature..."
                                 value="{{ old("features.$index.feature", $feature['feature'] ?? '') }}" required/>
                          @error("features.$index.feature")
                              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                          @enderror
                      </div>
      
                      <div>
                          <label class="block mb-1 text-gray-700 font-medium">Information</label>
                          <input type="text" name="features[{{ $index }}][information]"
                                 class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500"
                                 placeholder="Information..."
                                 value="{{ old("features.$index.information", $feature['information'] ?? '') }}" required/>
                          @error("features.$index.information")
                              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                          @enderror
                      </div>
      
                      <button type="button" class="remove-feature bg-red-500 text-white px-4 rounded-md">X</button>
                  </div>
              @endforeach
          </div>
      
          <button id="add-feature" type="button" class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Add Feature</button>
      </div>
      

      <!-- Tombol Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Edit Data
      </button>
    </form>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
          const featureContainer = document.getElementById("feature-container");
          const addFeatureBtn = document.getElementById("add-feature");
      
          let featureIndex = document.querySelectorAll(".feature-item").length;
      
          // Tambah fitur baru
          addFeatureBtn.addEventListener("click", function () {
              const newFeature = document.createElement("div");
              newFeature.classList.add("feature-item", "mb-3", "flex", "flex-row", "gap-x-4");
              newFeature.innerHTML = `
                  <input type="hidden" name="features[${featureIndex}][id]" value="">
                  <div>
                      <label class="block mb-1 text-gray-700 font-medium">Feature</label>
                      <input type="text" name="features[${featureIndex}][feature]"
                             class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500"
                             placeholder="Feature..." required>
                  </div>
                  <div>
                      <label class="block mb-1 text-gray-700 font-medium">Information</label>
                      <input type="text" name="features[${featureIndex}][information]"
                             class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500"
                             placeholder="Information..." required>
                  </div>
                  <button type="button" class="remove-feature bg-red-500 text-white px-4 rounded-md">X</button>
              `;
      
              featureContainer.appendChild(newFeature);
              featureIndex++;
          });
      
          // Hapus fitur saat tombol Remove diklik
          featureContainer.addEventListener("click", function (event) {
              if (event.target.classList.contains("remove-feature")) {
                  event.target.parentElement.remove();
              }
          });
      });
      </script>
      
@endsection