<x-jet-form-section submit="updateEstablishment">
    <x-slot name="title">
        Actualiza la información de tu establecimiento
    </x-slot>

    <x-slot name="description">
        Actualiza todos los campos de tu establecimiento par poder hacer uso del sistema.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="Nombre" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="Email" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="email"/>
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="Dirección" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model="address"/>
            <x-jet-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="telephone" value="Teléfono" />
            <x-jet-input id="telephone" type="text" class="mt-1 block w-full" wire:model="telephone"/>
            <x-jet-input-error for="telephone" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            Información actualizada
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
