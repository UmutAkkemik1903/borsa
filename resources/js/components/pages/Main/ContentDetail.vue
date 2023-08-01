<template>
    <main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90" v-for="i in item">
                            <div class="about-img" >
                                <img style="margin-right: 50px;width: 250px; height: 250px" v-bind:src="i.magazine_img" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>{{i.name}}</h3>
                            </div>
                            <div class="about-prea">
                                <p class="about-pera1 mb-25">{{i.content}}</p>
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
            </div>
        </div>
        <!-- About US End -->
    </main>
</template>
<script>

export default {

    name: "content-detail",
    data() {
        return {
            item: {}
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get("/cont/" + this.$route.params.id)
                .then(response => {
                    this.item = response.data;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        }
    }

}

</script>

<style scoped>

</style>
