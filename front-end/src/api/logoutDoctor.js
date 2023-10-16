import instance from "./instance";

const logoutDoctor = {

    logout() {
        const url = "/logout-doctor";
        return instance.post(url);
    },
};

export default logoutDoctor;




