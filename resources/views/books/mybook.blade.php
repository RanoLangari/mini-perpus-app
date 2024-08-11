<x-layout>
    @if (session()->has('error_message'))
        <div id="error-message" class="alert alert-danger text-red-700 bg-red-100 border border-red-400 px-4 py-3 rounded relative mb-8" role="alert">
            {{ session()->get('error_message') }}
        </div>
    @endif
    <div class="container mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl mt-10">
        <div class="px-4">
            <h1 class="text-4xl font-bold mb-4 mt-8 text-center">My Book</h1>
            <div class="flex justify-start mb-4">
                <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Buku
                </a>
            </div>
            @if (!$books->isEmpty())
                <div class="grid grid-cols-1 gap-6 mt-16 mb-8">
                    @foreach ($books as $book)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-20 h-20 object-cover mr-4">
                                <div>
                                    <h2 class="text-2xl font-bold">{{ $book->judul }}</h2>
                                    <p class="text-gray-600">Category: {{ $book->kategori->category_name }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4">{{ $book->deskripsi }}</p>
                            <p class="text-gray-700 mb-4">Quantity: {{ $book->jumlah }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ asset('storage/' . $book->file_buku) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Download</a>
                                <div>
                                    <a href="{{ route('books.edit', $book) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="#" data-modal-target="popup-modal-{{ $book->id }}" data-modal-toggle="popup-modal-{{ $book->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="popup-modal-{{ $book->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full p-4 md:p-0 bg-gray-900 bg-opacity-50">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $book->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menghapus Buku Ini?</h3>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" data-modal-hide="popup-modal-{{ $book->id }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, Saya Yakin
                                            </button>
                                        </form>
                                        <button data-modal-hide="popup-modal-{{ $book->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-full mb-8">
                    <h2 class="text-2xl font-bold mb-4">Buku Belum Ditambahkan</h2>
                    <p class="text-gray-600 mb-4">Segera Tambahkan Buku Yang Menarik</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>