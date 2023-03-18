export default {
    template: `
    <form action="#">
        <textarea class="chat__input" placeholder="Your message ..." v-model="body" @keydown="handleInput"></textarea>
    </form>
    `,
    methods :
        {
            handleInput(e) {
                if(e.keyCode == 13 && e.shiftKey == false)
                {
                    e.preventDefault()
                    this.send()
                }
            },
            send() {
                let payload = {
                    event : 'message',
                    data : {
                        id: Date.now(),
                        body: this.body,
                        user: {
                            name: 'You'
                        }
                    }
                }
                this.socket.send(JSON.stringify(payload))
                this.emitter.emit('message', payload.data)
                this.body = null
            }
        },
    data() {
        return {
            body : ''
        };
    },
    props : {
        socket: WebSocket
    }
}