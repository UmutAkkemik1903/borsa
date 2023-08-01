<template>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <div  class="col-xl-12 col-lg-12" v-if="item">
                                <div class=" float-right">
                                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <div class="active-cyan-3 active-cyan-4">
                                                <input id="search" type="text" class="form-control" v-model="search_input" v-on:input="magazineDetailSearch()" placeholder="Makale Ara" aria-label="Makale Ara" aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover" >
                                    <thead>
                                    <tr>
                                        <th>Makale Adı</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="i in item">
                                        <td><router-link   :to="{name: 'content-detail', params: {id: i.id}}" style="color:black">{{i.name}}</router-link></td>
                                        <td></td>
                                    </tr>
                                    </tbody>

                                </table>
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
        <br>
        <br>
    </div>
</template>
<script>
import Paginate from "vuejs-paginate";
export default {

    name: "detailModal",
    components:{Paginate},
    data(){
        return{
            item: {},
            search_input:'',
            lastPage:"",
            meta:{}
        }
    },
    created() {
        this.getData();
    },
    methods:{
        pageChange(page) {
            this.getData(page)
        },
        getData(page = 1){
            axios.get("/magazin/" + this.$route.params.id,{params: {page}})
                .then(response => {
                    this.item = response.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
        magazineDetailSearch(){
            if (this.search_input.length > 1){
                this.item = {};
                axios.get('/magazineDetailSearch/'+this.search_input).then(response => {
                    this.item = response.data.data;
                    this.meta = response.data;
                    this.lastPage = this.meta.last_page;
                })
            }
        }
    }

}

</script>

<style scoped>

</style>
