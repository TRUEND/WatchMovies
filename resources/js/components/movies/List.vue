<template>
    <div id="ListVue">

        <div v-if="MoviesHasResults" class="container" >
            
            <div class="row">
                <div v-for="movie in Movies.results" :key="movie.id" class="col-2 mb-3">
                    <div class="card border-0" @click="GetMovieInDisplay(movie.id)">
                        
                        <img :src="`https://image.tmdb.org/t/p/w200/${movie.poster_path}`" class="card-img-top" alt="">
                    
                        <div class="card-body py-2 px-0">
                            <h6 class="card-title m-0 p-0 text-light">{{movie.title}}</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div>
            <h1 class="text-lg-light">You do not have any movies added as favorite.</h1>
        </div>  

    
    </div>

</template>

<script>
export default {
    data(){
        return{

        }
    },
    computed:{
        Movies()
        {
            return this.$root.Movies;
        },
        MoviesHasResults()
        {
            return this.Movies != null;
        },
        isFavorite()
        {
            return this.$root.listAt == 'your_favorites';
        },
       
      
    },
    methods:{
        GetMovieInDisplay(movieId)
        {
            this.$root.GetMovieInDisplay(movieId);
        },
        
    },
 

    

}
</script>

