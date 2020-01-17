import axios from 'axios';


export class Movie
{
    constructor()
    {
        this.Movie = null;
        this.Genres = null;
    
    }

    static test()
    {
        console.log("hello world");
    }
    
    static GetMovies(type = 'popular', page = 1)
    {
        return `https://api.themoviedb.org/3/movie/${type}?api_key=217641a2c7e82793e8706423804e5904&language=en-US&page=${page}`;
    }

    static GetPopular()
    {
        axios.get(this.GetMovies('popular', 1)).
        then(res=> {
            return res.data;
        }).catch(error=> {
            console.log(error.response.data);
        });
        
    }

    static GetTopRated()
    {
        axios.get(this.GetMovies('top_rated', 1)).
        then(res=> {
            return res.data;
        }).catch(error=> {
            console.log(error.response.data);
        });
    }
     GetListOfGenres()
    {
        axios.get('https://api.themoviedb.org/3/genre/movie/list?api_key=217641a2c7e82793e8706423804e5904&language=en-US').
        then(res=> {
            return res.data;
        }).catch(error=> {
            console.log(error.response.data);
        });
    }
}

