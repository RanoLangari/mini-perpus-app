<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            @if (session()->has('error_message'))
            <div class="alert alert-danger text-red-700 bg-red-100 border border-red-400 px-4 py-3 rounded relative mb-8" role="alert">
                {{ session()->get('error_message') }}
            </div>  
                
            @endif
            <img class="mx-auto h-12 w-auto" src="{{ asset('perpus.jpg') }}" >
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Daftar Akun Baru
            </h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ url('register') }}" method="POST">
            @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @if ($errors->has('email'))
                            <span class="text-red-600">{{ $errors->first('email') }}</span>
                        @endif
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Lengkap</label>
                    <div class="mt-2">
                        <input id="name" name="name" autocomplete="name" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @if ($errors->has('name'))
                            <span class="text-red-600">{{ $errors->first('name') }}</span>
                        @endif
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password"
                            autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-red-600">{{ $errors->first('password') }}</span>
                        @endif
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password_confirmation" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar Akun</button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>