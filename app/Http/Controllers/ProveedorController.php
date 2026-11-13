<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    private $categorias = ['Químicos', 'Semilleros', 'Maquinaria'];

    private $diasCredito = [15, 30, 45, 60];

   
    public function index()
    {
        $proveedores = Proveedor::latest()->paginate(10);

        return view('proveedores.index', compact('proveedores'));
    }

   
    public function create()
    {
        $categorias = $this->categorias;
        $diasCredito = $this->diasCredito;

        return view('proveedores.create', compact('categorias', 'diasCredito'));
    }

   
    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        Proveedor::create($datos);

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor registrado exitosamente!');
    }

    
    public function show(Proveedor $proveedor)
    {
        return redirect()->route('proveedores.edit', $proveedor);
    }

  
    public function edit(Proveedor $proveedor)
    {
        $categorias = $this->categorias;
        $diasCredito = $this->diasCredito;

        return view('proveedores.edit', compact('proveedor', 'categorias', 'diasCredito'));
    }

    
    public function update(Request $request, Proveedor $proveedor)
    {
        $datos = $request->validate($this->reglas($proveedor->id), $this->mensajes());

        $proveedor->update($datos);

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor actualizado correctamente!');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor eliminado correctamente!');
    }

    private function reglas($id = null)
    {
        return [
            'rtn'            => $id ? 'required|digits:14|unique:proveedores,rtn,' . $id : 'required|digits:14|unique:proveedores,rtn',
            'empresa'        => 'required|max:255',
            'contacto'       => 'required|max:255',
            'telefono'       => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'limite_credito' => 'required|numeric|min:0|max:9999999999.99',
            'categoria'      => 'required|in:' . implode(',', $this->categorias),
            'dias_credito'   => 'required|integer|in:' . implode(',', $this->diasCredito),
            'estado'         => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ];
    }

    private function mensajes()
    {
        return [
            'rtn.required'            => 'El RTN es obligatorio.',
            'rtn.digits'              => 'El RTN debe tener exactamente 14 dígitos numéricos.',
            'rtn.unique'              => 'Este RTN ya está registrado.',
            'empresa.required'        => 'La empresa (razón social) es obligatoria.',
            'contacto.required'       => 'El nombre del asesor comercial es obligatorio.',
            'telefono.required'       => 'El teléfono es obligatorio.',
            'telefono.regex'          => 'El teléfono debe tener 8 dígitos e iniciar con 2, 3, 8 o 9.',
            'limite_credito.required' => 'El límite de crédito es obligatorio.',
            'limite_credito.numeric'  => 'El límite de crédito debe ser un número.',
            'limite_credito.min'      => 'El límite de crédito no puede ser negativo.',
            'limite_credito.max'      => 'El límite de crédito es demasiado alto.',
            'categoria.required'      => 'Seleccione una categoría.',
            'categoria.in'            => 'La categoría seleccionada no es válida.',
            'dias_credito.required'   => 'Seleccione los días de crédito.',
            'dias_credito.integer'    => 'Los días de crédito deben ser 15, 30, 45 o 60.',
            'dias_credito.in'         => 'Los días de crédito deben ser 15, 30, 45 o 60.',
            'estado.required'         => 'Seleccione el estado.',
            'estado.in'               => 'El estado debe ser Activo o Inactivo.',
            'fecha_registro.required' => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'     => 'La fecha de registro no es válida.',
        ];
    }
}
