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
                    <a href="" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                        + Nieuwe Vak Toevoegen
                    </a>
                    <br>
                    <table class="table w-full mt-8 ">
                        <thead>
                        <tr>
                            <th class="text-left">#</th>
                            <th class="text-left">Naam</th>
                            <th class="text-left">Opleiding</th>
                            <th class="text-left">Semester</th>
                            <th class="text-left">Handelingen</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td class="text-left">1</td>
                            <td class="text-left">Dev 3</td>
                            <td class="text-left">Multimedia en creatief technologie</td>
                            <td class="text-left">3</td>

                            <td class="text-left">
                                <a href="" class="block mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                                    zie
                                </a>
                                <a href="" class="block mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                                    bewerk
                                </a>
                                <a href="" class="block mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" >
                                    verwijder
                                </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>