<script>

import { io } from 'socket.io-client'


export default {
    props:['room','user'],
    components:[],
    data() {
        return { 
            messages: [],
            messageForm: null,
            socket : io('http://localhost:3000/room', {
                extraHeaders:{ 
                    room_id: this.room.id,
                    user_id: this.user.id,
                    username: this.user.username
                }
            }),
            character: {
                hp:8,
                hpMax:12
            }
        }
    },
    methods: {
        sendMessage(e) {
            e.preventDefault();
            if (this.messageForm) {
                const msg = this.messageForm;
                this.socket.emit('chat_message',msg)
                this.messageForm = ''
            }
        },
        recieveMessage(data) {
            this.messages.push(`${data.sender} : ${data.msg}`)
            setTimeout(() => {
                this.scrollToBottom()
            }, 100);
        },
        scrollToBottom(){
            const chat = this.$el.querySelector('#chat')
            chat.scrollTop = chat.scrollHeight
        }
    },
    mounted() {
        this.socket.on('chat_message', (data) => {
            this.recieveMessage(data)
        })
    }
}
</script>

<template>
    <div id="mainPage">
        <div id="content">
            Room N°{{ room.id }}
        </div>

        <div id="chat" class="overflow-y-auto">
            <div @resize="scrollToBottom" v-for="message in messages" v-bind:key="message.id">
                {{message}}
            </div>
        </div>

        <div id="slotbar"  class="flex content-center items-center px-2 py-4">
            {{ character.hp }} / {{ character.hpMax }}
            <progress :value="character.hp" :max="character.hpMax" class="border"></progress>
        </div>
        
        <form @submit.prevent="sendMessage" id="chatForm" class="flex items-center px-2 py-4">
            <input v-model="messageForm" type="text" class="w-7/12"/>
            <input type="submit" value="Envoyer" class="w-5/12 p-2"/>
        </form>  
    </div>
</template>

<style scoped>
#mainPage{
    height: 100vh;
    display: grid;
    grid-template-columns: 4fr 1fr;
    grid-template-rows: 1fr 5rem;
}
</style>