<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\History;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home() {
        return view('landing', [
            'title' => "Home Page",
            'rooms' => Room::orderBy('total_booking', 'desc')->limit(10)->get()
        ]);
    }

    public function list_room(Request $request) {
        // filter pencarian
        // jika saya memiliki category dan name room ketika category nya value sama dengan "" maka cari berdasarkan nama saja ketika namanya kosong maka cari berdasarkan category nya saja ketika nama dan category diisi maka tampilkan semua filter ketika kedua nya value kosong atau tidak ada query maka tidak ada filter tampilkan semua data

        $name_room = $request->query('search');
        $category = $request->query('category');
        $category_name = Category::findOrFail($category)->name;
        $rooms = Room::query() // ketika tidak ada filter maka tampilkan semua
                // ketika $name_room tidak sama dengan kosong dan tidak sama dengan null dan tidak sma dengan string kosong maka lakukan pencarian berdasarkan name_room
                ->when(!empty($name_room) && $name_room != null && $name_room != '', function($query) use ($name_room) {
                    return $query->where('room', 'like', "%$name_room%");
                })
                ->when(!empty($category) && $category != null && $category != '', function($query) use ($category) {
                    return $query->where('category_id', $category);
                })
                ->orderByDesc('total_booking')->get();

        // Menentukan pesan jika data tidak ditemukan
        $message = null;

        if ($rooms->isEmpty()) {
            if (!empty($name_room) && empty($category)) {
                $message = "Data Room '$name_room' Tidak Ada";
            } elseif (empty($name_room) && !empty($category)) {
                $message = "Data Room Dengan Category '$category' Tidak Ada";
            } elseif (!empty($name_room) && !empty($category)) {
                $message = "Data Search Room '$name_room' dengan Category '$category_name' Tidak Ada";
            }
        }

        return view('list_room', [
            'title' => "List Room Page",
            'rooms' => $rooms,
            'categories' => Category::all(),
            'message' => $message,
            'nameroom' => $name_room
        ]);
    }

    public function dashboard() {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('dashboard/dashboard', [
            'title' => "Home",
            'bookings' => $bookings,
            'bookingCount' => Booking::count(),
            'userCount' => User::where('role_id', 1)->count(),
        ]);
    }

    public function myProfile() {
        return view('dashboard/myProfile/profile', [
            'title' => "My Profile",
            'user' => User::find(auth()->user()->id),
        ]);
    }

    public function myProfilePost(Request $request) {
        $id = auth()->user()->id;
        $user = User::find($id);
        $validData = $request->validate([
            'hapusProfile' => 'required',
            'name' => 'required|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
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

        return redirect()->route('dashboard')->with('succes', 'User data successfully updated');
    
    }

    public function bookingRoom() {
        return view('cooming', [
            'title' => "Booking Room",
        ]);
    }

    public function history() {
        return view('dashboard/histories/index', [
            'title' => "History Bookings",
            'histories' => History::all()
        ]);
    }
}