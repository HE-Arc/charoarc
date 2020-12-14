<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="--bg-opacity: 1;
	background: rgb(180,131,189);
	background: linear-gradient(225deg, rgba(180,131,189,1) 21%, rgba(116,222,244,1) 67%, rgba(192,160,205,1) 86%);">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
