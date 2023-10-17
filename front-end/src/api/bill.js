import instance from "./instance";

const billApi = {
    getBill(params) {
        const url = "/bill-user";
        return instance.get(url,  params );
      },
};

export default billApi;
