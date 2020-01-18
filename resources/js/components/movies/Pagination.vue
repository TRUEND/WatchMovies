<template>
    <div v-if="!isFavorite" class='container position-relative w-100'>
        <nav id='Pagination'>
            <ul class="pagination">

                <li class="page-item " :class="{'disabled':disablePreviousButton}">
                    <span @click="ChangePage(false, '-')" class="page-link">Previous</span>
                </li>

                <li v-for="(link,index) in links" :key="index" class="page-item">
                    <span @click="ChangePage(link)" class="page-link" 
                    :class="{'active': validateLink(link)}">{{link}}</span>
                    
                </li>
                <li class="page-item">
                    <span @click="ChangePage(false, '+')" class="page-link">Next</span>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    created()
    {
        //gets the maximum amount of pages
        setTimeout(()=>{
            this.maxLinks = this.$root.Movies.total_pages;
        },1000);
    },
    data()
    {
        return{
            maxLinks: 5,
            actualLink: 1,
            maxAllowed: 5,
            links:[1,2,3,4,5],
            disablePreviousButton: true,
        }
    },
    computed:{
        Movies()
        {
            return this.$root.Movies;
        },
        isMainList()
        {
            return this.$root.isMainList;
        },
        isGenreList()
        {
            return this.$root.isGenreList;
        },
        ActualGenre()
        {
            return this.$root.ActualGenre;
        },
        listAt()
        {
            return this.$root.listAt;
        },
        isFavorite()
        {
            return this.$root.listAt == 'your_favorites';
        }
    
    
    },
    methods:{
        //paginate method
        ChangePage(link, arrow = false)
        {
            if(arrow == false)
            {
                this.actualLink = link;
            }
            else
            {
                link = this.actualLink;
                arrow == '-' && link > 1 ? link-- : link++;
                this.actualLink = link;
            }
            
            //clear the links
            this.links = [];
            //get the min and maximun based on the actual link
            var min = link - (Math.floor(this.maxAllowed / 2));
            var max = link + (Math.floor(this.maxAllowed / 2));

            //updates the array with the right values.
            for(var i = min;i <= max && i <= this.maxLinks; i++)
            {
                if(i > 0){this.links.push(i)}
            }

            //change page through the genrelist
            if(this.isGenreList)
            {
                this.$root.GetMoviesByGenreType(this.ActualGenre, link);
            }
             //change page through the Mainlist
            else if(this.isMainList)
            {
                let at = this.listAt.toLowerCase();

                this.$root.GetMovieFromList(at, link);
            }

            //check if user is in the first page
            this.disablePreviousButton = (link == 1) ? true : false;
            
            //after everything scroll to the top
            document.body.
            scrollIntoView({behavior: "smooth"});
        },

        validateLink(link)
        {
            return this.actualLink == link;
        },
        checkIfMovieIsFavorite(MovieId)
        {
            return this.$root.checkIfMovieIsFavorite(MovieId);
        }
    },
    
}
</script>

