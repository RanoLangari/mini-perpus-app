<x-layout>
    <div class="container mx-auto px-4">
        @if ($errors->any())
            <div id="error-message" class="alert alert-danger text-red-700 bg-red-100 border border-red-400 px-4 py-3 rounded relative mb-8"
                role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif
        <form action="{{ route('books.store') }}" method="POST" class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-10" enctype="multipart/form-data">
            @csrf
           
            <div class="mx-auto max-w-2xl text-center mt-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tambah Buku</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Masukkan detail buku yang ingin ditambahkan.</p>
            </div>
            <div class="mx-auto mt-16 max-w-xl sm:mt-8">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="judul" class="block text-sm font-semibold leading-6 text-gray-900">Judul Buku</label>
                        <div class="mt-2.5">
                            <input type="text" name="judul" id="judul" autocomplete="off" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>
                <div class="mt-2.5">
                    <label for="kategori_id" class="block text-sm font-semibold leading-6 text-gray-900">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold leading-6 text-gray-900">Deskripsi</label>
                    <div class="mt-2.5">
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required></textarea>
                    </div>
                </div>
                <div>
                    <label for="jumlah" class="block text-sm font-semibold leading-6 text-gray-900">Jumlah</label>
                    <div class="mt-2.5">
                        <input type="number" name="jumlah" id="jumlah" autocomplete="off" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>
                <div>
                    <label for="file_buku" class="block text-sm font-semibold leading-6 text-gray-900">File Buku</label>
                    <div class="mt-2.5">
                        <input type="file" name="file_buku" id="file_buku" class="block w-full text-gray-900" required>
                    </div>
                </div>
                <div>
                    <label for="cover_buku" class="block text-sm font-semibold leading-6 text-gray-900">Cover Buku</label>
                    <div class="mt-2.5">
                        <input type="file" name="cover_buku" id="cover_buku" class="block w-full text-gray-900" required>
                    </div>
                </div>
            </div>
            <div class="mt-10 mb-8">
                <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Buku</button>
            </div>
    </div>
</x-layout>