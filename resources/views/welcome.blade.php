<!-- Styles -->
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    .bg-image {
        /* The image used */
        background-image: url('https://utmsamsbucket.s3.ap-southeast-1.amazonaws.com/asset/gerbang-siang.jpg');

        /* Add the blur effect */
        filter: blur(2px);
        -webkit-filter: blur(2px);

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* Position text in the middle of the page/image */
    .bg-text {
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/opacity/see-through */
        color: white;
        font-weight: bold;
        border: 3px solid #f1f1f1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }
</style>
<x-guest-layout>

    <div class="bg-image"></div>

    <div class="bg-text">
        <h2>WELCOME</h2>
        <h1 style="font-size:50px">UTM SAMS</h1>
        <p>UTM ACTIVITY MANAGEMENT SYSTEM</p>
        <br>
        @if (Route::has('login'))
            @auth
                <button type="button"
                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none
                    focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2">
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-white-600">Dashboard</a>
                </button>
        @else
            <button
                class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    <a href="{{ route('login') }}"
                        class="font-semibold text-white-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>
                </span>
            </button>
            @if (Route::has('register'))
                <button type="button"
                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none
                focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-base px-5 py-2.5 text-center mr-2 mb-2">
                    <a href="{{ route('register') }}" class="font-semibold text-white-600">Register</a>
                </button>
            @endif
            @endauth

        @endif

    </div>

</x-guest-layout>




</html>
