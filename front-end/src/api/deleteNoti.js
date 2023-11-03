import instance from "./instance";

const deleteNoti = {
    removeNoti(id, token) {
        const url = `/delete-read-notification/${id}`;
        const config = {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        };
        return instance.delete(url, config);
    },
};

export default deleteNoti;