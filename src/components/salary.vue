<template>
    <!--每月薪资-->
    <div class="salary conditionSelect">
        <span class="span">每月薪资：</span>
        <div>
            <ul>
                <li @click="selectSal" class="selected" data-sal="">不限</li>
                <li @click="selectSal" data-sal="0_0">面议</li>
                <li @click="selectSal" data-sal="2001_2999">2000-3000</li>
                <li @click="selectSal" data-sal="3001_4999">3001-5000</li>
                <li @click="selectSal" data-sal="5001_7999">5001-8000</li>
                <li @click="selectSal" data-sal="8001_9999">8001-10000</li>
                <li @click="selectSal" data-sal="10000_99999999">10000以上</li>
            </ul>
            <div class="custom">
                <label>自定义：<input type="text" class="from" placeholder="￥" @></label>
                <span> - </span>
                <label><input type="text" class="to" placeholder="￥"></label>
                <input class="button" type="button" value="确定" @click="calc"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {bus} from "../bus"
    export default {
        name: "salary",
        methods:{
            selectSal:function (event) {
                var li = $(event.target);
                li.addClass("selected");
                li.siblings().removeClass("selected");
                // console.log(li.data("sal"));

                bus.$emit("salary",li.data("sal"))
            },
            calc:function () {
                let arr = [];
                $(".custom").find("input").each(function (i, item) {

                    if($(item).val() === ""){
                        return false
                    }
                    arr.push($(item).val())
                });
                bus.$emit("salary",arr.join("_"))
            }
        }
    }
</script>

<style scoped lang="scss">
    .salary{
        div{
            display: inline-block;
            width: 700px;
            ul{
                display: inline-block;
                li{
                    padding: 6px 12px;
                    display: inline-block;
                    margin-right: 5px;

                    &.selected{
                        background-color: #4169e1;
                        color: #fff;
                    }
                    &.custom{
                        margin-left: 20px;
                    }

                }
            }
            .custom{
                display: inline-block;
                margin-top: 10px;
                input{
                    border: 1px solid #ccc;
                    width: 80px;
                    padding: 4px 5px;

                }
                .button{
                    border: 1px solid #c9c9c9;
                    padding: 0 10px;
                    height: 26px;
                    line-height: 25px;
                    font-size: 12px;
                    background: #fff;
                    outline: 0;
                    cursor: pointer;
                    color: #666;
                    /*vertical-align: middle;*/

                }
                .button:hover {
                    background: #ddd;
                }
            }
        }
    }
</style>