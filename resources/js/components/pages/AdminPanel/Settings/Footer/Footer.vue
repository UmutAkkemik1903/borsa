<template>
    <div class="pcoded-inner-content">
        <div><footer-modal :item="item" v-on:onSaved="refreshData" ></footer-modal></div>
        <div class="pcoded-inner-content">
            <div class="pcoded-inner-content">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div  class="card-header">
                                <h5>Footer</h5>

                            </div>
                            <div class="card-block">
                                <h4 class="sub-title">Site Bilgisi</h4>
                                <form v-for="item in footer">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div>
                                            <button style="border-radius: 20px;margin-left: 1250px;float: right"
                                                    @click="editData(item.id)" class="header-right btn btn-primary"><i
                                                class="fa fa-pencil"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Açıklama</label>
                                        <div class="col-sm-10">
                                            <textarea disabled v-model="item.explanation"  rows="10" cols="10"  class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Instagram</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" v-model="item.instagram"
                                                   class="form-control form-control-round">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Youtube</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" v-model="item.youtube"
                                                   class="form-control form-control-round">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Web</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" v-model="item.web"
                                                   class="form-control form-control-round">
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
import footerModal from "./FooterModal";
export default {
    components:{footerModal},
    data() {
        return {
            footer:{},
            meta:{},
            item:{}
        }
    },
    created() {
        this.footerList()
    },
    methods:{
        fetchData(){
            axios.get('footer')
                .then(response => {
                    this.footer = response.data.data;
                    this.meta = response.data;
                })
        },
        footerList(){
            axios.get('footer')
                .then(response => {
                    this.footer = response.data.data;
                    this.meta = response.data;
                })
        },
        refreshData(){
            this.footerList();
        },
        createData(){
            this.item = {}
            $('#footerModal').modal('show');
        },
        editData(id) {
            axios.get("/footer/" + id)
                .then(response => {
                    this.item = response.data.[0];
                    $('#footerModal').modal('show')
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
