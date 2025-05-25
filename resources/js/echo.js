import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// Public channel (optional if you’re only using private)
window.Echo.channel('chat-channel')
    .listen('.message.sent', (e) => {
        console.log('Received message:', e.message);

        const newMessageHTML = `
            <div class="mb-4">
                <strong>${e.message.user.fname} ${e.message.user.lname}:</strong>
                <span>${e.message.message}</span><br>
                <small class="text-gray-500">just now</small>
            </div>
            <hr>
        `;

        const container = document.getElementById('messages-container');
        if (container) {
            container.insertAdjacentHTML('beforeend', newMessageHTML);
            container.scrollTop = container.scrollHeight;
        }
    });

// Private message listener
const currentUserId = Number(document.querySelector('meta[name="user-id"]').content);

window.Echo.private(`chat.user.${currentUserId}`)
    .listen('.private-message', (e) => {
        if (e.sender.id === currentUserId) return; // Skip own message

        const container = document.getElementById('private-messages-container');
        if (!container) return;

        const newMessageHTML = `
            <div class="mb-4">
                <strong>${e.sender.fname} ${e.sender.lname}:</strong>
                <span>${e.message.message}</span><br>
                <small class="text-gray-500">just now</small>
            </div>
            <hr>
        `;

        container.insertAdjacentHTML('beforeend', newMessageHTML);
        container.scrollTop = container.scrollHeight;
    });
