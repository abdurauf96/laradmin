<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $books = Book::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('author', 'LIKE', "%$keyword%")
                ->orWhere('year', 'LIKE', "%$keyword%")
                ->orWhere('publisher', 'LIKE', "%$keyword%")
                ->orWhere('pages', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $books = Book::latest()->paginate($perPage);
        }

        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        return view('admin.books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'author' => 'required',
			'year' => 'required',
			'publisher' => 'required',
			'pages' => 'required'
		]);
        $requestData = $request->all();

        Book::create($requestData);

        return redirect('admin/books')->with('flash_message', 'Book added!');
    }

    public function show(Book $book): View
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $this->validate($request, [
			'title' => 'required',
			'description' => 'required',
			'author' => 'required',
			'year' => 'required',
			'publisher' => 'required',
			'pages' => 'required'
		]);

        $requestData = $request->all();
        $book->update($requestData);

        return redirect('admin/books')->with('flash_message', 'Book updated!');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect('admin/books')->with('flash_message', 'Book deleted!');
    }
}
