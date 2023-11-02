import instance from "./instance";

const deleteNoti = {
    removeNoti(id) {
        const url = `/delete-read-notification/${id}`;
        return instance.delete(url);
    },
};

export default deleteNoti;
