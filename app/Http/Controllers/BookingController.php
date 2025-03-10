<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Booking;
use App\Models\History;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::orderBy('start_date', 'asc')->get();
        return view('dashboard/bookings/index', [
            'title' => "Bookings Data Room",
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $bookings = Booking::where('room_id', $id)
            ->orderBy('start_date', 'asc') // Urutkan dari tanggal paling awal
            ->get();; // ambil data booking berdasarkan kamar yang ia mau booking
        $room = Room::find($id);

        return view('dashboard/bookings/create', [
            'title' => "Bookings Room",
            'bookings' => $bookings,
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));

        // Ambil harga per malam (misalnya dari tabel Room)
        $room = Room::findOrFail($id);
        $price_per_night = $room->price; // Pastikan kolom harga ada di tabel rooms

        // Hitung jumlah malam
        $days = $start_date->diffInDays($end_date);

        // Hitung total harga
        $total_price = $days * $price_per_night;
    
        // Cek apakah ada booking di rentang tanggal tersebut
        $conflict = Booking::where('room_id', $id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                      ->orWhereBetween('end_date', [$start_date, $end_date])
                      ->orWhere(function ($query) use ($start_date, $end_date) {
                          $query->where('start_date', '<=', $start_date)
                                ->where('end_date', '>=', $end_date);
                      });
            })
            ->exists();
    
        if ($conflict) {
            return back()->withErrors([
                'start_date' => 'The selected dates are already booked. Please choose a different date range.',
                'end_date' => 'The selected dates are already booked. Please choose a different date range.',
            ])->withInput();
        }
    
        // Jika tidak ada konflik, simpan data
        $booking = Booking::insert([
            'room_id' => $id,
            'user_id' => auth()->user()->id, // atau sesuai sumber user_id Anda
            'price' => $total_price,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
        
        History::create([
            'visitor_name' => auth()->user()->name,
            'room_name' => $room->room,
            'price' => $total_price,
            'status' => 'booking',
        ]);
        
        // tambahkan total booking ketika user mem booking kamar tersebut
        $total_booking = $room->total_booking + 1;
        $room->update([ 'total_booking' => $total_booking ]);

        return redirect()->route('bookings.edit', $id)->with('succes', 'Bookings data successfully added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $booking = Booking::find($id);
        History::create([
            'visitor_name' => $booking->user->name,
            'room_name' => $booking->room->room,
            'price' => $booking->price,
            'status' => $request->status,
        ]);
        
        // tambahkan total booking ketika user mem booking kamar tersebut
        $room = Room::find($booking->room->id);
        $total_booking = $room->total_booking + 1;
        $room->update([ 'total_booking' => $total_booking ]);

        $booking->delete();

        if($request->status == "cancel admin") {
            return redirect()->route('bookings.index', $id)->with('succes', 'Bookings data successfully deleted');
        } else {
            return redirect()->route('dashboard', $id)->with('succes', 'Bookings data successfully canceled');
        }


    }

    public function getprice(Request $request) {
        if(isset($request->startDate) && isset($request->endDate) && isset($request->roomId)) {
            $start_date = Carbon::parse($request->startDate);
            $end_date = Carbon::parse($request->endDate);
            $room_id = $request->roomId;

            // Ambil harga per malam (misalnya dari tabel Room)
            $room = Room::findOrFail($room_id);
            $price_per_night = $room->price; // Pastikan kolom harga ada di tabel rooms

            // Hitung jumlah malam
            $days = $start_date->diffInDays($end_date);

            // Hitung total harga
            $total_price = $days * $price_per_night;

            return $total_price;

        }
    }

    public function cetakReservasi($id) {
        $booking = Booking::find($id);
        return view('dashboard/bookings/cetakReservasi', [
            'title' => "Cetak Reservasi Data Room",
            'booking' => $booking
        ]);
    }
}
