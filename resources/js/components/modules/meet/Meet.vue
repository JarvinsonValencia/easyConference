<template>
    <div class="content container-fluid">
        <div style="max-width: 99%">
            <b-row align-h="between" class="py-3 bg-info text-white">
                <b-col cols="8"></b-col>
                <b-col cols="auto" class="pr-5">
                    <i class="fas fa-user"></i> {{ this.userName }}
                </b-col>
            </b-row>
            <Activity></Activity>
        </div>
    </div>
</template>

<script>
import Acitvity from "../activity/Index.vue";
export default {
    data: () => ({
        userName: "",
    }),
    components: {
        Acitvity,
    },
    mounted() {
        //this.addJitsiApiScript();
        this.getName();
    },

    methods: {
        getName() {
            this.userName = this.$store.state.user.name;
        },
    },
};
</script>

<style></style>
