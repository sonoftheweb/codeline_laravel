<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    /*public function newFilm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required',
            'rating' => 'required',
            'ticket_price' => 'required',
            'country' => 'required',
            'genre' => 'required',
            'photo' => 'required'
        ]);

        $newFilm = new Film();
        $newFilm->name = $request->name;
        $newFilm->description = $request->description;
        $newFilm->release_date = $request->release_date;
        $newFilm->rating = $request->rating;
        $newFilm->ticket_price = $request->ticket_price;
        $newFilm->country = $request->country;
        $newFilm->genre = $request->genre;
        $newFilm->photo = $request->photo;

        if ($newFilm->save()) {
            return redirect('/');
        }
    }*/

    public function index(Request $request)
    {
        $films = Film::all();
        return view('welcome', compact('films'));
    }

    public function view($id)
    {
        $film = Film::find($id);
        $title = $film->name;
        return view('view-film',compact('film', 'title'));
    }
}
