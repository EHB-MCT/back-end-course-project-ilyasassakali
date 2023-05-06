<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vakbeheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">Maak nieuwe vak aan:</h2>

                    @if(session('error-message'))
                        <div class="mt-4" style="color: red">
                            {{ session('error-message') }}
                        </div>
                    @endif

                    <form action="{{ url('vak') }}" method="post" class="max-w-md mx-auto mt-4 ">
                        {!! csrf_field() !!}
                        <div class="mb-4">
                            <label for="naam" class="block font-medium text-sm text-gray-700">Naam</label>
                            <input type="text" name="naam" id="naam" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " required>
                        </div>
                        <div class="mb-4">
                            <label for="opleiding" class="block font-medium text-sm text-gray-700">Opleiding</label>
                            <input type="text" name="opleiding" id="opleiding" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="semester" class="block font-medium text-sm text-gray-700">Semester</label>
                            <input type="number" size="2" min="1" max="2" name="semester" id="semester" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="duur" class="block font-medium text-sm text-gray-700">Duur</label>
                            <input min="00:00" max="10:00" type="time"  name="duur" id="duur" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="sessies" class="block font-medium text-sm text-gray-700">Sessies</label>
                            <input type="number" name="sessies" id="sessies" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>
                        <div class="flex items-center justify-start">
                            <button type="submit" value="Save" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">aanmaken</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
