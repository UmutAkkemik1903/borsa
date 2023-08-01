<template>
    <div class="pcoded-inner-content">
        <div><about-modal :item="item" v-on:onSaved="refreshData" ></about-modal></div>
        <div class="pcoded-inner-content">
            <div class="pcoded-inner-content">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div  class="card-header">
                                <h5>Hakkımızda</h5>

                            </div>
                            <div class="card-block">
                                <h4 class="sub-title">Site Bilgisi</h4>
                                <form v-for="item in about">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div >
                                            <button style="border-radius: 20px;margin-left: 1250px;float: right" @click="editData(item.id)" class="header-right btn btn-primary"><i class="fa fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Round Input</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" v-model="item.title" class="form-control form-control-round">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Textarea</label>
                                        <div class="col-sm-10">
                                            <textarea disabled rows="10" cols="10" v-model="item.content"  class="form-control"></textarea>
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
import AboutModal from "./AboutModal";
export default {
    components:{AboutModal},
    data() {
        return {
            about:{},
            meta:{},
            item:{}
        }
    },
    created() {
        this.aboutList()
    },
    methods:{
        fetchData(){
            axios.get('about')
                .then(response => {
                    this.about = response.data.data;
                    this.meta = response.data;
                })
        },
        aboutList(){
            axios.get('about')
                .then(response => {
                    this.about = response.data.data;
                    this.meta = response.data;
                })
        },
        refreshData(){
            this.aboutList();
        },
        createData(){
            this.item = {}
            $('#aboutModal').modal('show');
        },
        editData(id) {
            axios.get("/about/" + id)
                .then(response => {
                    this.item = response.data.[0];
                    $('#aboutModal').modal('show')
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

<style scoped>

</style>
