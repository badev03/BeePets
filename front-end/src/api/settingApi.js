import instance from "./instance";

const settingApi = {
    getAll(params) {
        const url = "/setting";
        return instance.get(url, { params });
    },
    // getDoctor(params) {
    //     const url = "/doctor-info";
    //     return instance.get(url, params);
    // },
    // get(id) {
    //     const url = `/doctors-clients/${id}`;
    //     return instance.get(url);
    // },

    // add(data) {
    //     const url = "/doctors-clients";
    //     return instance.post(url, data);
    // },

    // update(data) {
    //     const url = `/doctors-clients`;
    //     return instance.put(url, data);
    // },

    // remove(id) {
    //     const url = `/doctors-clients/${id}`;
    //     return instance.delete(url);
    // },
};

export default settingApi;
