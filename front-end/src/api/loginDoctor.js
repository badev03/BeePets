import instance from "./instance";

const loginDoctor = {

  add(data) {
    const url = "/doctor/login";
    return instance.post(url, data);

  },

};

export default loginDoctor;
