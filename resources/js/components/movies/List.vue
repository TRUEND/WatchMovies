<template>
    <div id="ListVue">

        <div class="container">
            
            <div v-if="MoviesHasResults || UserHasFavoritesMovies" class="row_movies row">
                <div v-for="movie in movies.results" :key="movie.id" class="col-2 mb-3">
                    <div class="card border-0" @click="GetMovieInDisplay(movie.id)">
                        
                        <img :src="`https://image.tmdb.org/t/p/w200/${movie.poster_path}`" class="card-img-top" alt="">
                    
                        <div class="card-body py-2 px-0">
                            <h6 class="card-title m-0 p-0 text-light">{{movie.title}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else-if="!UserHasFavoritesMovies">
                <h1 class="text-light text-center py-5">You do not have favorite movies.</h1>
                <p class="text-center text-light">To add a movie to this list you must click on the heart block in each movie you desire to be your favorites.</p>
            </div>  

            <div v-else>
                <h1 class="text-light text-center py-5">There are no movies in this category.</h1>
            </div>

        </div>
    
    </div>

</template>

<script>
export default {
    data(){
        return{
            numOfMovies : 0,
        }
    },
    computed:{
        MoviesHasResults()
        {
            return this.numOfMovies > 0;
        },
        UserHasFavoritesMovies()
        {
            return this.$root.FavoriteMovies.length > 0;
        },
        isFavorite()
        {
            return this.$root.listAt == 'your_favorites';
        },
        movies()
        {
            return this.$root.Movies;
        }
       
    },
    methods:{
        GetMovieInDisplay(movieId)
        {
            this.$root.GetMovieInDisplay(movieId);
        },
        
    },
    watch:{
        movies()
        {
            this.numOfMovies = this.$root.Movies.results.length;
        }
    },
}
</script>

