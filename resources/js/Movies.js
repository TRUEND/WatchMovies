
import Vue from 'vue';
import axios from 'axios';
import moment from 'moment';

//components
import NavMovieType from './components/movies/NavMovieType.vue';
import List from './components/movies/List.vue';
import Display from './components/movies/Display.vue';
import Pagination from './components/movies/pagination.vue';

new Vue({
    el:"#MovieApp",
    components:{
        NavMovieType,
        List,
        Display,
        Pagination
    },
    data:{
        Api_key: "217641a2c7e82793e8706423804e5904",
        Movies : null,
        Genres : null,
        isMainList: true,
        listAt: 'popular',
        isGenreList : false,
        ActualGenre : 1,
        IsDisplay: false,
        MovieInDisplay: {},
        FavoriteMovies:{},
        AuthUser: null,
    },
    methods:{
        GetSingleMovie: async function(movieId)
        {
            //clear variables
            this.MovieDbIdInDisplay = null;
            this.MovieInDisplay = {};
            let res = await axios.get(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${this.Api_key}&language=en-US`);
            res.data.release_date = moment(res.data.release_date).format('MMMM YYYY');

            return res;
        },
        //movieId : required -> Api movie id
        GetMovieInDisplay : async function(movieId)
        {
         
            //clear variable
            this.MovieInDisplay = {};

           this.GetSingleMovie(movieId).then(res=>{
                this.MovieInDisplay = res.data;
            });

            //set variables
            this.IsDisplay = true;

        },        
        /** 
         * typeList : is the main list @string
         * page : start page @integer
         * genre : Category id @integer
        */
        GetMovies(typeList = false, page = 1, genre = 1)
        {
            //check if you are using the category dropdown of genres or not
            if(typeList) 
            {
                this.isMainList = true;
                this.isGenreList = false;
                if(typeList != 'your_favorites'){
                    return `https://api.themoviedb.org/3/movie/${typeList}?api_key=${this.Api_key}&language=en-US&page=${page}`;
                }else{
                    return `/movies/${this.AuthUser.nickname}/favorites`;
                };
            }
            else if(genre)
            {
                this.isMainList = false;
                this.isGenreList = true;
                this.ActualGenre = genre;
                return `https://api.themoviedb.org/3/discover/movie?api_key=${this.Api_key}&language=en-US&with_genres=${genre}&page=${page}`;
            }
            
        },
        //functions for main list
        GetMovieFromList(listName, page = 1)
        {
            this.Movies = null;
            axios.get(this.GetMovies(listName, page)).
            then(res=> {
                let movies = res.data;
                
                //for favorites movies.
                if(listName == 'your_favorites')
                {
                    let favorites = {results:[], total_pages: 5000};
                    
                    //get each movie per request... I don't like that either. :)
                    movies.forEach(movie => {
                        this.GetSingleMovie(movie.api_movie_id).then(res=>{
                            favorites.results.push(res.data);
                        });
                    });
                    movies = favorites;

                }
                this.Movies = movies;
                
            });
        },
        
        //This function is gets the auth user its favorites movies
        GetAuthFavorites : async function()
        {
            this.Movies = null;
            let res = await axios.get(this.GetMovies('your_favorites'));
    
            this.FavoriteMovies = await res.data;
            
        },    
        GetFavoriteMovie(MovieDBId)
        {
            for(let i = 0; i < this.FavoriteMovies.length; i++)
            {
                if(this.FavoriteMovies[i].api_movie_id == MovieDBId)
                {
                    return this.FavoriteMovies[i];
                }
            }
        },

        //check if movie is auth's favorite already.
        checkIfMovieIsFavorite(MovieId)
        {
            for(let i = 0; i < this.FavoriteMovies.length; i++)
            {
                if(this.FavoriteMovies[i].api_movie_id == MovieId)
                {
                    return true;
                }
            }
            return false;
        },
      
        //type is the id of each genrer like action = 2
        GetMoviesByGenreType(type = 22, page = 1)
        {
            axios.get(this.GetMovies(false, page, type)).
            then(res=> {
                this.Movies = res.data;
            });
            
        },
         //Gets all available genders from the api
         GetListOfGenres()
         {
             axios.get(`https://api.themoviedb.org/3/genre/movie/list?api_key=${this.Api_key}&language=en-US`).
             then(res=> {
                 this.Genres = res.data;
             });
         },

        //Toggle favorite movie for a user
        ToggleMovieAsFavorite(Movie)
        {
            //check if user already favorite this movie
            if(!this.checkIfMovieIsFavorite(Movie.id))
            {
                //add movie as favorite
                axios.post(`/movies/${this.AuthUser.nickname}/store`, 
                {
                    api_movie_id: Movie.id,
                    nickname: this.AuthUser.nickname,
                }).then(res=>{
                    this.FavoriteMovies.push(res.data);
                });
            }
            else
            {
                let movieDb = this.GetFavoriteMovie(Movie.id);
            
                //remove favorite
                axios.delete(`/movies/favorites/${movieDb.id}`, 
                {
                    id: movieDb.id,
                    nickname: this.AuthUser.nickname,

                }).then(res=>{

                    if(res.data == 200)
                    {
                        //removes the deleted movie from the array.
                        for( var i = 0; i < this.FavoriteMovies.length; i++){ 
                            if (this.FavoriteMovies[i].id == movieDb.id) {
                                this.FavoriteMovies.splice(i, 1); 
                                break;
                            }
                         }
                    }
                     
                });
                
            }

        },
         //Get Autheticated User
         GetAuthUser : async function()
         {
             let res = await axios.post('/auth_user/ajax/');
             this.AuthUser = res.data;
         },

 
    },
    
    mounted:async function()
    {
        //The order here matters.
        await this.GetAuthUser();
        await this.GetListOfGenres();
        await this.GetMovieFromList('popular');
        await this.GetAuthFavorites();


        
    }   
});

