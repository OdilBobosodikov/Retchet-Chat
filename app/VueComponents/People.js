
export default
{
    template: `
    <div class="chat__people">
        <span>People online : {{users.length}}</span>
        <ul>
            <li v-for="user in users">{{user.name}}</li>
        </ul>
    </div>
    `,
     data() {
         return {
             users : [],
         };
     },
    mounted() {
        this.emitter.on('joined', payload => {
            this.addUser(payload)
        })
        this.emitter.on('left', payload => {
            this.removeUser(payload)
        })
        this.emitter.on('users', payload => {
            this.users = payload
        })
    }
    , methods : {
        addUser(user)
        {
            this.users.unshift(user);
        },
        removeUser(user)
        {
            this.users = this.users.filter( (u) => {
                return u.id != user.id
            })
        }
    }
}