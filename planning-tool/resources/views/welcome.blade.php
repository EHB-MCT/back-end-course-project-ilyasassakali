<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-screen">

        <div class="mt-1">
            <h1 style="font-size: 20px">Planning Tool</h1>
        </div>

        <!-- loginbutton -->
        <div class="mt-4">
            <button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <a href="{{ route('login') }}" class="text-white">
                    Login
                </a>
            </button>
        </div>

        <!-- registerbutton -->
        <div class="mt-4">
            <button  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <a href="{{ route('register') }}" class="text-white">
                    Register
                </a>
            </button>
        </div>
    </div>
</x-guest-layout>




