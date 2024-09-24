<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $allMovies = Movie::all();

        return view('movies.index', [
            'movies' => $allMovies
        ]);
    }

    public function view(int $id)
    {
        $movie = Movie::find($id);

        return view('movies.view',[
            'movie'=>$movie,
        ]);

    }

    public function creatForm()
    {
        return view('movies.create-form');
    }

    public function creatProcess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required',
            'synopsis' => 'required|min:3|max:255'
        ], [
            'title.required' => 'El titulo debe tener un valor',
            'price.required' => 'El precio debe tener un valor',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor'
        ]);

        $input = $request->only(['title', 'price', 'release_date', 'synopsis']);

        Movie::create($input);

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b> "'.e($input['title']). '"</b>sepublicó con exito.');
    }

    public function editForm(int $id){
        return view('movies.edit-form', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function editProcess(int $id, Request $request){
        $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required',
            'synopsis' => 'required|min:3|max:255'
        ], [
            'title.required' => 'El titulo debe tener un valor',
            'price.required' => 'El precio debe tener un valor',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor'
        ]);

        $input = $request->only(['title', 'price', 'release_date', 'synopsis']);

        $movie = Movie::findOrFail($id);

        $movie->update($input);

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b> "'.e($input['title']). '"</b>se editó con exito.');
    }

    public function deleteProcess(int $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b> "'.e($movie->title). '"</b>se borró con exito.');
    }
}
