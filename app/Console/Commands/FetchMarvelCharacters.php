<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Personaje;

class FetchMarvelCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-marvel-characters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches characters from Marvel API and updates the local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching Marvel characters...');

        $timestamp = time();
        $publicKey = env('MARVEL_API_KEY');
        $privateKey = env('MARVEL_PRIVATE_KEY');
        $hash = md5($timestamp . $privateKey . $publicKey);
        $client = new Client();
        $limit = 100; // Máximo permitido por la API en una sola solicitud
        $offset = 0;
        $totalCharactersFetched = 0;

        do {
            $url = "http://gateway.marvel.com/v1/public/characters?ts={$timestamp}&apikey={$publicKey}&hash={$hash}&limit={$limit}&offset={$offset}";

            try {
                $response = $client->request('GET', $url);

                if ($response->getStatusCode() == 200) {
                    $body = $response->getBody();
                    $data = json_decode($body);
                    $characters = $data->data->results;
                    $total = $data->data->total; // Total de personajes disponibles

                    if (!empty($characters)) {
                        $this->processMarvelCharacters($characters);
                        $totalCharactersFetched += count($characters);
                        $this->info("Fetched {$totalCharactersFetched} of {$total} characters...");
                    }

                    $offset += $limit; // Incrementa el offset para la siguiente solicitud
                } else {
                    $this->error('Failed to fetch Marvel characters.');
                    break; // Salir del bucle en caso de error
                }
            } catch (\Exception $e) {
                $this->error("An error occurred: " . $e->getMessage());
                break; // Salir del bucle en caso de excepción
            }
        } while ($totalCharactersFetched < $total);

        $this->info('All Marvel characters fetched and updated successfully.');
    }

    private function processMarvelCharacters($characters)
    {
        foreach ($characters as $character) {
            $thumbnail = $character->thumbnail->path . '.' . $character->thumbnail->extension;

            Personaje::updateOrCreate(
                ['nombre' => $character->name],
                [
                    'descripcion' => $character->description,
                    'imagen' => $thumbnail,
                ]
            );
        }
    }
}
