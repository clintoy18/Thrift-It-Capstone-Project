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
const currentUserId = Number(document.querySelector('meta[name="user-id"]')?.content);
const recipientId = Number(document.querySelector('meta[name="recipient-id"]')?.content);

if (currentUserId) {
    window.Echo.private(`chat.user.${currentUserId}`)
        .listen('.private-message', (e) => {
            console.log('Received real-time message:', e);
            
            // Only show message if we're in the correct chat
            if (e.sender.id !== recipientId) return;

            const container = document.getElementById('private-messages-container');
            if (!container) return;

            // Create message bubble HTML matching your design
            const isOwnMessage = e.sender.id === currentUserId;
            const messageHTML = createMessageBubble(e.message, e.sender, isOwnMessage);

            // Add message to container
            container.insertAdjacentHTML('beforeend', messageHTML);
            
            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        });
}

// Function to create message bubble HTML
function createMessageBubble(message, sender, isOwnMessage) {
    const initials = sender.fname.charAt(0) + sender.lname.charAt(0);
    const timeAgo = 'just now';
    
    return `
        <div class="flex ${isOwnMessage ? 'justify-end' : 'justify-start'}">
            <div class="flex max-w-xs lg:max-w-md ${isOwnMessage ? 'flex-row-reverse' : 'flex-row'} items-end space-x-2">
                <!-- Avatar -->
                <div class="w-8 h-8 rounded-full flex-shrink-0 ${isOwnMessage ? 'ml-2' : 'mr-2'}">
                    <div class="w-8 h-8 bg-gradient-to-r ${isOwnMessage ? 'from-[#634600] to-[#B59F84]' : 'from-[#B59F84] to-[#786126]'} rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">${initials}</span>
                    </div>
                </div>
                
                <!-- Message Bubble -->
                <div class="flex flex-col ${isOwnMessage ? 'items-end' : 'items-start'}">
                    <div class="px-4 py-2 rounded-2xl ${isOwnMessage ? 'bg-gradient-to-r from-[#634600] to-[#B59F84] text-white rounded-br-md' : 'bg-white text-[#634600] rounded-bl-md shadow-sm border border-[#B59F84]'}">
                        <p class="text-sm">${message.message}</p>
                    </div>
                    <div class="mt-1 ${isOwnMessage ? 'text-right' : 'text-left'}">
                        <span class="text-xs text-[#786126]">${timeAgo}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

const authUserId = Number(document.querySelector('meta[name="user-id"]')?.content);

if (authUserId) {
    window.Echo.private(`notifications-channel.${authUserId}`)
        .listen('.comment.notification', (e) => {
            console.log("🔔 New Comment Notification:", e);

            // Toast popup
            showNotificationToast(`${e.from_user} commented: "${e.content}"`);

            // Dispatch event for Alpine
            window.dispatchEvent(new CustomEvent('new-notification', {
                detail: {
                    id: Date.now(),
                    data: {
                        from_user: e.from_user,
                        content: e.content,
                        product_id: e.product_id,
                    },
                    created_at: new Date().toISOString(),
                    is_read: false,
                }
            }));
        });
}


function showNotificationToast(message) {
    const toast = document.createElement("div");
    toast.className = "fixed bottom-4 right-4 bg-[#B59F84] text-white px-4 py-2 rounded-lg shadow-lg z-50";
    toast.innerText = message;

    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}


