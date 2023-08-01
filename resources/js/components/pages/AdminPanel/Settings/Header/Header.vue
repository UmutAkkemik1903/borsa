<template>

    <div class="pcoded-inner-content" >
        <div><header-modal :item="item" v-on:onSaved="refreshData" ></header-modal></div>
        <div class="pcoded-inner-content">
            <div class="pcoded-inner-content">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Header</h5>
                            </div>
                            <div class="card-block" >
                                <h4 class="sub-title">Sitenizin header alanını buradan düzenleyebilirsiniz</h4>

                                <form v-for="asd in header">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div >
                                            <button  style="border-radius: 20px;margin-left: 1250px;float: right" @click="editData(asd.id)" class="header-right btn btn-primary"><i class="fa fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div style="!important;margin-right: 250px">
                                    <label class="col-sm-2 col-form-label">Logo</label>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <img style="width: 50px; height: 50px" v-bind:src="asd.logo" alt="">
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Reklam</label>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <img style="width: 50px; height: 50px" v-bind:src="asd.advertisement" alt="">
                                        </div>
                                    </div>
                                    </div>
                                    <hr>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input disabled v-model="asd.title"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Instagram</label>
                                        <div class="col-sm-10">
                                            <input  v-model="asd.instagram"  class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Youtube</label>
                                        <div class="col-sm-10">
                                            <input disabled v-model="asd.youtube" class="form-control">

                                        </div>
                                    </div>
                                    <div  class="form-group row">
                                        <label class="col-sm-2 col-form-label">Web</label>
                                        <div  class="col-sm-10">
                                            <input disabled v-model="asd.web"  class="form-control">

                                        </div>
                                    </div>
                                    <div class="row" style="!important;margin-right: 50px">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderModal from "./HeaderModal";
export default {
    components:{HeaderModal},
    data() {
        return {
            header:{},
            meta:{},
            item:{}
        }
    },
    created() {
        this.headerList()
    },
    methods:{
        fetchData(){
            axios.get('header')
                .then(response => {
                    this.header = response.data.data;
                    this.meta = response.data;
                })
        },

        headerList(){
            axios.get('header')
                .then(response => {
                    this.header = response.data.data;
                    this.meta = response.data;
                })
        },
        refreshData(){
            this.headerList();
        },
        createData(){
            this.item = {}
            $('#headerModal').modal('show');
        },
        editData(id) {
            axios.get("/header/" + id)
                .then(response => {
                    this.item = response.data.[0];
                    $('#headerModal').modal('show')
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        },
    }

}


</script>


