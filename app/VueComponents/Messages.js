import Message from "./Message.js";
export default {
    components : {Message},
    template: `
    <div class = "chat__messages">
    <message v-for="message in messages" :key="message.id" :message="message"></message>
    </div>
    `,
    data() {
        return {
            messages: []
        }
    },
    mounted()
    {
        this.emitter.on('message', (payload) => {
            this.messages.unshift(payload)
        })
    }
}