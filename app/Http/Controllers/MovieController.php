<?php

namespace App\Http\Controllers;

use App\Movie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource for list of user's favorites.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites($nickname)
    {
        $user = User::where('nickname', $nickname)->first();
        return $user->movies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Movie::class);

        $newMovie = $request->validate([
            'api_movie_id' => 'integer|required',
            'nickname' => 'string|required|max:20'
        ]);

        $movie = Movie::create($newMovie);
        return $movie;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($movieId)
    {
        $movie = Movie::where('id', $movieId)->first();
        $movie->delete();
        return 200;

    }
}
