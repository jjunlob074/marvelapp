<?php

namespace App\Http\Controllers;

use App\Services\MarvelComicsService;
use Illuminate\Http\Request;

class ComicsController extends Controller
{
    protected $marvelComicsService;

    public function __construct(MarvelComicsService $marvelComicsService)
    {
        $this->marvelComicsService = $marvelComicsService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1); // La página actual, default es 1
        $limit = 30; // Cantidad de elementos por página
        $offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual
    
        $search = $request->input('search');
        $total = 0;
    
        if ($search) {
            // Asumiendo que también modificas `searchComics` para soportar paginación
            $result = $this->marvelComicsService->searchComics($search, $limit, $offset);
        } else {
            $result = $this->marvelComicsService->getFeaturedComics($limit, $offset);
        }
    
        $comics = collect($result['results']);
        $total = $result['total'];
    
        // Usar la función de paginación manual de Laravel si es necesario
        // Esto es para crear una instancia de LengthAwarePaginator
        // Nota: Necesitarás importar LengthAwarePaginator en la parte superior de tu archivo
        $comics = new \Illuminate\Pagination\LengthAwarePaginator(
            $comics,
            $total,
            $limit,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('comics.index', compact('comics', 'search'));
    }

    public function show($id)
    {
        // Asume que tu servicio tiene un método getComicById
        $comic = $this->marvelComicsService->getComicById($id);

        if (!$comic) {
            abort(404);
        }

        return view('comics.show', compact('comic'));
    }
}
