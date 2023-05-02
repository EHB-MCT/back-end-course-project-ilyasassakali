<x-app-layout>
    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 9998;
        }
        #popup-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 50%;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planningopstel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Selecteer om planning op te stellen of veranderingen te maken:</h2>
                    <div id='calendar'></div>
                </div>
                <!-- Main modal -->
                <div id="overlay" class="hidden"></div>

                <div id="popup-modal" style="" class="hidden">
                    <div class="">
                        <div class="px-6 py-4 w-1/2">
                            <h2 class="text-lg font-medium text-gray-900">Vak toevoegen aan planning:</h2>
                            <form>
                                <div class="mb-4">
                                    <label class="block font-medium text-sm text-gray-700" for="date">Datum</label>
                                    <input class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="date" id="datum" name="datum" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block font-medium text-sm text-gray-700" for="time">Begin- en Einduur</label>
                                    <input class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="time" id="beginuur" name="beginuur" required>
                                    <input class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " type="time" id="einduur" name="einduur" required>
                                </div>

                                <div class="flex mb-4">
                                    <div class="w-1/2 mr-4">
                                        <label class="block font-medium text-sm text-gray-700" for="vak">Vak</label>
                                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="vak" name="vak" required>
                                            <option value="">Selecteer een vak</option>
                                            @foreach($vakken as $vak)
                                                <option value="{{$vak->naam}}">{{$vak->naam}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex ">
                                        <div id="duur_div" class=" hidden ml-4">
                                            <label class="block font-medium text-sm text-gray-700" for="duur">Duur</label>
                                            <input type="time" id="duur" name="duur" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly>
                                        </div>

                                        <div id="sessies_div" class=" hidden ml-4">
                                            <label class="block font-medium text-sm text-gray-700" for="sessies">Sessies</label>
                                            <input type="text" id="sessies" name="sessies" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block font-medium text-sm text-gray-700" for="location">Lokaal</label>
                                    <select class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="location" name="location" required>
                                        <option value="">Selecteer een lokaal</option>
                                        <option value="Audi 1">Audi 1</option>
                                        <option value="Audi 2">Audi 2</option>
                                        <option value="Audi 3">Audi 3</option>
                                        <option value="Audi 4">Audi 4</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block font-medium text-sm text-gray-700" for="teacher">Leerkracht</label>
                                    <select class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="teacher" name="teacher" required>
                                        <option value="">Selecteer een leerkracht</option>
                                        <option value="Bert Heyman">Bert Heyman</option>
                                        <option value="Mike Derycke">Mike Derycke</option>
                                        <option value="Fenna Zamouri">Fenna Zamouri</option>
                                        <option value="Wim Hambrouck">Wim Hambrouck</option>
                                    </select>
                                </div>

                                <div class="flex justify-between">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">
                                        Toevoegen
                                    </button>
                                    <button id="popup-close-btn" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button">
                                        Annuleren
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <script>
            document.getElementById("popup-close-btn").addEventListener("click", function() {
                var modal = document.getElementById("popup-modal");
                modal.style.display = "none";
            });

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale:'nl',
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '22:00:00',
                    selectable : true,
                    weekends: false,
                    slotLabelFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        meridiem: 'short'
                    },
                    select: function(info) {
                        var start = info.start;
                        var end = info.end;
                        var modal = document.getElementById("popup-modal");
                        var overlay = document.getElementById('overlay');
                        var closeButton = document.getElementById('popup-close-btn');

                        modal.style.display = "block";
                        overlay.style.display = 'block';
                        // Set the values of date, start time, and end time inputs in the form to the selected date and times
                        document.getElementById("datum").value = start.toISOString().slice(0,10);
                        document.getElementById("beginuur").value = start.toTimeString().slice(0,5);
                        document.getElementById("einduur").value = end.toTimeString().slice(0,5);
                        closeButton.addEventListener('click', function() {
                            overlay.style.display = 'none';
                            modal.style.display = 'none';
                        });

                        document.getElementById('vak').addEventListener('change', function() {
                            var vak_value = this.value;
                            var vak = @json($vakken->toArray())
                        .find(function(vak) { return vak.naam === vak_value; });
                            if (vak) {
                                document.getElementById('duur_div').style.display = 'block';
                                document.getElementById('sessies_div').style.display = 'block';
                                document.getElementById('duur').value = vak.duur;
                                document.getElementById('sessies').value = vak.sessies;
                            } else {
                                document.getElementById('duur_div').style.display = 'none';
                                document.getElementById('sessies_div').style.display = 'none';
                                document.getElementById('duur').value = '';
                                document.getElementById('sessies').value = '';
                            }
                        });
                    },

                });

                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
