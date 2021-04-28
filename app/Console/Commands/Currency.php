<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Currency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getvaluedolar:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get current value dolar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://deperu.com/api/rest/cotizaciondolar.json');
        $data = $response->json();
        $compra = $data['Cotizacion'][0]['Compra'];
        $venta = $data['Cotizacion'][0]['Venta'];

        $currency = \App\AsientoContable\Currencies\Currency::find(1);
        $currency->update(['rate' => $venta,'compra' => $compra]);

        return 0;
    }
}
