<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\producto;
use Illuminate\Support\Facades\Auth;

class LProductos extends Component
{
    public $nombre, $especie, $raza, $edad, $peso, $color, $propietario;
    public $vacunas = false, $estado = true;
    public $editId = null;
public function render()
{
    $productos = Producto::all();
    return view('livewire.l-productos', compact('productos'));
}
    protected $rules = [
        'nombre' => 'required|string|max:50',
        'especie' => 'required|in:perro,gato,ave,pez,otro',
        'raza' => 'nullable|string|max:80',
        'edad' => 'required|integer|min:0',
        'peso' => 'required|numeric|min:0.01',
        'color' => 'required|string|max:50',
        'propietario' => 'required|string|max:100',
        'vacunas' => 'boolean',
        'estado' => 'boolean'
    ];


    public function guardar()
    {
        $this->validate();

        Producto::create($this->only([
            'nombre', 'especie', 'raza', 'edad', 'peso',
            'color', 'propietario', 'vacunas', 'estado'
        ]));

        session()->flash('mensaje', 'Producto creado');
        $this->resetFields();
    }

    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $this->editId = $id;
        $this->fill($producto->toArray());
    }

    public function actualizar()
    {
        $this->validate();

        if ($this->editId) {
            Producto::find($this->editId)->update($this->only([
                'nombre', 'especie', 'raza', 'edad', 'peso',
                'color', 'propietario', 'vacunas', 'estado'
            ]));

            session()->flash('mensaje', 'Producto actualizado');
            $this->resetFields();
        }
    }

    public function eliminar($id)
    {
        Producto::destroy($id);
        session()->flash('mensaje', 'Producto eliminado');
    }

    public function resetFields()
    {
        $this->reset([
            'nombre', 'especie', 'raza', 'edad', 'peso',
            'color', 'propietario', 'vacunas', 'estado', 'editId'
        ]);
    }
}
