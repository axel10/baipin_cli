<template>
    <div class="moreCondition conditionSelect">
        <span class="span">其他要求：</span>

        <select @change="education" class="education">
            <option value="">学历</option>
            <option value="">不限</option>
            <option value="初中">初中</option>
            <option value="中专/中技">中专/中技</option>
            <option value="高中">高中</option>
            <option value="大专">大专</option>
            <option value="本科">本科</option>
            <option value="硕士">硕士</option>
            <option value="博士">博士</option>
            <option value="MBA/EMB">MBA/EMBA</option>

        </select>
        <select @change="experience" class="experience">
            <option value="">经验</option>
            <option value="">不限</option>
            <option value="1年以下">1年以下</option>
            <option value="1-3年">1-3年</option>
            <option value="3-5年">3-5年</option>
            <option value="5-10年">5-10年</option>
            <option value="10年以上">10年以上</option>
        </select>
        <select @change="employertype" class="employertype">
            <option value="">公司性质</option>
            <option value="">不限</option>
            <option value="民营">民营</option>
            <option value="国企">国企</option>
            <option value="股份制">股份制</option>
            <option value="外商独资/办事处">外商独资/办事处</option>
            <option value="中外合资/合作">中外合资/合作</option>
            <option value="上市公司">上市公司</option>
            <option value="事业单位">事业单位</option>
            <option value="政府机关">政府机关</option>
            <option value="个人企业">个人企业</option>
            <option value="其他">其他</option>
        </select>
        <select @change="date" class="date">
            <option value="">发布时间</option>
            <option value="">不限</option>
            <option value="20171210_20171210">一天内</option>
            <option value="20171207_20171210">三天内</option>
            <option value="20171203_20171210">一周内</option>
            <option value="20171130_20171210">十天内</option>
        </select>
    </div>

</template>

<script>
    import {bus} from "../bus"

    export default {
        name: "moreCondition",
        methods: {
            education: function (data) {
                bus.$emit("education", $(data.target).find("option:selected").val())
            },
            experience: function (data) {
                bus.$emit("experience", $(data.target).find("option:selected").val())
            },
            employertype: function (data) {
                bus.$emit("employertype", $(data.target).find("option:selected").val())
            },
            date: function (data) {
                bus.$emit("date", $(data.target).find("option:selected").val())
            }
        },
        mounted: function () {

            let today = new Date().Format("yyyyMMdd");
            let oToday = new Date();


            let options = $(".date>option");
            options.each(function (i, item) {
                const text = $(item).text();

                switch (text) {
                    case "一天内":
                        $(item).val(today + "_" + today);
                        break;
                    case "三天内":
                        // $(item).val(year.toString()+month.toString()+(day-3).toString()+"_"+year.toString()+month.toString()+day.toString());
                        $(item).val((new Date().MinusDay(3).Format("yyyyMMdd")) + "_" + today);
                        break;
                    case "一周内":
                        // $(item).val(year.toString()+month.toString()+(day-7).toString()+"_"+year.toString()+month.toString()+day.toString());
                        $(item).val((new Date().MinusDay(7).Format("yyyyMMdd")) + "_" + today);
                        break;
                    case "十天内":
                        $(item).val((new Date().MinusDay(10).Format("yyyyMMdd"))+ "_" + today);
                        break;
                    default:
                        break;
                }
            })

        }
    }
</script>

<style scoped lang="scss">

</style>