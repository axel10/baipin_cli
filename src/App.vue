<template>
    <div id="app">
        <myHeader>

        </myHeader>
        <div class="alert">

        </div>
        <div class="voteLoading">
            <div class="loadingWrap">
                <div class="waitGif">
                    <img src="https://ww3.sinaimg.cn/large/0060lm7Tly1fmhj2fjlyqg305k062aci.gif" alt="">
                </div>
                <p>等一下下……∑(ﾟωﾟﾉ)ノ</p>
            </div>
        </div>
        <mainSearch>
        </mainSearch>



    </div>
</template>

<script>
    import myHeader from './components/header.vue'
    import mainSearch from './components/mainSearch.vue'
    import {bus} from "./bus";

    export default {
        name: 'app',
        data() {
            return {
                msg: 'Welcome to Your Vue.js App'
            }
        },
        components: {
            myHeader,
            mainSearch
        },
        methods: {
            myAlert: function (text) {
                var timer;
                var alertBox = $(".alert");
                alertBox.html(text);
                alertBox.css({"display": "block", "opacity": 0});
                alertBox.animate({opacity: 1});
                clearTimeout(timer);
                timer = setTimeout(function () {
                    alertBox.animate({opacity: 0}, "normal", "swing", function () {
                        alertBox.css({"display": "none", "opacity": 0});

                    });
                }, 2000)
            },
            beginLoading:function () {
                var loadingWrap = $(".loadingWrap");
                var loading = $(".voteLoading");
                loading.css({"display":"block"});
                loadingWrap.css({"display":"block","animation":"zoomIn forwards .3s"});
            },
            endLoading:function () {
                var loadingWrap = $(".loadingWrap");
                var loading = $(".voteLoading");
                loadingWrap.css({"animation":"zoomOut forwards .3s"});
                setTimeout(function () {
                    loading.css({"display":"none"});
                },400)
            }
        },

        created:function () {
            const self = this;

            bus.$on("myAlert",function (text) {
                self.myAlert(text)
            })
            bus.$on("beginLoading",function () {
                self.beginLoading()
            })
            bus.$on("endLoading",function () {
                self.endLoading()
            })
        }
    }
</script>

<style lang="scss">
    input {
        padding: 7px 0px;
        padding-left: 5px;
    }

    .alert {
        display: none;
        opacity: 0;
        z-index: 1002;
        background-color: rgba(244, 67, 54, 0.9);
        width: 14rem;
        height: 2.5rem;
        border-radius: 2px;
        -webkit-box-shadow: 0 3px 8px #ccc;
        box-shadow: 0 3px 8px #ccc;
        position: fixed;
        left: 0;
        right: 0;
        margin: 3rem auto;
        text-align: center;
        color: #fff;
        font-size: 1rem;
        line-height: 2.5rem;
    }


    .voteLoading{
        z-index:1001;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin:auto;
        background-color: rgba(255,255,255,.8);
        .loadingWrap{
            display: block;
            position: absolute;
            width: 300px;
            height: 400px;
            left: 0;
            right: 0;
            top: 0px;
            bottom: 0;
            margin:auto;
            text-align: center;
            .waitGif{
                display: block;
            }
            p{
                text-align: center;
                position: relative;
                top: 1rem;
                font-size: 20px;
                font-family: "Microsoft YaHei";
            }
        }
    }

    @-webkit-keyframes zoomIn {
        0%{
            opacity:0;
            -webkit-transform:translate(0px,-100px);
            transform:translate(0px,-100px);
        }
        100%{
            opacity:1;
            -webkit-transform:translate(0px,0px);
            transform:translate(0px,0px);

        }
    }

    @keyframes zoomIn {
        0%{
            opacity:0;
            -webkit-transform:translate(0px,-100px);
            transform:translate(0px,-100px);
        }
        100%{
            opacity:1;
            -webkit-transform:translate(0px,0px);
            transform:translate(0px,0px);

        }
    }

    @-webkit-keyframes zoomOut {
        0%{
            opacity:1;
            -webkit-transform:translate(0px,0px);
            transform:translate(0px,0px);
        }
        100%{

            opacity:0;
            -webkit-transform:translate(0px,-100px);
            transform:translate(0px,-100px);
        }
    }

    @keyframes zoomOut {
        0%{
            opacity:1;
            -webkit-transform:translate(0px,0px);
            transform:translate(0px,0px);
        }
        100%{

            opacity:0;
            -webkit-transform:translate(0px,-100px);
            transform:translate(0px,-100px);
        }
    }






</style>
