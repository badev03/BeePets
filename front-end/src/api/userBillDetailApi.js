import instance from "./instance";

const userBillDetailApi = {
    getAll(params) {
        const url = "/billdetails";
        return instance.get(url, { params });
    },

    get(id) {
        const url = `/billdetails/${id}`;
        return instance.get(url);
    },

    add(data) {
        const url = "/billdetails";
        return instance.post(url, data);
    },

    update(data) {
        const url = `/billdetails/${data.id}`;
        return instance.patch(url, data);
    },

    remove(id) {
        const url = `/billdetails/${id}`;
        return instance.delete(url);
    },
};

export default userBillDetailApi;
