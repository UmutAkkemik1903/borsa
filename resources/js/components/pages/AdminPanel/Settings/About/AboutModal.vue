<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="aboutModal">
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
                    <form @submit.prevent="true" >
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Başlık</label>
                            <div class="col-sm-10">
                                <input type="text" v-model="item.title" class="form-control form-control-round">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">İçerik</label>
                            <div class="col-sm-10">
                                <textarea v-model="item.content"  rows="10" cols="10"  class="form-control"></textarea>
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
    name:"aboutModal",
    data(){
        return{
            errorMessage: '',
        }

    },
    methods:{

        saveItem() {
            axios.put('/about/'+this.item.id, this.item)
                .then(response => {
                    if (response.data.success) {
                        this.$emit('onSaved', this.item);
                        $('#aboutModal').modal('hide');
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
