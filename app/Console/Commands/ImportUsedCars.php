<?php

namespace App\Console\Commands;

use App\Services\CarImport;
use Illuminate\Console\Command;

class ImportUsedCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:used-cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cars from xml to data base';

    //  service instance

    protected $importService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->importService = new CarImport();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Display this on the screen');
        return $this->importService->import();
    }
}
