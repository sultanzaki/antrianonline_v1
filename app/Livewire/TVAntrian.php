<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RiwayatAntrian;
use App\Models\Valas;
use App\Models\CounterRate;
use App\Models\LoketPelayanan;
use App\Models\Playlist;
use App\Models\Video;
use App\Models\LPS;
use Carbon\Carbon;
use App\Models\KontrolFitur;
use App\Models\Image;
use App\Models\KontrolInformasi;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use App\Models\Currency;
use App\Models\Layanan;
use App\Models\NomorAntrian;

class TVAntrian extends Component
{

    public $queueData = [];

    public $valasTable1 = [];
    public $valasTable2 = [];

    public $currencyTable1 = [];
    public $currencyTable2 = [];

    public $counterRates = [];

    public $playlistId;
    public $playlist;
    public $videos;

    public $time;
    public $date;

    public $lastUpdate;

    public $images;

    public $feature;

    public $pesan;

    public $layananAntrian1 = [];
    public $layananAntrian2 = [];

    public $nomorAntrian;
    public $namaPelayanan;

    protected $listeners = [
        'refreshCounterRates' => 'refreshCounterRates',
        'refreshVideo' => 'refreshVideo',
        'refreshImage' => 'refreshImage',
        'refreshFeature' => 'isFeatureActive',
        'refreshPesan' => 'refreshPesan',
        'refreshQueue' => 'refreshQueue',
        'refreshValasTV' => 'refreshValas',
    ];

    public function updateDateTime()
    {
        $now = Carbon::now('Asia/Jakarta');
        $this->date = $now->format('F d, Y');
        $this->time = $now->format('H:i');
    }

    public function updateLastUpdateTime()
    {
        $latestValas = Valas::latest('updated_at')->first();

        if ($latestValas) {
            $this->lastUpdate = Carbon::parse($latestValas->updated_at)
                ->setTimezone('Asia/Jakarta')
                ->format('d F Y H:i:s');
        } else {
            $this->lastUpdate = 'No data available';
        }
    }

    public function refreshQueue()
    {
        $this->queueData = RiwayatAntrian::select('nama_loket', 'nomor_antrian')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('nama_loket')
            ->mapWithKeys(function ($item) {
                return [$item['nama_loket'] => $item['nomor_antrian']];
            })
            ->toArray();
    }

    public function refreshValas()
    {
        \Log::info("refreshValas received in TVAntrian");
        $valas = Valas::all()->toArray();
        $totalValas = count($valas);
        $halfCount = ceil($totalValas / 2);

        $this->valasTable1 = array_slice($valas, 0, $halfCount);
        $this->valasTable2 = array_slice($valas, $halfCount);
        \Log::info("Valas refreshed in TVAntrian");
    }

    public function refreshCurrency()
    {
        $currencies = Currency::orderBy('id', 'desc')->get()->toArray();
        $totalCurrencies = count($currencies);
        $halfCount = ceil($totalCurrencies / 2);
    
        $this->currencyTable1 = array_slice($currencies, 0, $halfCount);
        $this->currencyTable2 = array_slice($currencies, $halfCount);
    }

    public function refreshCounterRates()
    {
        $counterRates = CounterRate::all();
        $this->counterRates = $counterRates->groupBy('tiering')->all();
    }

    public function refreshVideo()
    {
        $this->playlist = Playlist::findOrFail($this->playlistId);
        $this->videos = Video::join('playlist_video', 'videos.id', '=', 'playlist_video.video_id')
                             ->where('playlist_video.playlist_id', $this->playlistId)
                             ->orderBy('playlist_video.position')
                             ->get(['videos.*', 'playlist_video.position']);
    }

    public function refreshImage()
    {
        $this->images = Image::all();
    }

    public function isFeatureActive($feature)
    {
        $this->feature = KontrolFitur::where('kode_fitur', $feature)->first();
        return $this->feature && $this->feature->status === 'aktif';
    }

    #[On('refreshPesan')]
    public function refreshPesan()
    {
        $kontrol_informasi = KontrolInformasi::first();
        $this->pesan = $kontrol_informasi->pesan;
    }

    public function refreshLayanan1()
    {
        $this->layananAntrian1 = NomorAntrian::where('id_pelayanan', 1)
            ->where('status', '1')
            ->latest('created_at')
            ->first();
    }

    public function refreshLayanan2()
    {
        $this->layananAntrian2 = NomorAntrian::where('id_pelayanan', 2)
            ->where('status', '1')
            ->latest('created_at')
            ->first();
    }

    public function mount()
    {
        $this->refreshQueue();
        $this->refreshValas();
        $this->refreshCounterRates();
        $this->refreshVideo();
        $this->updateDateTime();
        $this->updateLastUpdateTime();
        $this->refreshImage();
        $this->refreshPesan();
        $this->refreshCurrency();
        $this->refreshLayanan1();
        $this->refreshLayanan2();

        $this->playlistId = '1';
        $this->playlist = Playlist::findOrFail($this->playlistId);
        $this->videos = Video::join('playlist_video', 'videos.id', '=', 'playlist_video.video_id')
                             ->where('playlist_video.playlist_id', $this->playlistId)
                             ->orderBy('playlist_video.position')
                             ->get(['videos.*', 'playlist_video.position']);
    }

    public function render()
    {
        $counterRates = CounterRate::all()->groupBy('tiering');
        $loketPelayanan = LoketPelayanan::all();
        $lps = LPS::all();
        $images = Image::all();

        return view('livewire.t-v-antrian', [
            'valasTable1' => $this->valasTable1,
            'valasTable2' => $this->valasTable2,
            'counterRates' => $counterRates,
            'loketPelayanan' => $loketPelayanan,
            'lps' => $lps,
            'images' => $this->images,
            'currencyTable1' => $this->currencyTable1,
            'currencyTable2' => $this->currencyTable2,
            'layananAntrian1' => $this->layananAntrian1,
            'layananAntrian2' => $this->layananAntrian2,
        ]);
    }
}
