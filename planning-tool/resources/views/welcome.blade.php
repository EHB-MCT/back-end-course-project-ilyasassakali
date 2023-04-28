<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-screen">

        <div class="mt-1">
            <h1 style="font-size: 20px">Planning Tool</h1>
        </div>

        <!-- loginbutton -->
        <div class="mt-4">
            <button class=" ">
                <a href="{{ route('login') }}" class="text-dark">
                    Login
                </a>
            </button>
        </div>

        <!-- registerbutton -->
        <div class="mt-4">
            <button class=" ">
                <a href="{{ route('register') }}" class="text-dark">
                    Register
                </a>
            </button>
        </div>
    </div>
</x-guest-layout>




