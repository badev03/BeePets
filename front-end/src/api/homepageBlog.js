import instance from "./instance";

const HomepageBlogApi = {
    getAll(params) {
        const url = "/new-home";
        return instance.get(url, { params });
    },

    get(slug) {
        const url = `/new-home/${slug}`;
        return instance.get(url);
    },
};

export default HomepageBlogApi;
