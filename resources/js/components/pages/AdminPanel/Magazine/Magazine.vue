<template>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div><magazine-modal :item="item" v-on:onSaved="refreshData" ></magazine-modal></div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Dergi</h5>
                            <span>Derginizi buradan tanımlayabilirsiniz!</span>
                            <div class="card-header-right">
                                <button style="border-radius: 45px" @click="createData" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div  class="col-xl-12 col-lg-12" v-if="magazine">
                                <div class=" float-right">
                                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <div class="input-group">
                                            <div class="active-cyan-3 active-cyan-4">
                                                <input  type="text" v-model="search_input" v-on:input="magazineSearch()" placeholder="Makale Ara" aria-label="Makale Ara" aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" >
                                    <thead>
                                    <tr>
                                        <th>Dergi</th>
                                        <th>Dergi Adı</th>
                                        <th></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in magazine" >
                                        <td> <img style="width: 75px; height: 75px" v-bind:src="item.magazine_img" alt=""></td>
                                        <td>{{ item.magazine_name}}</td>
                                        <td>
                                            <button style="border-radius: 20px;" @click="editData(item.id)" class="header-right btn btn-primary"><i class="fa fa-pencil"></i></button>
                                            <button @click="deleteData(item.id)" style="border-radius: 20px;" class="btn btn-danger "><i class="fa fa-trash "></i></button>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <nav aria-label="Page navigation example">
                                    <paginate
                                        v-if="lastPage"
                                        :page-count="lastPage"
                                        :click-handler="pageChange"
                                        :prev-text="'GERİ'"
                                        :next-text="'İLERİ'"
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
        <div id="styleSelector">
        </div>
    </div>

</template>

<script>
import MagazineModal from "./MagazineModal";
import Paginate from 'vuejs-paginate';
export default {
    name: "Magazine",
    components:{MagazineModal, Paginate},
    data(){
        return {
            magazine:{},
            meta:{},
            item:{},
            lastPage:"",
            search_input:''
        }
    },
    created() {
        this.fetchData()
    },
    methods:{
        pageChange(page) {
            this.fetchData(page);
        },
        fetchData(page = 1){
            axios.get('magazine', {params:{page}}).then(response => {
                this.magazine = response.data.data;
                this.meta = response.data;
                this.lastPage = this.meta.last_page;
            })
        },
        createData(){
            this.item = {};
            $('#magazineModal').modal('show');
        },
        refreshData(item){
            this.fetchData();
        },
        editData(id) {
            axios.get("/magazine/" + id)
                .then(response => {
                    this.item = response.data.[0];
                    $('#magazineModal').modal('show')
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
        deleteData(id) {
            swal.fire({
                text: 'Silmek istediğinizden emin misiniz?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.value) {
                    axios.delete("/magazine/" + id)
                        .then(response => {
                            this.fetchData();
                            toastr.warning('Kayıt Silindi', 'Dergi')
                        })
                        .catch(error => {
                            if (error.response != null)
                                this.errorMessage = error.response.data.message;
                            else
                                this.errorMessage = error.message;
                        });
                }
            })
        },
        magazineSearch(){
            if (this.search_input.length > 1){
                this.magazine = {};
                axios.get('/magazineSearch/'+this.search_input).then(response => {
                    this.magazine = response.data.data;
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
