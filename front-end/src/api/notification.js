import instance from "./instance";

const notification = {
    getUser(params) {
        const url = "/get-notification";
        return instance.get(url, params);
    },
    getDoctor(params) {
        const url = "/get-notification-doctor";
        return instance.get(url, params);
    },
};

export default notification;
