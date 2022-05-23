<script>

import AppLayout from '../Layouts/AppLayout.vue'
import Button from '../Components/Button.vue'

export default {
    props: ['rooms'],

    components: { AppLayout, Button }
}
</script>

<template>
    <app-layout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
                <Button :href="'/createRoom'" :name="'Create Room'"/>
                <div v-for="room in rooms" v-bind:key="room.id" class="bg-white overflow-hidden my-4 shadow-xl sm:rounded-lg">
                    <div class="flex justify-around items-center py-4 w-full">
                        <div>{{ room.owner }}'s Room</div>
                        <div>{{ room.players.length }} / {{ room.player_max }}</div>
                        <Button :href="'/room/'+room.id" :name="'Rejoindre'"/>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
