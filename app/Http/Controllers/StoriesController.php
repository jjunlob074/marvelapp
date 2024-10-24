<?php

namespace App\Http\Controllers;

use App\Services\MarvelStoriesService; // Asegúrate de usar el servicio correcto
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    protected $marvelStoriesService;

    public function __construct(MarvelStoriesService $marvelStoriesService)
    {
        $this->marvelStoriesService = $marvelStoriesService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1); // La página actual, default es 1
        $limit = 32; // Cantidad de elementos por página
        $offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual
    
        $search = $request->input('search');
        $total = 0;
    
        if ($search) {
            // Asume que también modificas `searchStories` para soportar paginación
            $result = $this->marvelStoriesService->searchStories($search, $limit, $offset);
        } else {
            $result = $this->marvelStoriesService->getFeaturedStories($limit, $offset);
        }
    
        $stories = collect($result['results']);
        $total = $result['total'];
    
        // Usar la función de paginación manual de Laravel si es necesario
        $stories = new \Illuminate\Pagination\LengthAwarePaginator(
            $stories,
            $total,
            $limit,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('stories.index', compact('stories', 'search'));
    }

    public function show($id)
    {
        // Asume que tu servicio tiene un método `getStoryById`
        $story = $this->marvelStoriesService->getStoryById($id);

        if (!$story) {
            abort(404);
        }

        return view('stories.show', compact('story'));
    }
}
