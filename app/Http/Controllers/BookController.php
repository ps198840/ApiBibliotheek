<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('naam')) return Book::where('naam', 'like', '%'.$request->naam.'%')->get();
        if ($request->has('sort')) return Book::orderBy($request->sort)->get();
        return Book::All();
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required',
            'year' => 'required',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response('{"Foutmelding":"Data niet correct"}', 400)
                ->header('Content-Type','application/json');
        }
        else return Book::create($request->all());
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required',
            'bestand' => 'required',
            'naam' => 'required'
        ]);
        if ($validator->fails()) {
            return response('{"Foutmelding":"Data niet correct"}', 400)
                ->header('Content-Type','application/json');
        }
        else $book->update($request->all());
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response('{"Book verwijderd"}');
    }
    public function indexFunctie(Request $request, $id)
    {
        if ($request->has('sort'))
            return Book::where('author_id',$id)->orderBy($request->sort)->get();
        return Book::where('author_id',$id)->get();
    }
    public function destroyFunctie($id)
    {
        Book::where('author_id', $id)->delete();
    }
}
