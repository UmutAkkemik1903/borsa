<template>
    <div>
        <header>
            <div class="header-area">
                <div class="main-header ">
                    <div class="header-top black-bg d-none d-md-block">
                        <div class="container">
                            <div class="col-xl-12">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="header-info-left">

                                    </div>
                                    <div class="header-info-right">
                                        <ul class="header-social">

                                            <li><a href="/admin"><i class="fab fa-pinterest-p"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-mid d-none d-md-block" v-for="item in header">
                        <div class="container">
                            <div class="row d-flex align-items-center">
                                <!-- Logo -->
                                <div class="col-xl-3 col-lg-3 col-md-3">
                                    <div class="logo">
                                        <a  href="/"><img style="width: 200px; height: 125px" v-bind:src="item.logo" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-lg-9 col-md-9">
                                    <div class="header-banner f-right ">
                                        <img style="height: 125px; width: 800px" v-bind:src="item.advertisement" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-bottom header-sticky">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                    <!-- sticky -->

                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-md-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li><router-link :to="{name:'dashboard'}">Anasayfa</router-link></li>
                                                <li><router-link :to="{name:'hakkimizda'}">Hakkımızda</router-link></li>
                                                <li><router-link :to="{name:'contentList'}">Makale</router-link></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>

                                <!-- Mobile Menu -->
                                <div class="col-12">
                                    <div class="mobile_menu d-block d-md-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
        </header>
        <main>
            <!-- Trending Area Start -->
            <div class="trending-area fix">
                <div class="container">
                    <div class="trending-main">
                        <!-- Trending Tittle -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="trending-tittle">
                                    <div class="col-xl-2 col-lg-2 col-md-4 fluid">
                                        <strong>Borsa-Dergi</strong>
                                    </div>
                                    <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                                    <div class="trending-animated">
                                        <ul id="js-news" class="js-hidden">
                                            <li class="news-item">Hoşgeldiniz.
                                            </li>
                                            <li class="news-item">Borsayla ilgili dergiler.
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <router-view></router-view>

                    </div>
                </div>
            </div>

        </main>

        <footer>

            <div class="footer-area footer-padding fix" v-for="foot in footer">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                            <div class="single-footer-caption">
                                <div class="single-footer-caption">
                                    <!-- logo -->

                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>{{ foot.explanation }}</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a v-bind:href="foot.youtube"><i class="fab fa-youtube"></i></a>
                                        <a v-bind:href="foot.instagram"><i class="fab fa-instagram"></i></a>
                                        <a v-bind:href="foot.web"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom aera -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-lg-6">
                                <div class="footer-copy-right">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-menu f-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

</template>

<script>
export default {
    name: "Nav",
    data(){
        return{
            header:{},
            footer:{}
        }
    },
    created() {
        this.headerList();
        this.footerList();
    },
    methods:{
        headerList(){
            axios.get('headerU')
                .then(response => {
                    this.header = response.data.data;
                })
        },
        footerList(){
            axios.get('footerA').then(response => {
                this.footer = response.data.data;
            })
        }
    }
}
</script>

<style scoped>

</style>
