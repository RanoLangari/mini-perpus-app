<?php

namespace App\Http\Controllers;

use App\Exports\bookExport;
use App\Models\Book;
use App\Models\bookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\FileUploadService;

class BookController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    public function index(Request $request)
    {
        $kategori_id = $request->get('kategori_id', '');
        $books = $kategori_id ? Book::where('kategori_id', $kategori_id)->get() : Book::all();
        $categories = bookCategory::all();
        return view('books.index', compact('books', 'categories', 'kategori_id'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role == 'user' && Book::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error_message', 'Pengguna hanya dapat mengunggah satu buku, silahkan hapus atau perbarui buku yang sudah ada.');
        }
        $categories = bookCategory::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file_buku' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Membuat nama file unik dengan string acak
        $fileBukuName = date('Ymd-His') . '_' . $request->user()->id . '_' . Str::random(10) . '.' . $request->file('file_buku')->getClientOriginalExtension();
        $coverBukuName = date('Ymd-His') . '_' . $request->user()->id . '_' . Str::random(10) . '.' . $request->file('cover_buku')->getClientOriginalExtension();

        // Menyimpan file dengan nama unik
        $fileBukuPath = $request->file('file_buku')->storeAs('file_buku', $fileBukuName, 'public');
        $coverBukuPath = $request->file('cover_buku')->storeAs('cover_buku', $coverBukuName, 'public');

        Book::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'file_buku' => $fileBukuPath,
            'cover_buku' => $coverBukuPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('mybook');
    }

    public function myBook()
    {
        $categories = bookCategory::all();
        if (Auth::user()->role == 'admin') {
            $books = Book::with('kategori')->get();
        } else {
            $books = Book::where('user_id', Auth::id())->with('kategori')->get();
        }
        return view('books.mybook', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
    public function edit($id)
    {
        if (Auth::user()->role == 'admin') {
            $book = Book::findOrFail($id);
        } else {
            $book = Book::where('id', $id)->where('user_id', Auth::id())->first();
            if (!$book) {
                return redirect()->route('books.index')->with('error_message', 'Buku tidak ditemukan.');
            }
        }
        $categories = bookCategory::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'file_buku' => 'file|mimes:pdf,doc,docx|max:5120',
            'cover_buku' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['judul', 'kategori_id', 'deskripsi', 'jumlah']);

        $data['file_buku'] = $this->fileUploadService->handleFileUpload($request, 'file_buku', $book->file_buku, 'file_buku');
        $data['cover_buku'] = $this->fileUploadService->handleFileUpload($request, 'cover_buku', $book->cover_buku, 'cover_buku');

        $book->update($data);
        return redirect()->route('mybook');
    }

    public function destroy(Book $book)
    {
        if (Auth::user()->id != $book->user_id && Auth::user()->role != 'admin') {
            return redirect()->route('mybook')->with('error_message', 'Anda tidak memiliki hak akses untuk melakukan ini.');
        }
        if ($book->file_buku) {
            Storage::disk('public')->delete($book->file_buku);
        }
        if ($book->cover_buku) {
            Storage::disk('public')->delete($book->cover_buku);
        }
        $book->delete();
        return redirect()->route('mybook');
    }

    public function export()
    {
        return Excel::download(new bookExport, 'books.xlsx');
    }

}
