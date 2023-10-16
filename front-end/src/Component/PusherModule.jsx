import React, { useEffect } from "react";
import Pusher from 'pusher';

const PusherComponent = ({ onNotification }) => {
    useEffect(() => {
        const pusher = new Pusher("2798806e868dbe640e2e", {
            cluster: "ap1",
        });

        const channel = pusher.subscribe("user-notification-3");
        channel.bind("notification-event", function (data) {
            onNotification(data);
        });

        return () => {
            pusher.disconnect(); // Ngắt kết nối Pusher khi component bị unmount
        };
    }, [onNotification]);

    return null;
};

export default PusherComponent;