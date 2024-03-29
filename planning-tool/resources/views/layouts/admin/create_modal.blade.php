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

<!-- Main modal -->
<div id="overlay" class="hidden"></div>

<div id="popup-modal" style="" class="hidden">
    <div class="">
        <div class="px-6 py-4 w-1/2">
            <h2 class="text-lg font-medium text-gray-900">Evenement toevoegen aan planning:</h2>
            <form action="{{ route('storeEvent') }}" method="POST">
                @csrf
                <input type="hidden" id="vak_id" name="vak_id">




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
                        <div id="semester_div" class=" hidden ml-4">
                            <label class="block font-medium text-sm text-gray-700" for="semester">Semester</label>
                            <input type="number" id="semester" name="semester" style="width: 120px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly>
                        </div>

                        <div id="duur_div" class=" hidden ml-4">
                            <label class="block font-medium text-sm text-gray-700" for="duur">Duur</label>
                            <input type="time" id="duur" name="duur" style="width: 120px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly>
                        </div>

                        <div id="sessies_div" class=" hidden ml-4">
                            <label class="block font-medium text-sm text-gray-700" for="sessies">Sessies</label>
                            <input type="text" id="sessies" name="sessies" style="width: 120px" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="lokaal">Lokaal</label>
                    <select class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="lokaal" name="lokaal" required>
                        <option value="">Selecteer een lokaal</option>
                        <option value="Audi 1">Audi 1</option>
                        <option value="Audi 2">Audi 2</option>
                        <option value="Audi 3">Audi 3</option>
                        <option value="Audi 4">Audi 4</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700" for="teacher">Leerkracht</label>
                    <select class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="leerkracht" name="leerkracht" required>
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
