<template>
    <div class="content container-fluid">
        <div style="max-width: 99%">
            <b-row align-h="between" class="py-3 bg-info text-white">
                <b-col cols="auto" class="pl-3"><i class="fas fa-home"></i> {{name}} </b-col>
                <b-col cols="auto" class="pr-5"> <i class="fas fa-user"></i> {{user.name}} </b-col>
                <b-col cols="auto" class="pr-5">
                    <!-- <app-time-counter :start-date="currentMeeting.start_date"></app-time-counter> -->
                </b-col>
            </b-row>

            <b-row class="mt-3">
                <b-col cols="12">
                    <b-row class="d-flex align-items-center">
                        <b-col class="mb-2" cols="12" md="4">
                            <b-btn
                                block
                                size="sm"
                                variant="info"
                                @click=" "
                                title="Compartir pantalla"
                                ><i class="fa-solid fa-desktop"></i> Compartir pantalla
                            </b-btn>
                        </b-col>
                        <b-col class="mb-2" cols="12" md="4">
                            <b-btn
                                block
                                size="sm"
                                variant="info"
                                title="Silenciar a todos"
                                @click=" "
                            ><i class="fa-solid fa-bell-slash"></i> Silenciar a todos
                            </b-btn>
                        </b-col>
                        <b-col class="mb-2" cols="12" md="4">
                            <b-btn
                                block
                                msg="¿Esta seguro de finalizar la reunión?"
                                size="sm"
                                variant="danger"
                                title="Terminar reunión"
                                @click=" "
                            >
                                <i class="fa-solid fa-flag-checkered"></i>
                                Terminar reunión 
                            </b-btn>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
                <Activity></Activity>
        </div>
    </div>
</template>

<script>
import Acitvity from '../activity/Index.vue'
export default {
    components: {
        Acitvity,
    },
    
    props: ['name', 'user']
}
</script>

<style>

</style>