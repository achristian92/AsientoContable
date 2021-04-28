<?php

namespace App\Console\Commands;

use Carbon\Carbon;
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
        $date = Carbon::now()->format('Y-m-d');
        $response = Http::get("https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=$date");
        if ($response->ok()) {
            $data = $response->json();
            \App\AsientoContable\Currencies\Currency::create([
                'buy' => $data['compra'],
                'sell' => $data['venta']
            ]);
        }

        return 0;
    }
}
