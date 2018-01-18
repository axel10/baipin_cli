


<template>
    <div>todo

        <router-link :to="{path:'/foo'}">foo</router-link>
        <router-link :to="{path:'/bar'}">bar</router-link>
        <router-view></router-view>
        <label>input:<input v-model="message"/></label>
        <button type="button" v-on:click="addMessage">add message</button>
        <ul>
            <transition-group name="fade">
            <li v-for="(item,index) in messageList"  v-on:click="logIndex" :index="index" :key="index">

                    {{index}} - {{item}}  <button type="button" v-on:click="deleteItem" :index="index">delete</button>
            </li>
            </transition-group>

        </ul>

        <button type="button" v-on:click="axiosDemo">axios</button>
    </div>
</template>

<script>
    export default {
        name: 'todo',
        data: function () {
            return {
                message: "",
                messageList: []
            }
        },
        methods:{
            addMessage() {
//                alert(1)
                if (this.message === "") {
                    return
                }
                this.messageList.push(this.message)
            },
            logIndex(event){
                console.log(event.target.getAttribute("index"))
            },
            deleteItem(event){
                var index = event.target.getAttribute("index");
                this.messageList.splice(index,1);
            },
            axiosDemo(event){
                this.$http.get("http://api.map.baidu.com/telematics/v3/weather?location=%E5%98%89%E5%85%B4&output=json&ak=5slgyqGDENN7Sy7pw29IUvrZ")
                    .then(function (data) {
                        console.log(data);
                    })
                    .catch(function (data) {
                        console.log("error"+data);
                    })
            }
        }
    }
</script>

<style lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: all .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in below version 2.1.8 */ {
        opacity: 0;
        transform:translate(-100px,0px)
    }
</style>