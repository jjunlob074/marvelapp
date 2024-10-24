<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Creador;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;


class CreatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Obtener los creadores
        $creators = Creador::where('nombre', 'like', '%'.$search.'%')
                            ->orWhere('tipo', 'like', '%'.$search.'%')
                            ->paginate(50);
    
        // Obtener los IDs de los creadores que le gustan al usuario actual
        $likedCreatorsIds = json_decode(Cookie::get('liked_creators'), true) ?? [];
    
        // Pasar los creadores y la lista de IDs de los que le gustan al usuario a la vista
        return view('creadores.index', compact('creators', 'likedCreatorsIds'));
    }
    public function toggleLike(Request $request, $creatorId)
{
    $creator = Creador::findOrFail($creatorId); // Obtener el objeto del creador
    $likedCreators = json_decode(Cookie::get('liked_creators'), true) ?? [];

    if (in_array($creatorId, $likedCreators)) {
        // Si ya le dio "Me gusta", lo removemos de la lista
        $likedCreators = array_diff($likedCreators, [$creatorId]);
        $message = "Has eliminado a {$creator->nombre} de tu lista Me gusta.";
    } else {
        // Si no le había dado "Me gusta", lo agregamos a la lista
        $likedCreators[] = $creatorId;
        $message = "Has agregado a {$creator->nombre} en la lista Me gusta.";
    }

    // Guardar la lista actualizada de "Me gusta" en la cookie
    Cookie::queue('liked_creators', json_encode($likedCreators), 60 * 24 * 365);

    // Determinar el tipo de solicitud y redirigir en consecuencia
    if ($request->isMethod('post')) {
        // Si la solicitud es de tipo POST, redirigir a la página de creadores
        return redirect()->route('creators.index')->with('success', $message);
    } elseif ($request->isMethod('delete')) {
        // Si la solicitud es de tipo DELETE, redirigir a la página de creadores con "Me gusta"
        return redirect()->route('creators.liked')->with('danger', $message);
    }
}


    public function indexLiked()
    {
        $likedCreators = [];
        $likedCreatorsIds = json_decode(Cookie::get('liked_creators'), true) ?? [];

        if (!empty($likedCreatorsIds)) {
            // Obtener los creadores que tienen "Me gusta"
            $likedCreators = Creador::whereIn('id', $likedCreatorsIds)->get();
        }

        return view('creadores.liked', compact('likedCreators'));
    }
        public function fetchAndStoreCreators()
    {
        $timestamp = time();
        $publicKey = env('MARVEL_API_KEY');
        $privateKey = env('MARVEL_PRIVATE_KEY');
        $hash = md5($timestamp . $privateKey . $publicKey);
        $client = new Client();
        $limit = 100; // Máximo permitido por la API en una sola solicitud
        $offset = 0;
        $totalCreatorsFetched = 0;
        $totalCreators = 0; // Variable para almacenar el total de creadores después de la primera solicitud

        do {
            $url = "http://gateway.marvel.com/v1/public/creators?ts={$timestamp}&apikey={$publicKey}&hash={$hash}&limit={$limit}&offset={$offset}";

            try {
                $response = $client->request('GET', $url);

                if ($response->getStatusCode() == 200) {
                    $body = $response->getBody();
                    $data = json_decode($body);
                    $creators = $data->data->results;

                    // Almacenar el total de creadores solo después de la primera solicitud
                    if ($totalCreators == 0) {
                        $totalCreators = $data->data->total;
                    }

                    if (!empty($creators)) {
                        foreach ($creators as $creator) {
                            // Determinar el tipo de creador
                            $tipos = [];

                            if ($creator->series->returned != 0) {
                                $tipos[] = 'Comic Writer';
                            }
                            if ($creator->stories->returned != 0) {
                                $tipos[] = 'Scriptwriter';
                            }
                            if ($creator->comics->returned != 0) {
                                $tipos[] = 'Comic Artist';
                            }
                            if ($creator->events->returned != 0) {
                                $tipos[] = 'Editor';
                            }
                            
                            // Unir los tipos en un string, separados por una coma y un espacio
                            $tipo = implode(', ', $tipos);

                            // Guardar el creador en la base de datos
                            $thumbnail = $creator->thumbnail->path . '.' . $creator->thumbnail->extension;
                            Creador::updateOrCreate(
                                ['nombre' => $creator->fullName],
                                [
                                    'descripcion' => isset($creator->description) ? $creator->description : null,
                                    'imagen' => $thumbnail,
                                    'tipo' => $tipo,
                                ]
                            );
                        }
                        $totalCreatorsFetched += count($creators);
                        $offset += $limit;
                    } else {
                        break;
                    }
                }
            } catch (\Exception $e) {
                // Manejar errores
                Log::error('Error fetching creators: ' . $e->getMessage());
            }
        } while ($totalCreatorsFetched < $totalCreators);

        
        return response()->json(['message' => 'Marvel creators fetched and stored successfully']);
    }
}
