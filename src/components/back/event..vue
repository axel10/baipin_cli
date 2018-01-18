<template>
    <div @click="emitMyEvent">event demo</div>
</template>

<script>
    export default {

        methods:{
            emitMyEvent(){
                this.$emit('my-event',"hello")
            }
        }
    }

</script>

<style lang="scss">

</style>