<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        * {
            font-family: "Raleway", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
    <title>Auth</title>
</head>

<body class="antialiased">
    @yield('body')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/jquery.js"></script>
    @stack('scripts')
    <script>
        @if (Session::has('type'))
            @switch(session()->get('type'))
                @case('success')
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('message') }}",
                    timer: 4000,
                    timerProgressBar: true,
                    toast: true,
                    position: "top",
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    heightAuto: false
                });
                @break

                @case('error')
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('message') }}",
                    timer: 4000,
                    timerProgressBar: true,
                    toast: true,
                    position: "top",
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    heightAuto: false
                });
                @break

                @case('info')
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: "{{ session('message') }}",
                    timer: 4000,
                    timerProgressBar: true,
                    toast: true,
                    position: "top",
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    heightAuto: false
                });
                @break

                @default
            @endswitch
        @endif
        if (
            localStorage.getItem("color-theme") === "dark" ||
            (!("color-theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
</body>

</html>
