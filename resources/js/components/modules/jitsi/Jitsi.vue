<template>
    <div class="jitsi-meet" id="jitsi-meet" align="center">
        <div id="meet" style="margin-top: 25px"></div>
         <vue-jitsi-meet
            ref="jitsiRef"
            domain="meet.jit.si"
            :options="startJitsiMeet"
    >   </vue-jitsi-meet>
    </div>
 
</template>

<script>
import { JitsiMeet } from '@mycure/vue-jitsi-meet';
export default {
    data: () => ({}),
    components: {
        VueJitsiMeet: JitsiMeet
  },
  computed: {
    startJitsiMeet () {
        return {
                roomName: 'nombreReunion',
                width: 1200,
                height: 550,
                parentNode: document.getElementById('meet'),
                configOverwrite: {},
                configOverwrite: {
                 enableNoisyMicDetection: false
                },
                interfaceConfigOverwrite: {
                SHOW_JITSI_WATERMARK: false,
                SHOW_WATERMARK_FOR_GUESTS: false,
                SHOW_CHROME_EXTENSION_BANNER: false
                },
                onload: this.onIFrameLoad
        }
    },
  },
methods: {
        addJitsiApiScript() {
            const script = document.createElement('script')
            $(script).on('load', () => this.startJitsiMeet())
            script.type = 'text/javascript'
            script.src = 'https://meet.jit.si/external_api.js'
            document.head.appendChild(script)
        },

        // startJitsiMeet() {
        //     const options = {
                
        //     }
        //     this.meet = new JitsiMeetExternalAPI('meet.jit.si', options)
        // },
    },

    mounted() {
       // this.addJitsiApiScript()
    },
};
</script>