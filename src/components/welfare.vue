<template>
    <div class="welfare conditionSelect">
        <span class="span">工作福利：</span>
        <div>
            <ul>
                <li @click="select"><label>五险一金<input value="五险一金" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>包吃住<input value="包吃住" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>年度旅游<input value="年度旅游" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>餐补<input value="餐补" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>房补<input value="房补" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>通讯补贴<input value="通讯补贴" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>绩效奖金<input value="绩效奖金" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>年底双薪<input value="年底双薪" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>年终分红<input value="年终分红" type="checkbox" class="condition-areas"/></label></li>
                <li @click="select"><label>加班补助<input value="加班补助" type="checkbox" class="condition-areas"/></label></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {bus} from '../bus'
    export default {
        name: "welfare",
        methods:{
            select:function () {
                var welfares = [];
                $(".welfare ul li input:checked").each(function (i, item) {
                    welfares.push($(item).val());
                });

                bus.$emit("welfare",welfares)

            }
        }
    }
</script>

<style scoped lang="scss">
    .welfare{
        ul{
            display: inline-block;
            width: 800px;
            li{
                display: inline-block;
                margin-right: 10px;
            }
        }
    }
</style>