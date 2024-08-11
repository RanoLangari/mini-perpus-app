<x-layout>
    <div class="container mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl mt-10">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
            aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="px-4">
            <h1 class="text-4xl font-bold mb-4 mt-8 text-center">Daftar Kategori Buku</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8 mb-4">
                <div class="flex justify-start mb-4">
                    <button onclick="addCategory()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Kategori Buku
                    </button>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-separate">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-blue-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Details</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->category_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->created_at }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2"
                                        onclick="editCategory('{{ route('categories.update', $category) }}', '{{ $category->category_name }}')"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="deleteCategory('{{ route('categories.destroy', $category) }}')"><i
                                            class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
<script>
    async function addCategory() {
        try {
            const { value: categoryName } = await Swal.fire({
                title: 'Tambah Kategori Buku',
                input: 'text',
                inputLabel: 'Nama Kategori',
                inputPlaceholder: 'Masukkan nama kategori',
                showCancelButton: true,
                confirmButtonText: 'Tambah',
                showLoaderOnConfirm: true,
                preConfirm: (categoryName) => {
                    return fetch('{{ route('categories.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            category_name: categoryName
                        })
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        Swal.fire({
                            title: 'Kategori berhasil ditambahkan!',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }).catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            if (categoryName) {
                Swal.fire({
                    title: 'Kategori berhasil ditambahkan!',
                    icon: 'success'
                }).then(() => {
                    location.reload();
                });
            }
        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error'
            });
        }
    }
</script>
<script>
    async function editCategory(url, categoryName) {
        try {
            const { value: newCategoryName } = await Swal.fire({
                title: 'Edit Kategori Buku',
                input: 'text',
                inputLabel: 'Nama Kategori',
                inputValue: categoryName,
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: (newCategoryName) => {
                    return fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            category_name: newCategoryName,
                            _method: 'PUT'
                        })
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                    Swal.fire({
                        title: 'Kateogri berhasil diubah!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                        
                    }).then(() => {
                        location.reload();
                    });
                    }).catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            if (newCategoryName) {
                Swal.fire({
                    title: 'Kategori berhasil diubah!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            }
        } catch (error) {
            console.error('Error updating category:', error);
        }
    }
</script>

<script>
    async function deleteCategory(url) {
        try {
            const result = await Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Hal Ini Akan Berpengaruh pada Data Buku yang Terkait dengan Kategori Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });

            if (result.isConfirmed) {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                });

                if (!response.ok) {
                    throw new Error(response.statusText);
                }

                await Swal.fire({
                    title: 'Deleted!',
                    text: 'Data kategori berhasil dihapus.',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error'
            });
        }
    }
</script>
