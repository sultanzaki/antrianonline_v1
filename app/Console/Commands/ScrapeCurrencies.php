<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Livewire\ValasScraper;

class ScrapeCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scraper = new ValasScraper();
        $scraper->scrape();
        $this->info('Currency rates have been updated successfully.');
    }
}
