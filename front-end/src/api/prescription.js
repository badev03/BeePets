import instance from "./instance";

const prescriptionUsersApi = {
  
  getPrescription(params) {
    const url = "/prescription-user";
    return instance.get(url, params);
  },
};


export default prescriptionUsersApi;
