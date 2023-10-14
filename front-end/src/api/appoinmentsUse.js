import instance from "./instance";

const appointmentUsersApi = {
    getAppoinments(params) {
        const url = "/appointment-user";
        return instance.get(url,  params );
      },
};

export default appointmentUsersApi;
