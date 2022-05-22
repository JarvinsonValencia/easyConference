<template>
    <div>
        <b-tabs :small="true" v-model="tabIndex">
            <b-tab title="👨‍👩‍👧‍👦 Reunión" :title-link-class="getTabClass(0)">
                <!-- <router-view :meet="meet-activity"></router-view> -->
                <Meet :user="user"></Meet>
            </b-tab>
            <b-tab title="🎧 Audio! " :title-link-class="getTabClass(1)">
                <div class="jitsi-meet" id="jitsi-meet" align="center">
                    <div id="meet" style="margin-top: 25px">
                        <vue-jitsi-meet
                            ref="jitsiRef"
                            domain="meet.jit.si"
                            :options="startJitsiMeet"
                        >
                        </vue-jitsi-meet>
                    </div>
                </div>
            </b-tab>
        </b-tabs>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import { JitsiMeet } from "@mycure/vue-jitsi-meet";
import Meet from "../meet/Meet.vue";
export default {
    data: () => ({
        meet: null,
        tabIndex: 0,
        userName: "",
    }),

    props: ["user"],

    mounted() {
        //this.addJitsiApiScript();
        this.getName();
    },

    components: {
        VueJitsiMeet: JitsiMeet,
        Meet,
    },

    computed: {
        ...mapGetters(["currentMeeting"]),
        startJitsiMeet() {
            return {
                roomName: "nombreReunion",
                width: 1000,
                height: 550,
                parentNode: document.getElementById("meet"),
                userInfo: {
                    displayName: this.userName,
                },
                configOverwrite: {
                    startWithAudioMuted: true,
                    disableProfile: true,
                    // toolbarButtons: ['camera', 'microphone', ],
                    hideConferenceTimer: true,
                    disableSelfViewSettings: true,
                    remoteVideoMenu: {
                        disabled: true,
                    },
                    enableNoisyMicDetection: false,
                },
                interfaceConfigOverwrite: {
                    SHOW_JITSI_WATERMARK: false,
                    SHOW_WATERMARK_FOR_GUESTS: false,
                    SHOW_CHROME_EXTENSION_BANNER: false,
                },
                onload: this.onIFrameLoad,
            };
        },
    },

    methods: {
        getTabClass(idx) {
            return this.tabIndex === idx ? ["bg-blue", "text-white"] : "";
        },

        addJitsiApiScript() {
            const script = document.createElement("script");
            $(script).on("load", () => this.startJitsiMeet());
            script.type = "text/javascript";
            script.src = "https://meet.jit.si/external_api.js";
            document.head.appendChild(script);
        },

        getName() {
            this.userName = this.$store.state.user.name;
        },
    },
};
</script>
