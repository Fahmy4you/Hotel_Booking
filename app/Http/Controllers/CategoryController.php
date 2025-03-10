<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard/categories/index', [
            'title' => "Category Rooms Data",
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/categories/create', [
            'title' => "Create Category Rooms Data"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validData = $request->validate([
            'name' => ['required', 'max:100', Rule::unique('categories', 'name')],
            'class_category' => ['required', 'max:10', 
                Rule::unique('categories', 'class_category')->where(function ($query) use ($request) {
                    return $query->whereRaw('LOWER(class_category) = ?', [strtolower($request->class_category)]);
                }),
            ],
            'features' => 'required|array|min:1',
            'features.*.name' => 'required|string',
            'features.*.information' => 'required|string',
        ]);


        $validData['class_category'] = strtoupper($validData['class_category']);

        $categoryCreate = Category::create($validData);

        foreach ($request->features as $feature) {
            $categoryCreate->fasilitas()->create([
                'feature' => $feature['name'],
                'information' => $feature['information'],
            ]);
        }

        return redirect()->route('categories.index')->with('succes', 'Room category data successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard/categories/edit', [
            'title' => "Edit Category Rooms Data",
            'category' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        // dd($request);
        
        $filteredFeatures = array_filter($request->features, function ($feature) {
            return isset($feature['feature'], $feature['information']) && 
            trim($feature['feature']) !== '' && 
            trim($feature['information']) !== '';
        });
        
        
        // Pastikan array index tidak hilang (penting untuk looping Laravel)
        $request->merge(['features' => array_values($filteredFeatures)]);
        

        $validData = $request->validate([
            'name' => ['required', 'max:100', 'unique:categories,name,'.$category->id],
            'class_category' => ['required', 'max:10', 
                Rule::unique('categories')->where(function ($query) use ($request, $category) {
                    return $query
                        ->whereRaw('LOWER(class_category) = ?', [strtolower($request->class_category)])
                        ->where('id', '!=', $category->id); // Abaikan ID sendiri
                }),
            ],
            'features' => 'required|array|min:1',
            'features.*.id' => 'nullable|exists:fasilitas,id',
            'features.*.feature' => 'required|string|max:255',
            'features.*.information' => 'required|string|max:500',
        ]);

        $validData['class_category'] = strtoupper($validData['class_category']);

        // Ambil Id feature
        $newFeatureId = collect($validData['features'])->pluck('id')->filter()->toArray();

        // Hapus fitur lama yang tidak ada didalam request
        $category->fasilitas()->whereNotIn('id', $newFeatureId)->delete();

        foreach ($validData['features'] as $feature) {
            if (!empty($feature['id'])) {
                // Jika fitur sudah ada, update
                $category->fasilitas()->where('id', $feature['id'])->update([
                    'feature' => $feature['feature'],
                    'information' => $feature['information'],
                ]);
            } else {
                // Jika fitur baru, buat fitur baru
                $category->fasilitas()->create([
                    'feature' => $feature['feature'],
                    'information' => $feature['information'],
                ]);
            }
        }

        $category->update($validData);

        return redirect()->route('categories.index')->with('succes', 'Room category data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Category::find($id)->delete();

        // return redirect()->route('categories.index')->with('succes', 'Room category data successfully deleted');

        try {
            $category = Category::findOrFail($id);
    
            // Cek apakah kategori masih digunakan di tabel room lain
            if ($category->room()->exists()) {
                return redirect()->route('categories.index')->with('error', 'Room category cannot be deleted because it is still associated with rooms.');
            }
            
            $category->fasilitas()->delete();
            $category->delete();
    
            return redirect()->route('categories.index')->with('succes', 'Room category successfully deleted.');
        } catch (\Exception $error) {
            return redirect()->route('categories.index')->with('error', 'An error occurred while deleting the category.');
        }
    }
}