<x-admin.app-layout>
    <x-slot name="head">
        <title> User Query | {{ Config::get('settings')->app_name }}</title>
    </x-slot>

<livewire:user-query /> 
  

</x-admin.app-layout>