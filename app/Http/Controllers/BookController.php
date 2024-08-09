<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\bookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $kategori_id = $request->get('kategori_id', '');
        $books = $kategori_id ? Book::where('kategori_id', $kategori_id)->get() : Book::all();
        $categories = bookCategory::all();
        return view('books.index', compact('books', 'categories', 'kategori_id'));
    }

    public function create()
    {
        if (Auth::user()->role == 'user' && Book::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error_message', 'Anda sudah mengupload buku.');
        }
        $categories = bookCategory::all();
        return view('books.create', compact('categories'))->with('error_message', 'Anda sudah mengupload buku.');
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
        $fileBukuName = date('Ymd-His') . '_' . $request->user()->id . '_' . Str::random(10);
        $coverBukuName = date('Ymd-His') . '_' . $request->user()->id . '_' . Str::random(10);

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

        return redirect()->route('books.index');
    }

    public function myBook()
    {
        $categories = bookCategory::all();
        $books = Book::where('user_id', Auth::id())->with('kategori')->get();
        return view('books.mybook', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }
    public function edit($id)
    {
        $book = Book::findOrFail($id);
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

        if ($request->hasFile('file_buku')) {
            $fileBukuName = date('Ymd') . '_' . $request->user()->id . '_' . $request->file('file_buku')->getClientOriginalName();
            $fileBukuPath = $request->file('file_buku')->storeAs('file_buku', $fileBukuName, 'public');
            $data['file_buku'] = $fileBukuPath;
        } else {
            $data['file_buku'] = $book->file_buku;
        }

        if ($request->hasFile('cover_buku')) {
            $coverBukuName = date('Ymd') . '_' . $request->user()->id . '_' . $request->file('cover_buku')->getClientOriginalName();
            $coverBukuPath = $request->file('cover_buku')->storeAs('cover_buku', $coverBukuName, 'public');
            $data['cover_buku'] = $coverBukuPath;
        } else {
            $data['cover_buku'] = $book->cover_buku;
        }

        $book->update($data);
        return redirect()->route('books.index');
    }

    # Start of Selection
    public function destroy(Book $book)
    {
        if ($book->file_buku) {
            Storage::disk('public')->delete($book->file_buku);
        }
        if ($book->cover_buku) {
            Storage::disk('public')->delete($book->cover_buku);
        }
        $book->delete();
        return redirect()->route('books.index');
    }

}
