<template>
    <div>
        <div>
            <div class="modal fade" tabindex="-1" role="dialog" id="magazineModal">
                <div class="modal-dialog"  role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" v-text="item.id>0?'Dergi Düzenle':'Yeni Dergi'"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form @submit.prevent="true" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Dergi Resmi</label>
                                    <hr>
                                    <div class="col-sm-10">
                                        <b-form-file
                                            v-model="file"
                                            :state="Boolean(file)"
                                            placeholder="Dosya Seçin">
                                        </b-form-file>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Dergi Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="item.magazine_name" class="form-control">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" v-text="item.id>0?'Güncelle':'Kaydet'" @click="saveItem"></button>
                            <button class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {BFormFile} from 'bootstrap-vue'
export default {
    name: "MagazineModal",
    components: {BFormFile},
    props: ['item'],




    data() {
        return {
            file:null,
            errorMessage: '',
            uploadPercentage: 0,
        }
    },
    methods: {
        saveItem() {
            let formData = new FormData();
            let config = {
                headers:{'Content-Type' : 'multipart/form-data'},
                onUploadProgress: function( progressEvent ) {
                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                }.bind(this)
            };
            if (this.file) {
                formData.append('mag_img', this.file);
                formData.append('magazine_name', this.item.magazine_name);
                this.requesting_upload_file = true;
                if (this.item.id > 0) {
                    formData.append('id', this.item.id);
                    axios.post('magazineUpdate', formData, config).then(response => {
                        this.requesting_upload_file = false;
                        $('#magazineModal').modal('hide');
                        this.$emit('onSaved', response.data);
                        toastr.success('Kayıt Güncellendi', 'Header')

                    }).catch(error => {
                        this.requesting_upload_file = false;
                    })
                } else {
                    axios.post('magazine', formData, config).then(response => {
                        this.requesting_upload_file = false;
                        $('#magazineModal').modal('hide');
                        this.$emit('onSaved', response.data);
                        toastr.success('Kayıt Eklendi', 'Header')
                    }).catch(error => {
                        this.errorMessage = error.response.data.message;
                    })
                }
            }


    }
    }

}
</script>

<style scoped>

</style>
