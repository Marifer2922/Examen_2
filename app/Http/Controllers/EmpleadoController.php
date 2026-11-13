<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    private $cargos = [
        'Ingeniero Agrónomo',
        'Asesor Técnico de Campo',
        'Jefe de Bodega Central',
        'Operador de Maquinaria',
        'Cajero',
    ];

    
    public function index()
    {
        $empleados = Empleado::latest()->paginate(10);

        return view('empleados.index', compact('empleados'));
    }


    public function create()
    {
        $cargos = $this->cargos;

        return view('empleados.create', compact('cargos'));
    }

   

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());

        Empleado::create($datos);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado registrado exitosamente en la nómina!');
    }

    

    public function show(Empleado $empleado)
    {
        return redirect()->route('empleados.edit', $empleado);
    }

    

    public function edit(Empleado $empleado)
    {
        $cargos = $this->cargos;

        return view('empleados.edit', compact('empleado', 'cargos'));
    }

   

    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate($this->reglas($empleado->id), $this->mensajes());

        $empleado->update($datos);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Datos del empleado actualizados correctamente!');
    }

   
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado eliminado de la nómina!');
    }

    private function reglas($id = null)
    {
        return [
            'identidad'     => $id ? 'required|digits:13|unique:empleados,identidad,' . $id : 'required|digits:13|unique:empleados,identidad',
            'nombre'        => 'required|max:255',
            'apellido'      => 'required|max:255',
            'correo'        => $id ? 'required|email|max:255|unique:empleados,correo,' . $id : 'required|email|max:255|unique:empleados,correo',
            'cargo'         => 'required|in:' . implode(',', $this->cargos),
            'salario'       => 'required|numeric|gt:0|max:99999999.99',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
            'estado'        => 'required|in:Activo,Inactivo',
        ];
    }

    private function mensajes()
    {
        return [
            'identidad.required'           => 'El DNI es obligatorio.',
            'identidad.digits'             => 'El DNI debe tener exactamente 13 dígitos numéricos, sin guiones.',
            'identidad.unique'             => 'Este DNI ya está registrado.',
            'nombre.required'              => 'El nombre es obligatorio.',
            'apellido.required'            => 'El apellido es obligatorio.',
            'correo.required'              => 'El correo es obligatorio.',
            'correo.email'                 => 'Ingrese un correo electrónico válido.',
            'correo.unique'                => 'Este correo ya está registrado.',
            'cargo.required'               => 'Seleccione un cargo.',
            'cargo.in'                     => 'El cargo seleccionado no es válido.',
            'salario.required'             => 'El salario es obligatorio.',
            'salario.numeric'              => 'El salario debe ser un número.',
            'salario.gt'                   => 'El salario debe ser mayor a 0.',
            'salario.max'                  => 'El salario es demasiado alto.',
            'fecha_ingreso.required'       => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date'           => 'La fecha de ingreso no es válida.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
            'estado.required'              => 'Seleccione el estado.',
            'estado.in'                    => 'El estado debe ser Activo o Inactivo.',
        ];
    }
}
