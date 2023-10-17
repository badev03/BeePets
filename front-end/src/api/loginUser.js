import instance from "./instance";

const loginUser = {
  
  add(data) {
    const url = "/check-login";
    return instance.post(url, data);
  },

};

export default loginUser;
