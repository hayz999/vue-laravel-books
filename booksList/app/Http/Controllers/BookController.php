<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests;
use App\Http\Resources\Book as BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(15);

        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $request->isMethod('put') ? Book::findOrFail($request->book_id) : new Book;

        $book->id = $request->input('book_id');
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publishedDate = $request->input('publishedDate');
        $book->genre = $request->input('genre');

        if ($book->save()) {
            return new BookResource($book);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->delete()) {
            return new BookResource($book);
        }
    }
}
