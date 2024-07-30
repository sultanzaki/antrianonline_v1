<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NomorAntrian;
use App\Models\PelayananAktif;
use App\Models\LoketPelayanan;
use App\Models\UserLoketPelayanan;
use App\Models\RiwayatAntrian;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use App\LiveWire\TouchsreenAntrian;
use App\Events\PanggilEvent;
use App\Models\WaktuPelayanan;
use Carbon\Carbon;

class Loket extends Component
{
    public $sisaAntrian;
    public $antrianDilayani;

    public function nextQueue($id_loket)
    {
        try {
            // Check if the Loket exists
            $loket = LoketPelayanan::where('id_loket', $id_loket)->first();
            if (!$loket) {
                session()->flash('error', 'Loket tidak ditemukan');
            }

            // Get the next queue number
            $queue = NomorAntrian::where('id_pelayanan', $loket->id_pelayanan)
                ->where('status', 0)
                ->orderBy('id_antrian', 'asc')
                ->first();

            if ($queue) {
                $queue->status = 1;
                $queue->save();

                // Check if there is already an active service
                $pelayananAktif = PelayananAktif::where('id_loket', $id_loket)->first();
                
                if ($pelayananAktif) {
                    session()->flash('message', 'Masih ada antrian yang sedang dilayani');
                } else {
                    PelayananAktif::create([
                        'id_antrian' => $queue->id_antrian,
                        'id_loket' => $id_loket,
                    ]);
                    
                    RiwayatAntrian::create([
                        'nama_loket' => $loket->nama_loket,
                        'nomor_antrian' => $queue->nomor_antrian,
                        'nama_layanan' => $loket->id_pelayanan,
                    ]);

                    // update waktu selesai pelayanan and total waktu where id_antrian = $queue->id_antrian
                    $waktuPelayanan = WaktuPelayanan::where('id_antrian', $queue->id_antrian)
                        ->first(); 
                    if ($waktuPelayanan) {
                        $waktuPelayanan->waktu_selesai = Carbon::now();
                        $waktuMulai = Carbon::parse($waktuPelayanan->waktu_mulai); // Convert waktu_mulai to Carbon instance
                        $waktuPelayanan->total_waktu = $waktuMulai->diffInSeconds(Carbon::now());
                        $waktuPelayanan->save();
                    }

                    // add id_loket
                    $dataSerial = $queue->nomor_antrian . $id_loket;

                    try {
                        event(new PanggilEvent($dataSerial));
                    } catch (\Exception $e) {
                        \Log::error('Error triggering PanggilEvent: ' . $e->getMessage());
                        session()->flash('error', 'Terjadi kesalahan saat memicu event: ' . $e->getMessage());
                        return; // atau lakukan penanganan error yang sesuai
                    }

                    session()->flash('message', 'Antrian berhasil dipanggil');
                }
            } else {
                session()->flash('error', 'Tidak ada antrian yang tersedia');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan, silakan coba lagi');
        }
    }


    public function finishQueue($id_loket)
    {
        try {
            $pelayananAktif = PelayananAktif::where('id_loket', $id_loket)
                ->first();

            if ($pelayananAktif) {
                $pelayananAktif->delete();
                session()->flash('message', 'Antrian selesai dilayani');
            } else {
                session()->flash('error', 'Tidak ada antrian yang sedang dilayani');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan, silakan coba lagi');
        }
    }

    public function repeatQueue($id_loket)
    {
        $pelayananAktif = PelayananAktif::where('id_loket', $id_loket)
            ->first();

        if (!$pelayananAktif) {
            session()->flash('error', 'Tidak ada antrian yang sedang dilayani');
            return;
        }

        session()->flash('message', 'Antrian dipanggil ulang');
    }

    public function refreshSisaAntrian()
    {
        $userLoketPelayanan = UserLoketPelayanan::where('id_user', auth()->user()->id)
            ->with('loketPelayanan')  // Eager load the loketPelayanan relationship
            ->first();

        if ($userLoketPelayanan && $userLoketPelayanan->loketPelayanan) {
            $idPelayanan = $userLoketPelayanan->loketPelayanan->id_pelayanan;

            $sisaAntrian = NomorAntrian::where('id_pelayanan', $idPelayanan)
                ->where('status', 0)
                ->count();

            $this->sisaAntrian = $sisaAntrian;
        } else {
            $this->sisaAntrian = 0;  // or handle this case as appropriate
        }
    }

    public function refreshAntrianDilayani()
    {
        $userLoketPelayanan = UserLoketPelayanan::where('id_user', auth()->user()->id)
            ->with('loketPelayanan')  // Eager load the loketPelayanan relationship
            ->first();

        if ($userLoketPelayanan && $userLoketPelayanan->loketPelayanan) {
            $idPelayanan = $userLoketPelayanan->loketPelayanan->id_pelayanan;

            $antrianDilayani = PelayananAktif::where('id_loket', $userLoketPelayanan->loketPelayanan->id_loket)
                ->with('nomorAntrian')
                ->first();

            if (!$antrianDilayani) {
                $this->antrianDilayani = "-";
                return;
            }

            return $this->antrianDilayani = $antrianDilayani->nomorAntrian->nomor_antrian;
        } else {
            $this->antrianDilayani = "-";  // or handle this case as appropriate
        }
    }

    public function mount()
    {
        $this->refreshSisaAntrian();
        $this->refreshAntrianDilayani();
    }

    public function render()
    {
        $loket = UserLoketPelayanan::where('id_user', auth()->user()->id)
            ->with('loketPelayanan')
            ->first();
        
        return view('livewire.loket' , [
            'loket' => $loket,
            'sisaAntrian' => $this->sisaAntrian,
            'antrianDilayani' => $this->antrianDilayani,
        ]);
    }
}
