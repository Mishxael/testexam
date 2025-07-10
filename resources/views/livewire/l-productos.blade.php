<div style="background-color: #1e1e1e; color: #fff; padding: 20px; border-radius: 10px;">
    <form wire:submit.prevent="{{ $editId ? 'actualizar' : 'guardar' }}">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px;">
            <div>
                <label>Nombre:</label>
                <input type="text" wire:model="nombre" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div>
                <label>Especie:</label>
                <select wire:model="especie" style="width: 100%; background-color: #333; color: white;">
                    <option value="">Seleccione</option>
                    @foreach(['perro','gato','ave','pez','otro'] as $tipo)
                        <option value="{{ $tipo }}">{{ ucfirst($tipo) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Raza:</label>
                <input type="text" wire:model="raza" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div>
                <label>Edad (meses):</label>
                <input type="number" wire:model="edad" min="0" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div>
                <label>Peso (kg):</label>
                <input type="number" step="0.01" wire:model="peso" min="0" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div>
                <label>Color:</label>
                <input type="text" wire:model="color" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div>
                <label>Propietario:</label>
                <input type="text" wire:model="propietario" style="width: 100%; background-color: #333; color: #fff;">
            </div>

            <div style="align-self: center;">
                <label>
                    <input type="checkbox" wire:model="vacunas">
                    Vacunas al día
                </label>
            </div>

            <div style="align-self: center;">
                <label>
                    <input type="checkbox" wire:model="estado">
                    ¿Activo?
                </label>
            </div>
        </div>

        <div style="margin-top: 10px;">
            <button type="submit" style="background-color: #4CAF50; color: white; padding: 8px 16px; border: none;">
                {{ $editId ? 'Actualizar' : 'Guardar' }}
            </button>

            @if($editId)
                <button type="button" wire:click="resetFields" style="background-color: #f44336; color: white; padding: 8px 16px; border: none; margin-left: 10px;">
                    Cancelar edición
                </button>
            @endif
        </div>
    </form>

   
    @if (session()->has('mensaje'))
        <div style="color: lightgreen; margin-top: 10px;">
            {{ session('mensaje') }}
        </div>
    @endif

  
    @foreach ($productos as $p)
        <div style="border: 1px solid #555; padding: 10px; margin-top: 10px;">
            <strong>{{ $p->nombre }}</strong> ({{ ucfirst($p->especie) }})<br>
            Edad: {{ $p->edad }} meses | Peso: {{ $p->peso }} kg<br>
            Color: {{ $p->color }} | Raza: {{ $p->raza ?? 'N/E' }}<br>
            Propietario: {{ $p->propietario }}<br>
            Vacunas: {{ $p->vacunas ? 'Al día' : 'Pendiente' }}<br>
            Estado: {{ $p->estado ? 'Activo' : 'Fallecido' }}<br>

            <button wire:click="editar({{ $p->id }})">Editar</button>
            <button wire:click="eliminar({{ $p->id }})">Eliminar</button>
        </div>
    @endforeach
</div>
