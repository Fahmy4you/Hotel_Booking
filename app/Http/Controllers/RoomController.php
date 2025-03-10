<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard/rooms/index', [
            'title' => "Rooms Data",
            'rooms' => Room::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/rooms/create', [
            'title' => "Create Rooms Data",
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'room' => 'required|max:100|unique:rooms',
            'price' => 'required|integer|min:3',
            'category_id' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3000000',
        ]);

        $file = $request->file('image');
        $file = $this->uploudImage($file, 'image/kamar');

        $validData['image'] = $file;
        $validData['is_booked'] = 0;

        Room::create($validData);

        return redirect()->route('rooms.index')->with('succes', 'Room data successfully created');
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
        return view('dashboard/rooms/edit', [
            'title' => "Edit Rooms Data",
            'categories' => Category::all(),
            'room' => Room::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validData = $request->validate([
            'room' => 'required|max:100|unique:rooms,room,'. $id ,
            'price' => 'required|integer|min:3',
            'category_id' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png,pdf|max:3000000',
        ]);

        $dataLama = Room::find($id);
        $imageLama = $dataLama->image;
        $file = $imageLama;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file = $this->uploudImage($file, 'image/kamar/', $imageLama);
        }
        $validData['image'] = $file;
        $validData['is_booked'] = $dataLama->is_booked;


        Room::find($id)->update($validData);

        return redirect()->route('rooms.index')->with('succes', 'Room data successfully updated');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataRoom = Room::find($id);
        $imageLama = 'image/kamar/' . $dataRoom->image;
        $this->deleteImage($imageLama);
        $dataRoom->delete();
        return redirect()->route('rooms.index')->with('succes', 'Room data successfully deleted');
    }
}
