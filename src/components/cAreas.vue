<template>
    <div class="cAreas conditionSelect ">
        <span class="span">工作区域：</span>

        <div  id="distpicker" data-toggle="distpicker"><!-- container -->
            <select id="pro" @change="changePro"></select><!-- 省 -->
            <select id="city"></select><!-- 市 -->
            <select id="district"></select><!-- 区 -->
        </div>

    </div>
</template>

<script>
    import {bus} from "../bus";

    export default {
        name: "c-areas",

        methods:{

            changePro:function () {
                bus.$emit("clearArea");
                var city = $("#city");
                setTimeout(function () {
                    console.log($("#city").find("option").length);
                    if(city.find("option").length === 2){
                        city.find("option").get(1).selected = true;
                    }
                },1);

            }

        },

        mounted:function () {
            $('#distpicker').distpicker({

                autoSelect: false
            });
            $("#distpicker").find("select").each(function (i, item) {
                $(item).find("option").get(0).selected = true;
            })
        }
    }
</script>

<style scoped lang="scss">
    .cAreas{
        width: 100%;
        position: relative;
        .span{
            margin-right: 20px;
        }
        div{
            display: inline-block;
        }
    }
</style>