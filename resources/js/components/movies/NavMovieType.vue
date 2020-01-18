<template>
    <div class="container" id="MoviesNavBar">
        <ul class="nav nav-tabs">
            <!--main list-->
            <li v-for="(item, index) in List" :key="index" class="main-list nav-item" :class="{'active': MainListActivedItem(item)}"
            @click="GetMovieFromList(item)">
                <span role="button" class="nav-link">{{item | remakeListName}}</span>
            </li>
            
            <!--genres-->
            <li class="genres-list nav-item dropdown ml-auto position-relative">
                <a class="nav-link dropdown-toggle genres-list-dropdown" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">Genres</a>
                <div class="dropdown-menu">
                    <span v-for="genre in Genres" :key="genre.id" class="dropdown-item"
                    @click="GetMoviesByGenreType(genre.id)">
                        {{genre.name}}
                    </span>
                    
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data()
    {
        return {
            List:['popular', 'top_rated', 'upcoming', 'your_favorites'],
        }
    },
    computed:{
        Genres()
        {
            if(this.$root.Genres){
                return this.$root.Genres.genres;
            }
        },
        listAt()
        {
            return this.$root.listAt;
        }
    },
    methods:
    {
        GetMovieFromList(stringType)
        {   
            this.$root.GetMovieFromList(stringType);

            this.$root.listAt = stringType;
        },
        MainListActivedItem(value)
        {
            return value == this.$root.listAt;
        },
        GetMoviesByGenreType(id = 22)
        {
            console.log(id);
            this.$root.GetMoviesByGenreType(id);
        }
    },
    filters:{
        //Display nicely the name of each list item
        remakeListName(value)
        {
            if(value.match("_"))
            {
                return value.replace("_", " ");
            }
            else if(value == 'upcoming'){
                return 'up coming';
            }else{
                return value;
            }
            
        }
    }
}
</script>

