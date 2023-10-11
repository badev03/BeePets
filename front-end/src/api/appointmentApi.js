import instance from "./instance";

const appointmentApi = {
    getAll(params) {
        const url = "/appointmentss";
        return instance.get(url, { params });
    },

    get(id) {
        const url = `/appointmentss/${id}`;
        return instance.get(url);
    },

    add(data) {
        const url = "/appointmentss";
        return instance.post(url, data);
    },

    update(data) {
        const url = `/appointmentss/${data.id}`;
        return instance.patch(url, data);
    },

    remove(id) {
        const url = `/appointmentss/${id}`;
        return instance.delete(url);
    },
};

export default appointmentApi;
