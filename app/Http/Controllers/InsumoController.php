<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    private $categorias = [
        'Fertilizantes',
        'Semillas Certificadas',
        'Agroquímicos',
        'Herramientas',
        'Sistemas de Riego',
    ];

   
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $insumos = Insumo::when($buscar, function ($query) use ($buscar) {
                $query->where('nombre', 'like', '%' . $buscar . '%')
                      ->orWhere('codigo', 'like', '%' . $buscar . '%');
            })
            ->latest()
            ->paginate(10)
            ->appends(['buscar' => $buscar]);

        return view('insumos.index', compact('insumos', 'buscar'));
    }

    
    public function create()
    {
        $categorias = $this->categorias;

        return view('insumos.create', compact('categorias'));
    }

    

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $this->guardarImagen($request);
        }

        Insumo::create($datos);

        return redirect()->route('insumos.index')
                         ->with('success', '¡Insumo registrado exitosamente en el catálogo!');
    }

  

    public function show(Insumo $insumo)
    {
        return redirect()->route('insumos.edit', $insumo);
    }

    

    public function edit(Insumo $insumo)
    {
        $categorias = $this->categorias;

        return view('insumos.edit', compact('insumo', 'categorias'));
    }

    


    public function update(Request $request, Insumo $insumo)
    {
        $datos = $request->validate($this->reglas($insumo->id), $this->mensajes());

        if ($request->hasFile('imagen')) {
            $this->eliminarImagen($insumo);
            $datos['imagen'] = $this->guardarImagen($request);
        } else {
            unset($datos['imagen']);
        }

        $insumo->update($datos);

        return redirect()->route('insumos.index')
                         ->with('success', '¡Insumo actualizado correctamente!');
    }

    
    
    public function destroy(Insumo $insumo)
    {
        $this->eliminarImagen($insumo);

        $insumo->delete();

        return redirect()->route('insumos.index')
                         ->with('success', '¡Insumo eliminado del catálogo!');
    }

    private function reglas($id = null)
    {
        return [
            'codigo'            => $id ? 'required|max:50|unique:insumos,codigo,' . $id : 'required|max:50|unique:insumos,codigo',
            'nombre'            => 'required|max:255',
            'categoria'         => 'required|in:' . implode(',', $this->categorias),
            'precio'            => 'required|numeric|gt:0',
            'costo'             => 'required|numeric|min:0',
            'inventario'        => 'required|integer|min:0',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'fabricante'        => 'required|max:255',
            'fecha_vencimiento' => 'required|date',
            'fecha_registro'    => 'required|date',
            'numero_lote'       => 'required|max:50',
        ];
    }

    private function mensajes()
    {
        return [
            'codigo.required'         => 'El código SKU es obligatorio.',
            'codigo.unique'           => 'Este código SKU ya está registrado.',
            'codigo.max'              => 'El código SKU no puede tener más de 50 caracteres.',
            'nombre.required'         => 'El nombre del insumo es obligatorio.',
            'categoria.required'      => 'Seleccione una categoría.',
            'categoria.in'            => 'La categoría seleccionada no es válida.',
            'precio.required'         => 'El precio es obligatorio.',
            'precio.numeric'          => 'El precio debe ser un número.',
            'precio.gt'               => 'El precio debe ser mayor a 0.',
            'costo.required'          => 'El costo es obligatorio.',
            'costo.numeric'           => 'El costo debe ser un número.',
            'costo.min'               => 'El costo no puede ser negativo.',
            'inventario.required'     => 'El inventario es obligatorio.',
            'inventario.integer'      => 'El inventario debe ser un número entero.',
            'inventario.min'          => 'El inventario no puede ser negativo.',
            'imagen.image'            => 'El archivo debe ser una imagen.',
            'imagen.mimes'            => 'La imagen debe ser jpg, png o webp.',
            'imagen.max'              => 'La imagen no puede pesar más de 5MB.',
            'fabricante.required'     => 'El fabricante es obligatorio.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date'  => 'La fecha de vencimiento no es válida.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'     => 'La fecha de registro no es válida.',
            'numero_lote.required'    => 'El número de lote es obligatorio.',
        ];
    }

    private function guardarImagen(Request $request)
    {
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . uniqid() . '.' . $archivo->extension();

        $archivo->move(public_path('uploads/insumos'), $nombre);

        return 'uploads/insumos/' . $nombre;
    }

    private function eliminarImagen(Insumo $insumo)
    {
        if ($insumo->imagen && file_exists(public_path($insumo->imagen))) {
            unlink(public_path($insumo->imagen));
        }
    }
}
