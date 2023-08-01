<template>
    <div>
        <div>
            <div class="modal fade" tabindex="-1" role="dialog" id="contentModal">
                <div class="modal-dialog"  role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" v-text="item.id>0?'Makale Düzenle':'Yeni Makale'"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form  @submit.prevent="true">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" >Dergi</label>
                                    <div class="col-sm-10">
                                    <select class="custom-select form-control-border" id="exampleSelectBorder" v-model="item.magazine_id">
                                        <option v-for="magazineValue in magazineJoinList" :value='magazineValue.id'>{{ magazineValue.magazine_name }}</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-from-label" >Makale Adı</label>
                                    <div class="col-sm-10">
                                        <input type="text" v-model="item.name" class="form-control">
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

export default {

    name: "contentModal",
    props: ['item'],



    data() {
        return {
            magazineJoinList: null,
            mode: "no-cors"
        }
    },
    async created() {
        await this.definitionGetModal();
    },
    methods: {
        definitionGetModal() {
            axios.get('list').then(response => {
                this.magazineJoinList = response.data.data;
            })
        },
        saveItem() {
            if (this.item.id > 0) {
                axios.put('/content/' + this.item.id, this.item)
                    .then(response => {
                        if (response.data.success) {
                            this.$emit('onSaved', this.item);
                            $('#contentModal').modal('hide');
                            toastr.success('Kayıt Güncellendi')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        this.errorMessage = error.response.data.message;
                    })

            } else {


                axios.post('/content', this.item)
                    .then(response => {
                        if (response.data.success) {

                            this.$emit('onSaved', this.item);
                            $('#contentModal').modal('hide');
                            toastr.success('Kayıt eklendi')
                        }
                    })
                    .catch(error => {
                        this.errorMessage = error.response.data.message;

                    });
            }
        }


    }

}

</script>

<style scoped>

</style>
