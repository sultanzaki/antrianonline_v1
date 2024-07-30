<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\NomorAntrian;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\WaktuPelayanan;

class TouchsreenAntrian extends Component
{
   
    public function sendData($data)
    {
        Log::info("Emitting event with data: " . $data); // Log untuk memverifikasi
        $this->dispatch('send-serial-data', ['data' => $data]);
        Log::info("Event emitted"); // Log untuk memverifikasi
    }

    public function render()
    {
        $layanan = Layanan::where('status', 'aktif')->get();
        
        return view('livewire.touchsreen-antrian', [
            'layanan' => $layanan,
        ]);
    }

    public function generateNomorAntrian($id_pelayanan)
    {
        $lastQueue = NomorAntrian::where('id_pelayanan', $id_pelayanan)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('nomor_antrian', 'desc')
            ->first();

        $kode_layanan = Layanan::find($id_pelayanan)->kode_pelayanan;

        if (!$lastQueue) {
            $nomor_antrian = $kode_layanan . '001';
        } else {
            $last_number = intval(substr($lastQueue->nomor_antrian, -3));
            $new_number = $last_number + 1;
            $formatted_number = str_pad($new_number, 3, '0', STR_PAD_LEFT);
            $nomor_antrian = $kode_layanan . $formatted_number;
        }

        // create new queue
        $newQueue = NomorAntrian::create([
            'id_pelayanan' => $id_pelayanan,
            'nomor_antrian' => $nomor_antrian,
            'status' => 0,
        ]);

        // create new service time
        WaktuPelayanan::create([
            'id_antrian' => $newQueue->id_antrian,
            'waktu_mulai' => Carbon::now(),
        ]);

        $this->dispatch('send-serial-data', ['nomor_antrian' => $nomor_antrian]);
        
    }
}
