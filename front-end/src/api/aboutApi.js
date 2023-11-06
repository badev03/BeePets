import instance from "./instance";

const aboutApi = {
    getAll(params) {
        const url = "/new-home";
        return instance.get(url, { params });
    },
};

export default aboutApi;
