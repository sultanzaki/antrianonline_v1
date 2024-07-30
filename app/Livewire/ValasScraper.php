<?php

namespace App\Livewire;

use Livewire\Component;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\Currency;


class ValasScraper extends Component
{
    public $message = '';

    public function scrape()
    {
        try {
            $browser = new HttpBrowser(HttpClient::create());
            $crawler = $browser->request('GET', 'https://kurs.web.id/bank/bjb');

            $crawler->filter('#kurstabel tbody tr')->each(function ($node) {
                $kode_valas = $node->filter('td:nth-child(1)')->text();
                $jual = str_replace(',', '', $node->filter('td:nth-child(2)')->text());
                $beli = str_replace(',', '', $node->filter('td:nth-child(3)')->text());

                // kode_iso_valas is kode_valas but lowercase and trim the 1 last letter
                $kode_iso_valas = strtolower(substr($kode_valas, 0, -1));

                Currency::updateOrCreate(
                    ['kode_valas' => $kode_valas],
                    [
                        'kode_iso_valas' => $kode_iso_valas,
                        'jual' => $jual,
                        'beli' => $beli,
                    ]
                );
            });

            $this->message = 'Currency rates have been updated successfully.';
        } catch (\Exception $e) {
            $this->message = 'An error occurred: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.valas-scraper');
    }
}
