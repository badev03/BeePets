import instance from "./instance";

const billApi = {
    getBill(params) {
        const url = "/appointment-user";
        return instance.get(url,  params );
      },
};

export default billApi;
