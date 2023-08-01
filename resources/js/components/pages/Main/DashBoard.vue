<template>

    <div>
        <div class="recent-articles">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Dergi</h3>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div  class="col-xl-12 col-lg-12" v-if="magazin">
                        <div class=" float-right">
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <div class="active-cyan-3 active-cyan-4">
                                        <input id="search" type="text" class="form-control" v-model="search_input" v-on:input="dashboardSearch()" placeholder="Dergi Ara" aria-label="Dergi Ara" aria-describedby="button-addon1">
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">
                                <div class="single-recent mb-100" v-for="item in magazin">
                                    <div class="what-img">
                                        <img style="padding: 35px"  v-bind:src="item.magazine_img" alt="">
                                    </div>
                                    <div class="what-cap">

                                        <span class="color1">Dergi</span>
                                        <h4><router-link   :to="{name: 'magazine-detail', params: {id: item.id}}" style="color:black">{{item.magazine_name}}</router-link></h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination-area pb-45 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <paginate
                                        class="pagination"
                                        v-if="lastPage"
                                        :page-count="lastPage"
                                        :click-handler="pageChange"
                                        :prev-text="'<-'"
                                        :next-text="'->'"
                                        :prev-class="'btn btn-ligt'"
                                        :next-class="'btn btn-ligt'"
                                        :last-button-text="'text-black'"
                                        :page-link-class="'text-black'"
                                        :container-class="'pagination'"
                                        :page-class="'btn btn-light'">
                                    </paginate>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Paginate from 'vuejs-paginate';
import detail from './MagazineDetail';

export default {
    name: "DashBoard",
    components: {Paginate,detail},
    data() {
        return {
            magazin: {},
            meta: {},
            lastPage: "",
            item:{},
            search_input:''
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        pageChange(page) {
            this.fetchData(page)
        },
        fetchData(page = 1) {
            axios.get('magazin', {params: {page}}).then(response => {
                this.magazin = response.data.data;
                this.meta = response.data;
                this.lastPage = this.meta.last_page;
            })
        },
        createData(){
            this.item = {};
        },
        dashboardSearch(){
            if (this.search_input.length > 1){
                this.magazin = {};
                axios.get('/dashboardSearch/'+this.search_input).then(response => {
                    this.magazin = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                })
            }
        }
    }

}
</script>

<style scoped>
.pagination{
    background-color: red;
    color: #0b0b0b;
    column-width: 10px;
}
</style>
