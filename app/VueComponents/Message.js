export default
{
    template: `
        <div class = "chat__message">
            <strong>{{message.user.name}}</strong> : {{message.body}}
        </div>
    `,
    props : {
        message: Object
    }
}