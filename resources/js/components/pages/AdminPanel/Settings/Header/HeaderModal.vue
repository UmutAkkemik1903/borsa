<template>
            <div class="modal fade" tabindex="-1" role="dialog" id="headerModal">
                <div class="modal-dialog"  role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title">Header</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div v-if="errorMessage" class="alert alert-danger" v-html="errorMessage"></div>
                            <form @submit.prevent="true" enctype="multipart/form-data" >

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Logo</label>
                                    <hr>
                                    <div class="col-sm-10">
                                        <b-form-file
                                            name="logo"
                                            v-model="file"
                                            :state="Boolean(file)"
                                            placeholder="Dosya Seçin">
                                        </b-form-file>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Reklam</label>
                                    <hr>
                                    <div class="col-sm-10">
                                        <b-form-file
                                            v-model="advert"
                                            :state="Boolean(advert)"
                                            placeholder="Dosya Seçin">
                                        </b-form-file>
                                    </div>
                                </div>

                                <hr>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input v-model="item.title"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-sm-10">
                                        <input v-model="item.instagram"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Youtube</label>
                                    <div class="col-sm-10">
                                        <input v-model="item.youtube" class="form-control">

                                    </div>
                                </div>
                                <div  class="form-group row">
                                    <label class="col-sm-2 col-form-label">Web</label>
                                    <div  class="col-sm-10">
                                        <input v-model="item.web"  class="form-control">

                                    </div>
                                </div>
                                <div class="row" style="!important;margin-right: 50px">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">

                                    </div>
                                </div>
                            </form>
                                    </div>
                        <div class="modal-footer">
                            <button class="form-control btn btn-primary" @click="saveItem()">Güncelle</button>
                        </div>
                                </div>

                                <!-- Basic Form Inputs card end -->
                            </div>
                        </div>
</template>

<script>
import {BFormFile} from 'bootstrap-vue'

export default {
    components: {BFormFile},
    props: ['item'],
    name: "headerModal",
    data() {
        return {
            file: null,
            advert: null,
            errorMessage: '',
            uploadPercentage: 0,
        }

    },
    methods: {

        saveItem() {
            let formData = new FormData();
            let config = {
                headers: {'Content-Type': 'multipart/form-data'},
                onUploadProgress: function (progressEvent) {
                    this.uploadPercentage = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
                }.bind(this)
            };
                formData.append('img', this.file);
                formData.append('advert', this.advert);
                formData.append('title', this.item.title);
                formData.append('instagram', this.item.instagram);
                formData.append('youtube', this.item.youtube);
                formData.append('web', this.item.web);
                this.requesting_upload_file = true;
                formData.append('id', this.item.id);
                axios.post('/header', formData, config)
                    .then(response => {
                        this.requesting_upload_file = false;
                        $('#headerModal').modal('hide');
                        this.$emit('onSaved', response.data);
                        toastr.success('Kayıt Güncellendi', 'Header')

                    })

                    .catch(error => {
                        console.log(error);
                        this.requesting_upload_file = false;
                        this.errorMessage = error.response.data.message;
                    })
        }
    }
}
</script>

<style scoped>

</style>
