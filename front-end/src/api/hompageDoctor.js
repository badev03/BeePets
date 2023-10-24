import instance from "./instance";

const HomepageDoctor = {
    getAll(params) {
        const url = "/doctor-home-user";
        return instance.get(url, { params });
    },

    get(slug) {
        const url = `/doctor-home-user/${slug}`;
        return instance.get(url);
    },
};

export default HomepageDoctor;
