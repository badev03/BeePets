import instance from "./instance";

const logoutDoctor = {

    logout(header) {
        const url = "logout";

        return instance.post(url, {}, header);

    },
    // delete() {
    //     const url = "/logout-doctor";
    //     return instance.delete(url);
    // },
};

export default logoutDoctor;




