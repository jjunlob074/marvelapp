<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Evento;

class FetchMarvelEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-marvel-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches events from Marvel API and updates the local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching Marvel events...');

        $timestamp = time();
        $publicKey = env('MARVEL_API_KEY');
        $privateKey = env('MARVEL_PRIVATE_KEY');
        $hash = md5($timestamp . $privateKey . $publicKey);
        $client = new Client();
        $limit = 100; // Máximo permitido por la API en una sola solicitud
        $offset = 0;
        $totalEventsFetched = 0;

        do {
            $url = "http://gateway.marvel.com/v1/public/events?ts={$timestamp}&apikey={$publicKey}&hash={$hash}&limit={$limit}&offset={$offset}";

            try {
                $response = $client->request('GET', $url);

                if ($response->getStatusCode() == 200) {
                    $body = $response->getBody();
                    $data = json_decode($body);
                    $events = $data->data->results;
                    $total = $data->data->total; // Total de eventos disponibles

                    if (!empty($events)) {
                        $this->processMarvelEvents($events);
                        $totalEventsFetched += count($events);
                        $this->info("Fetched {$totalEventsFetched} of {$total} events...");
                    }

                    $offset += $limit; // Incrementa el offset para la siguiente solicitud
                } else {
                    $this->error('Failed to fetch Marvel events.');
                    break; // Salir del bucle en caso de error
                }
            } catch (\Exception $e) {
                $this->error("An error occurred: " . $e->getMessage());
                break; // Salir del bucle en caso de excepción
            }
        } while ($totalEventsFetched < $total);

        $this->info('All Marvel events fetched and updated successfully.');
    }

    private function processMarvelEvents($events)
    {
        foreach ($events as $event) {
            $thumbnail = isset($event->thumbnail->path) && isset($event->thumbnail->extension) ? $event->thumbnail->path . '.' . $event->thumbnail->extension : null;

            Evento::updateOrCreate(
                ['nombre' => $event->title], // Suponiendo que el título sea único para cada evento
                [
                    'descripcion' => $event->description,
                    'imagen' => $thumbnail, // Almacenar la URL de la imagen
                ]
            );
        }
    }
}
