<template>
    <div class="result-list">
        <div class="result-list-header">
            <ul>
                <li @click="sortDefault" class="selected">综合排序</li>
                <li @click="sortDate">按发布时间排序</li>
                <li @click="sortSal">按薪资排序</li>
            </ul>
            <p>总共{{count}}个结果</p>
        </div>
        <ul class="result-list-body">
            <li v-for="item in dataList">
                <div class="itemLeft">
                    <h4><a target="_blank" :href="item.url">{{item.title}}</a> </h4>
                    <p>{{item.city}}-{{item.district}} |  {{item.officialname}}</p>
                </div>
                <div class="itemRight">
                    <p class="sal">{{item.salary === "0-1" ? "面议" : item.salary.indexOf("-99999999")?item.salary.replace("-99999999","以上")  :item.salary }}</p>
                    <p class="info">{{item.startdate}}发布| 来自{{item.source}}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import {bus} from "../bus";

    export default {
        name: "result-list",

        data:function () {
            return {
                dataList:[],
                count:0,
            }
        },

        created:function () {
            const self = this;
            bus.$on("dataRes",function (data) {
                let dataList = data.data.main.data.disp_data;
                self.count = data.data.main.data.dispNum;
                self.dataList = dataList;
            })
        },


        methods:{
            sortDefault:function (event) {
                let li = $(event.target);
                li.addClass("selected");
                li.siblings().removeClass("selected");
                bus.$emit("sort","")
            },
            sortDate:function (event) {
                let li = $(event.target);
                li.addClass("selected");
                li.siblings().removeClass("selected");
                bus.$emit("sort",5)
            },
            sortSal:function (event) {
                let li = $(event.target);
                li.addClass("selected");
                li.siblings().removeClass("selected");
                bus.$emit("sort",4)
            },



        }

    }
</script>

<style scoped lang="scss">
    .result-list{
        margin-top: 50px;
        width: 100%;
        border: 1px solid #ccc;
        font-size: 14px;
        .result-list-header{
            $navHeight:45px;
            height: $navHeight;
            line-height: $navHeight;
            box-sizing: border-box;
            padding: 0 20px;
            background-color: #efefef;
            ul{
                display: inline-block;
                width: 500px;
                li{
                    display: inline-block;
                    margin-right: 20px;
                    &.selected {
                        color: #3f4fcc;
                    }
                }
            }
            p{
                display: inline-block;
                float: right;
                margin: 0;
            }
        }
        .result-list-body{
            position: relative;
            width: 100%;
/*        <li>
        <div class="itemLeft">
        <h4>南平西方财富酒店招小车司机月八千以上</h4>
        <p>南平-延平 |  开县川福火锅店</p>
        </div>
        <div class="itemRight">
        <p class="sal">5000-8000</p>
        <p class="info">昨天发布| 来自赶集网</p>
        </div>
        </li>*/
            li{
                height: 96px;
                width: 100%;
                padding: 15px 20px;
                box-sizing: border-box;
                border-bottom: 1px solid #eee;
                .itemLeft{
                    display: inline-block;
                    float: left;
                    width: 600px;
                    overflow: hidden;
                    text-overflow:ellipsis;
                    white-space: nowrap;
                    h4{
                        font-weight: 700;
                        font-size: 18px;
                        overflow: hidden;
                        text-overflow:ellipsis;
                        white-space: nowrap;
                        a{
                            &:hover{
                                color: #5d5bc7;
                            }
                        }
                    }
                    p{
                        margin-top: 20px;
                    }
                }
                .itemRight{
                    float: right;
                    display: inline-block;
                    width: 240px;
                    p{
                        margin: 0;
                    }
                    .info{
                        margin-top:20px ;
                    }
                }
            }
        }
    }


</style>