<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Montserrat:wght@200;300;400;500;600;700;800&family=Redacted+Script&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body class="bg-gray-900">
    <div
        class="w-80 h-80 bg-cyan-300 absolute right-1/2 left-1/2 -translate-x-1/2 top-0 blur-[300px] animation-bigger -z-10">
    </div>

    <div
        class="w-60 h-80 left-20 top-20 rounded border border-gray-200 drop-shadow-md bg-white absolute overflow-hidden opacity-70 -rotate-6">
        <img src="https://cdn.pixabay.com/photo/2021/08/31/11/58/woman-6588614_1280.jpg" alt=""> </div>
    <div
        class="w-60 h-80 right-20 bottom-20 rounded border border-gray-200 drop-shadow-md bg-white absolute overflow-hidden opacity-70 rotate-6">
        <img src="https://cdn.pixabay.com/photo/2023/05/23/15/26/bengal-cat-8012976_1280.jpg" alt=""> </div>

    <div class="w-screen h-screen flex justify-center items-center flex-col">
        <h1 class="font-bold text-6xl text-white mb-5">Welcome to <span
                class="text-cyan-400 cursive font-bold underline underline-offset-8">uMessage</span> </h1>
        <span class="text-sm text-gray-200 max-w-lg text-center inline-block" id="bodyText"> </span>
        <div class="flex gap-12 mt-5">
            <button class="text-sm text-white bg-cyan-600  font-bold rounded px-8 py-2">Register</button>
            <button
                class="text-sm text-white ring-2 ring-cyan-600  font-bold rounded px-8 py-2 duration-200 hover:bg-cyan-600">Log
                In</button>
        </div>
    </div>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="/js/app.js"></script>
</body>

</html>
