<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="footerModal">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Hakkımızda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-if="errorMessage" class="alert alert-danger" v-html="errorMessage"></div>
                    <form @submit.prevent="true">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Açıklama</label>
                            <div class="col-sm-10">
                                <textarea  v-model="item.explanation"  rows="10" cols="10"  class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input  type="text" v-model="item.instagram"
                                       class="form-control form-control-round">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Youtube</label>
                            <div class="col-sm-10">
                                <input  type="text" v-model="item.youtube"
                                       class="form-control form-control-round">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Web</label>
                            <div class="col-sm-10">
                                <input  type="text" v-model="item.web"
                                       class="form-control form-control-round">
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
export default {

    props:['item'],
    name:"footerModal",
    data(){
        return{
            errorMessage: '',
        }

    },
    methods:{

        saveItem() {
            axios.put('/footer/'+this.item.id, this.item)
                .then(response => {
                    if (response.data.success) {
                        this.$emit('onSaved', this.item);
                        $('#footerModal').modal('hide');
                        toastr.success('Kayıt Güncellendi','Header')
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.errorMessage = error.response.data.message;
                })
        },
    }
}
</script>

<style scoped>

</style>
