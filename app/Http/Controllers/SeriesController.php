<?php

namespace App\Http\Controllers;

use App\Services\MarvelSeriesService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SeriesController extends Controller
{
    protected $marvelSeriesService;

    public function __construct(MarvelSeriesService $marvelSeriesService)
    {
        $this->marvelSeriesService = $marvelSeriesService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1); // La página actual, default es 1
        $limit = 30; // Cantidad de elementos por página
        $offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual
    
        $search = $request->input('search');
        $total = 0;
    
        if ($search) {
            // Asumiendo que también modificas `searchSeries` para soportar paginación
            $result = $this->marvelSeriesService->searchSeries($search, $limit, $offset);
        } else {
            $result = $this->marvelSeriesService->getFeaturedSeries($limit, $offset);
        }
    
        $series = collect($result['results']);
        $total = $result['total'];
    
        // Usar la función de paginación manual de Laravel si es necesario
        // Esto es para crear una instancia de LengthAwarePaginator
        $series = new LengthAwarePaginator(
            $series,
            $total,
            $limit,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('series.index', compact('series', 'search'));
    }

    public function show($id)
    {
        // Asume que tu servicio tiene un método getSeriesById
        $series = $this->marvelSeriesService->getSeriesById($id);

        if (!$series) {
            abort(404);
        }

        return view('series.show', compact('series'));
    }
}
