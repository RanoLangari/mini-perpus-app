<x-layout>
    <div class="container mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl mt-10">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
            aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="px-4">
            <h1 class="text-4xl font-bold mb-4 mt-8">All Categories</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-16 mb-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
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
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->category_name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $category->created_at }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2"><i
                                            class="fa-solid fa-pencil"></i></a>
                                    <a href="{{ route('categories.destroy', $category) }}"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline"><i
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
