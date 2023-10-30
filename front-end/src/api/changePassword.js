import instance from "./instance";

const ChangePassword = {
  changePasswordDoctor(passwordData, config = {}) {
    const url = `/change-password`;
    return instance.put(url,passwordData, config);
  },
  changePasswordUser(passwordData, config = {}) {
    const url = `/change-password-user`;
    return instance.put(url,passwordData, config);
  },
};


export default ChangePassword;
