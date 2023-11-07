import instance from "./instance";

const aboutsApi = {
    getAll(params) {
        const url = "/about";
        return instance.get(url, { params });
    },
};

export default aboutsApi;
