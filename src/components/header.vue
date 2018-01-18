<template>
    <div class="header">
        <div class="wrap">
            <div class="leftHeader">
                百度百聘改
            </div>
            <div class="rightHeader">
                <a href="http://zhaopin.baidu.com/" target="_blank" >百度百聘官网</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "header"
    }
</script>

<style scoped lang="scss">
    .header{
        width: 100%;
        height: 35px;
        border-bottom: 1px solid #ddd;
        position: relative;
        .wrap{
            width: 100%;
            height: 100%;
            line-height: 32px;
            margin: 0 auto;
            font-size: 14px;

            .leftHeader{
                display: inline-block;
                color: #666;
                margin-left: 60px;
            }
            .rightHeader{
                float: right;
                display: inline-block;
                margin-right: 60px;

                a{
                    color: #666;
                }
            }
        }
    }
</style>