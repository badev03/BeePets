import instance from "./instance";

const notification = {
    getAll(params) {
        const url = "/get-notification";
        return instance.get(url,params);
    },
};

export default notification;
