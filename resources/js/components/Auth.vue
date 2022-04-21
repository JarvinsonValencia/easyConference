<template>
    <div class="login-page">
        <transition name="slide-fade" mode="out-in">
           <router-view ></router-view>
        </transition>
    </div>
        
</template>

<script>
export default {
        mounted() {
            this.$router.push('login');
        }
}
</script>

<style>

</style>