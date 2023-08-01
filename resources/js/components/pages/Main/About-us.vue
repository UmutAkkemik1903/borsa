<template>
    <div>
        <main>
            <!-- About US Start -->
            <div class="about-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Tittle -->
                            <div class="about-right mb-90" v-for="item in about">
                                <div class="about-img">
                                    <img src="document/atauni.jpg" alt="">
                                </div>
                                <div class="section-tittle mb-30 pt-30">
                                    <h3>{{ item.title }}</h3>
                                </div>
                                <div class="about-prea">
                                    <p class="about-pera1 mb-25">{{ item.content }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About US End -->
        </main>
    </div>
</template>

<script>
export default {
    name: "About-us",
    data() {
        return {
            about: {}
        }
    },
    created() {
        this.aboutList()
    },
    methods: {
        aboutList() {
            axios.get('aboutU').then(response => {
                this.about = response.data.data;
            })
        }
    }
}
</script>

<style scoped>

</style>
