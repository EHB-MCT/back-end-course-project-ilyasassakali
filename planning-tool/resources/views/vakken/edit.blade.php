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
                    <h2 class="text-lg font-medium text-gray-900">Bewerk vak:</h2>

                    <form action="{{ route('vak.update', $vakken->id) }}" method="post" class="max-w-md mx-auto mt-4 ">
                        {!! method_field('patch') !!}

                        {!! csrf_field() !!}
                            <input type="hidden" value="{{$vakken->id}}">
                        <div class="mb-4">
                            <label for="naam" class="block font-medium text-sm text-gray-700">Naam</label>
                            <input value="{{$vakken->naam}}" type="text" name="naam" id="naam" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        </div>
                        <div class="mb-4">
                            <label for="opleiding" class="block font-medium text-sm text-gray-700">Opleiding</label>
                            <input value="{{$vakken->opleiding}}" type="text" name="opleiding" id="opleiding" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="semester" class="block font-medium text-sm text-gray-700">Semester</label>
                            <input value="{{$vakken->semester}}" type="text" name="semester" id="semester" class="w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>
                        <div class="flex items-center justify-start">
                            <button type="submit" value="Save" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Bewerk</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
