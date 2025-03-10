<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard/users/index', [
            'title' => "Users Data",
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/users/create', [
            'title' => "Create User Data",
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validData = $request->validate([
            'name' => "required|max:100",
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8|confirmed',
            'role_id' => "required",
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000000', // nullable yaitu mengizinkan tetap lolos meskipun tidak diisi
        ]); 
        
        $file = 'default.jpg';
        //jika ada request file maka dia upload
        if($request->hasFile("profile")) {
            $file = $request->file('profile');
            $file = $this->uploudImage($file, 'image/profile');
        } 

        $validData['profile'] = $file;

        User::create($validData); 

        return redirect()->route('users.index')->with('succes', 'User data successfully created');
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
        return view('dashboard/users/edit', [
            'title' => "Edit Users Data",
            'roles' => Role::all(),
            'user' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validData = $request->validate([
            'hapusProfile' => 'required',
            'name' => 'required|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000000', // nullable yaitu mengizinkan tetap lolos meskipun tidak diisi
        ]); 

        $profileLama = "";
        // Jika ia menghapus profile
        if($validData['hapusProfile'] == "true") {
            $imageLama = $user->profile != "default.jpg" ? $user->profile : false; // jika image lama nya bukan default.jpg setting $imageLama menjadi imagenya

            if($imageLama != false) {
                $imageLama = 'image/profile/' . $imageLama;
                $this->deleteImage($imageLama);
            }
            $profileLama = 'default.jpg';
        } else {
            $profileLama = $user->profile;
        }

        // cek apakah ada file yang di uploud jika tidak ada maka set image lama
        if($request->hasFile('profile')) {
            $imageLama = $user->profile != "default.jpg" ? $user->profile : false; 
            $fileImage = $request->file('profile');

            // hapus dan uploud ketika imagenya lamanya bukan default.jpg
            if($imageLama != false) {
                $profile = $this->uploudImage($fileImage, 'image/profile/', $imageLama);
            } else {
                $profile = $this->uploudImage($fileImage, 'image/profile/');
            }
        } else {
            $profile = $profileLama;
        }

        $validData['profile'] = $profile;

        $user->update($validData);

        return redirect()->route('users.index')->with('succes', 'User data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $imageLama = $user->profile != "default.jpg" ? $user->profile : false; 

        if($imageLama != false) {
            $imageLama = 'image/profile/' . $imageLama;
            $this->deleteImage($imageLama);
        }
        $user->delete();
        return redirect()->route('users.index')->with('succes', 'User data successfully deleted');
    }
}
