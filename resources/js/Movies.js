import Vue from 'vue';

import axios from 'axios';
import moment from 'moment';

//my classes 

//components
import NavMovieType from './components/movies/NavMovieType.vue';
import List from './components/movies/List.vue';
import Display from './components/movies/Display.vue';
import Pagination from './components/movies/pagination.vue';

//217641a2c7e82793e8706423804e5904
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
        
    },
    methods:{
        GetMovieInDisplay(movieId)
        {
            axios.get(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${this.Api_key}&language=en-US`).
            then(res=> {
                res.data.release_date = moment(res.data.release_date).format('MMMM YYYY');
                this.MovieInDisplay = res.data;
                this.IsDisplay = true;
                console.log(this.MovieInDisplay);
            }).catch(error=> {
                console.log(error.response.data);
            });
        },        
        /** 
         * typeList : is the main list @string
         * page : start page @integer
         * genre : Category id @integer
        */
        GetMovies(typeList = false, page = 1, genre = 1)
        {
            if(typeList) 
            {
                this.isMainList = true;
                this.isGenreList = false;
                return `https://api.themoviedb.org/3/movie/${typeList}?api_key=${this.Api_key}&language=en-US&page=${page}`;
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
            axios.get(this.GetMovies(listName, page)).
            then(res=> {
                this.Movies = res.data;
            }).catch(error=> {
                console.log(error.response.data);
            });
        },
       
      
        //type is the id of each genrer like action = 2
        GetMoviesByGenreType(type = 22, page = 1)
        {
            axios.get(this.GetMovies(false, page, type)).
            then(res=> {
                this.Movies = res.data;
            }).catch(error=> {
                console.log(error.response.data);
            });
            
        },
         //Gets all available genders from the api
         GetListOfGenres()
         {
             axios.get(`https://api.themoviedb.org/3/genre/movie/list?api_key=${this.Api_key}&language=en-US`).
             then(res=> {
                 this.Genres = res.data;
             }).catch(error=> {
                 console.log(error.response.data);
             });
         },
 
    },

    mounted()
    {
        //default request
        this.GetListOfGenres();
        this.GetMovieFromList('popular');

    }
});

