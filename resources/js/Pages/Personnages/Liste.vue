<script>

import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    components: {AppLayout},
    props:['personnages']
}
</script>

<template>
    <app-layout title="Liste des personnages">
        <div class="p-12">
            <div>Liste des personnages</div>
            <div class="grid grid-flow-row auto-rows-max">
                <div v-for="personnage in personnages" v-bind:key="personnage.id" class="w-25">
                    {{ personnage.nom }}
                </div>
            </div>
        </div>
    </app-layout>
</template>