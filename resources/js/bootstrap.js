import * as Popper from "@popperjs/core";
window.Popper = Popper;

import "bootstrap";

import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    // Use the keys defined in your .env and config/broadcasting.php
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,

    // Authorization endpoint for private channels (like 'user.{id}')
    wsHost:
        import.meta.env.VITE_PUSHER_HOST ??
        `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],

    // This is vital for authorization to work: it sends the current session cookie.
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                window.axios
                    .post("/broadcasting/auth", {
                        socket_id: socketId,
                        channel_name: channel.name,
                    })
                    .then((response) => {
                        callback(null, response.data);
                    })
                    .catch((error) => {
                        callback(error);
                    });
            },
        };
    },
});

console.log("Laravel Echo initialized and attempting to connect...");
