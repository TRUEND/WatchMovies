<template>
    
    <div v-if="IsDisplay" id="Display">
        <div class="container position-relative h-100">
            <div class="close p-0" @click="CloseDisplay()">
                &times;
            </div>
            <div class="row h-100">

                <div class="col-md-5 pb-5 h-100">
                    <img class="w-100 h-100" 
                    :src="`https://image.tmdb.org/t/p/w500/${MovieInDisplay.poster_path}`" alt="">
                </div>

                <div class='col-md-7 position-relative'>
                    <h2>{{MovieInDisplay.title}}</h2>
                    <hr class="line" style="border-color:#fff">
                    <p><b>Released: {{MovieInDisplay.release_date}}</b> | <b>{{MovieInDisplay.runtime}} mins</b></p>

                    <div id="description">
                        <h6>Overview</h6>
                        <p>{{MovieInDisplay.overview}}</p>
                    </div>

                    
                    <button @click="ToggleMovieAsFavorite(MovieInDisplay)" id="AddFavorite" class="btn" 
                    :class="{'favorited': checkIfMovieIsFavorite(MovieInDisplay.id)}" 
                        title="add to your favorite list">

                        {{checkIfMovieIsFavorite(MovieInDisplay.id) ? 'Remove' : 'Add to favorite'}}

                        <img :src="'/_icons/heart.png'" alt="">
                    </button>
                </div>

            </div>
        </div>

    </div>


</template>

<script>
export default {

    methods:{
        CloseDisplay()
        {
            this.$root.IsDisplay = false;
        },
        ToggleMovieAsFavorite(Movie)
        {
            this.$root.ToggleMovieAsFavorite(Movie);
        },
        checkIfMovieIsFavorite(MovieId)
        {
            return this.$root.checkIfMovieIsFavorite(MovieId);
        }
        
    },
    computed:{
        IsDisplay()
        {
            return this.$root.IsDisplay;
        },
        MovieInDisplay()
        {
            return this.$root.MovieInDisplay;
        },
        MovieDbIdInDisplay()
        {
            return this.$root.MovieDbIdInDisplay;
        },
    },
    

}
</script>
