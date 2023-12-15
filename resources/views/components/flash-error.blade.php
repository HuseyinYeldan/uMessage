@if(session()->has('error'))
    <p class="fixed bottom-4 left-1/2 -translate-x-1/2 bg-red-800 bg-opacity-80 p-4 px-8 rounded text-red-200 font-bold flashAnimation flex justify-center items-center gap-2" id='flash'> <i class="fa-solid fa-xmark text-2xl "></i>{{ session('error') }}</p>

    <script>
        let flash = document.getElementById('flash')
        setTimeout(() => {
            flash.style.display = 'none';
        }, 4500);
    </script>
@endif