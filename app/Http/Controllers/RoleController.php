<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard/roles/index', [
            'title' => "Roles Data",
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard/roles/create', [
            'title' => "Create Role Data"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|max:100|unique:roles',
        ]);

        Role::create($validData);

        return redirect()->route('roles.index')->with('succes', 'Role data successfully created');
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
        return view('dashboard/roles/edit', [
            'title' => "Edit Role Data",
            'role' => Role::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validData = $request->validate([
            'name' => 'required|max:100|unique:roles,name,'. $id,
        ]);

        Role::find($id)->update($validData);

        return redirect()->route('roles.index')->with('succes', 'Role data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Role::find($id)->delete();

        // return redirect()->route('roles.index')->with('succes', 'Role data successfully deleted');

        try {
            $role = Role::findOrFail($id);
    
            // Cek apakah Role masih digunakan di tabel room lain
            if ($role->user()->exists()) {
                return redirect()->route('roles.index')->with('error', 'User role cannot be deleted because it is still associated with users.');
            }
    
            $role->delete();
    
            return redirect()->route('roles.index')->with('success', 'Role users successfully deleted.');
        } catch (\Exception $error) {
            return redirect()->route('roles.index')->with('error', 'An error occurred while deleting the role.');
        }
    }
}
