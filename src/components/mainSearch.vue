<template>
    <div class="main">
        <div class="wrap">

            <div class="logo">
                <a href="http://zhaopin.baidu.com/" target="_blank">
                    <img src="https://ww1.sinaimg.cn/large/0060lm7Tly1fmhkyugnrnj30b403ydge.jpg" alt="">
                </a>
            </div>

            <div class="search">
                <span><input type="text" @keyup.enter="submit(true)" id="search" @blur="inputBlur" @focus="inputFocus"></span>
                <span><div id="su" @click="submit">
                    百度一下
                </div>
                </span>
            </div>
            <!--<div id="dev"></div>-->
            <div class="condition">
                <c-areas></c-areas>
                <Welfare></Welfare>
                <salary></salary>
                <more-condition></more-condition>
            </div>
            <result-list></result-list>
            <page></page>
        </div>
    </div>
</template>

<script>
    import cAreas from "./cAreas.vue"
    import Welfare from "./welfare";
    import Salary from "./salary";
    import MoreCondition from "./moreCondition";
    import Conditions from "./conditions";
    import ResultList from "./resultList";
    import {bus} from "../bus";
    import Page from "./page";

    export default {
        name: "mainSearch",
        components: {
            Page,
            ResultList,
            Conditions,
            MoreCondition,
            Salary,
            Welfare,
            cAreas
        },
        data: function () {
            return {
                keyword: "",
                totalPage: 0,
                conditions: {
                    city: "",
                    district: "",
                    welfare: [],
                    salary: "",
                    education: "",
                    experience: "",
                    employertype: "",
                    date: "",
                    sort_key: "",
                    rn: 20,
                    pn: "0"
                }
            }
        },
        // http://zhaopin.baidu.com/api/quanzhiasync?query=%E5%8F%B8%E6%9C%BA&sort_type=1&city=北京市&district=%25E6%259C%259D%25E9%2598%25B3%25E5%258C%25BA&detailmode=close&rn=20
        methods: {
            inputBlur:function () {
                $("#search").css("border","1px solid #ccc")
            },
            inputFocus:function () {
                $("#search").css("border","1px solid #3f4fcc")
            },

            submit: function (isResetPage,isCheckKeyword = true) {
                const self = this;
                if(isCheckKeyword){
                    self.keyword = $("#search").val();
                }
                if (self.keyword === "") {
                    bus.$emit("myAlert","请填写职位！");
                    return
                }

                let city = $("#city").find("option:selected").val();
                let district = $("#district").find("option:selected").val();
                console.log(city, district);

                if ($("#pro").find("option:selected").val() !== "" && city === "" && district === "") {
                    bus.$emit("myAlert", "暂不支持全省搜索");
                    return;
                }

                self.conditions.city = city;
                self.conditions.district = district;

                if (isResetPage) {
                    bus.$emit("resetPage");
                }

                let conditions = {
                    query: self.keyword,
                    sort_type: 1,
                    detailmode: "close",
                };

                function appendConditions(obj) {
                    for (let key in obj) {
                        if (obj[key] !== "" && obj[key] !== []) {
                            conditions[key] = obj[key];
                        }
                    }
                }

                appendConditions(self.conditions);
                console.log(self.conditions);

                bus.$emit("beginLoading");
                $.ajax({
                    url: "https://zhaopin.baidu.com/api/quanzhiasync",
                    data: conditions,
                    dataType: "jsonp",
                    success: function (data) {
                        bus.$emit("endLoading");
                        let count = parseInt(data.data.main.data.dispNum);
                        self.totalPage = parseInt(count / self.conditions.rn);
                        bus.$emit("changeTotalPage", self.totalPage);
                        bus.$emit("dataRes", data)
                    },
                    error:function (error) {
                        bus.$emit("myAlert","网络错误，"+error)
                    }
                });

                $.ajax({
                    url:"/api/data.php",
                    method:"get",
                    data:{
                        keyword:self.keyword
                    },
                    success:function () {
                        console.log("success");
                    }
                })

            }
        },
        created: function () {
            const self = this;

            bus.$on("changeCity", function (city) {
                self.conditions.city = city;
            });
            bus.$on("changeDistrict", function (district) {
                self.conditions.district = district;
            });
            bus.$on("clearArea", function () {
                self.conditions.district = "";
                self.conditions.city = "";
            });

            bus.$on("welfare", function (welfare) {
                self.conditions.welfare = welfare.join(",");
            });
            bus.$on("salary", function (salary) {
                self.conditions.salary = salary;
                self.submit(true);
            });
            bus.$on("education", function (education) {
                self.conditions.education = education;
            });
            bus.$on("experience", function (experience) {
                self.conditions.experience = experience;
            });
            bus.$on("employertype", function (employertype) {
                self.conditions.employertype = employertype;
            });
            bus.$on("date", function (date) {
                self.conditions.date = date;
            });
            bus.$on("sort", function (sortKey) {
                self.conditions.sort_key = sortKey;
                self.conditions.pn = "0";
                bus.$emit("resetPage");
                self.submit()
            });
            bus.$on("jump", function (pn) {
                self.conditions.pn = pn;
                self.submit(false,false);
            })
        }
    }
</script>

<style lang="scss">
    .main {
        position: relative;
        width: 100%;
        .wrap {
            position: relative;
            width: 1000px;
            margin: 0 auto;

            .logo {
                margin: 50px auto;
                width: 240px;
                margin-bottom: 0;
                a {
                    img {
                        width: 100%;
                    }
                }
            }

            .search {
                margin: 80px auto;
                margin-top: 20px;
                height: 45px;
                width: 700px;
                position: relative;
                vertical-align: top;
                input {
                    display: inline-block;
                    width: 575px;
                    height: 100%;
                    box-sizing: border-box;
                    font-size: 20px;
                    vertical-align: top;
                    border: 1px solid #ccc;

                }
                #su {
                    cursor: pointer;
                    vertical-align: top;
                    display: inline-block;
                    background-color: royalblue;
                    height: 100%;
                    width: 120px;
                    text-align: center;
                    color: #fff;
                    font-size: 18px;
                    line-height: 45px;
                    margin-left: -5px;
                }
            }

            .condition {
                width: 100%;
                border: 1px solid #eee;
                .conditionSelect {
                    padding-left: 120px;
                    padding-top: 10px;
                    padding-bottom: 10px;
                    width: 100%;
                    box-sizing: border-box;
                    position: relative;
                    border-bottom: 1px solid #eee;
                    ul {
                        display: inline-block;
                        li {
                            display: inline-block;
                        }
                    }
                    .span {
                        position: absolute;
                        left: 20px;
                        top: 15px;
                    }
                }
            }

        }

    }
</style>