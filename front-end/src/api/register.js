import instance from './instance';

const register = {
  add(data) {
    const url = "/register-user-password";  
    return instance.post(url, data);
  },
};

export default register;
