<style>
    #delete-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 9998;
    }
    #delete-modal {
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


<!-- Delete modal -->
<div id="delete-overlay" class="hidden"></div>

<div id="delete-modal" style="" class="hidden">
    <div class="">
        <div class="px-6 py-4 w-1/2">
            <h2 class="text-lg font-medium text-gray-900">Evenement verwijderen of bewerken</h2>
            <p class="mb-4">Weet u zeker dat u het geklikte evenement wilt verwijderen of bewerken?</p>
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-between">
                    <button class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit">
                        Verwijderen
                    </button>
                    <button id="update-redirect-btn" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button">
                        Bewerken
                    </button>
                    <button id="delete-close-btn" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="button">
                        Annuleren
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
