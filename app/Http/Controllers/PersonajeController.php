<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personaje; // Asegúrate de usar tu modelo correctamente

class PersonajeController extends Controller
{
    public function index(Request $request)
    {
        // Obtiene el término de búsqueda del request
        $search = $request->query('search');

        if (!empty($search)) {
            // Filtra los personajes que coincidan con el término de búsqueda
            $personajes = Personaje::where('nombre', 'like', '%' . $search . '%')
                                    ->paginate(28)
                                    ->appends(['search' => $search]); // Añade el término de búsqueda a la paginación
        } else {
            // Si no hay término de búsqueda, retorna todos los personajes paginados
            $personajes = Personaje::paginate(28);
        }

        return view('personajes.index', compact('personajes'));
    }
}
