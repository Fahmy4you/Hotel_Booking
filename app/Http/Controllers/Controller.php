<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\History;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    public function __construct() {
        $expiredBookings = Booking::where('end_date', '<', Carbon::now())->get();

        foreach ($expiredBookings as $booking) {
            History::create([
                'visitor_name' => $booking->user->name,
                'room_name' => $booking->room->room,
                'price' => $booking->price,
                'status' => 'expired',
            ]);
            
            $booking->delete();
        }
    }

    public function deleteImage($fileOld) {
        if($fileOld && Storage::exists($fileOld)) {
            Storage::delete($fileOld);
        }
    }
    public function uploudImage($file, $pathSave, $oldImage = null) {
        if($oldImage != null) {
            $fileOld = $pathSave . $oldImage;
            $this->deleteImage($fileOld);
        }

        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs($pathSave, $fileName);

        return $fileName;
    }
}
