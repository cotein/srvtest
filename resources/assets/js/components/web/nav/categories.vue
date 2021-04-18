<template>
    <div class="tt-collapse open">
        <h3 class="tt-collapse-title">CATEGORÍAS</h3>
        <div class="tt-collapse-content">
            <ul class="tt-list-row" >
                <category_link v-for="(category, index) in Categories" :key="index" :category="category"></category_link>
            </ul>
        </div>
    </div>
</template>

<script>
import category_link from './category-link';
import {mapActions, mapState, mapGetters} from 'vuex';
export default {
    components : {category_link},
    data(){
        return {
            active_link : null,
            
        }
    },
    methods : {

    },

    computed : {
        ...mapGetters([
            'Categories',
        ]),
    },

    mounted(){
       
        this.$store.dispatch('fetchCategories');
    }
}
</script>
<style scoped>
    button {
        background: none!important;
        border: none;
        padding: 0!important;
        /*optional*/
        font-family: arial, sans-serif;
        /*input has OS specific font-family*/
        color: #069;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
    