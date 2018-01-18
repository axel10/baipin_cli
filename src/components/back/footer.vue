<template>
    <div class="footer" v-on:click="showModel">
        23244
        {{count}}
    </div>
</template>

<script>
    export default {
        name:'footer',
        data:function () {
            return{
                count:0
            }
        },
        methods:{
            showModel:function (event) {
                alert('1')
            }
        }
    }
</script>