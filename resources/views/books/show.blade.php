<x-layout>

@if (session()->has('error_message'))
    <div id="error-message" class="alert alert-danger text-red-700 bg-red-100 border border-red-400 px-4 py-3 rounded relative mb-8" role="alert">
        {{ session()->get('error_message') }}
    </div>
@endif
<div class="container mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl mt-10">
    <div class="px-4">
        <div class="flex justify-start mb-4 mt-4">
            <a href="{{ route('books.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Books
            </a>
        </div>
        <h1 class="text-4xl font-serif font-bold mb-4 mt-8 text-center p-4">{{ $book->judul }}</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-40 h-40 object-cover mr-4" style="width: 150px; height: 150px;">
                <div>
                    <p class="text-gray-700 mb-2 font-serif">Quantity: {{ $book->jumlah }}</p>
                    <p class="text-gray-600 font-serif">Category: {{ $book->kategori->category_name }}</p>
                </div>
            </div>
            <p class="text-gray-700 mb-4 font-serif">{{ $book->deskripsi }}</p>
            <div class="flex justify-between items-center">
                <a href="{{ asset('storage/' . $book->file_buku) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline font-serif" target="_blank">
                    <i class="fas fa-file-pdf"></i> Lihat File
                </a>
            </div>
        </div>
    </div>
</div>

</x-layout>