import instance from "./instance";

const ChangePassword = {
  changePasswordDoctor(passwordData) {
    const url = `/change-password`;
    return instance.put(url, passwordData);
  },
};

export default ChangePassword;
