import instance from "./instance";

const ChangePassword = {
  changePasswordDoctor(oldPassword, newPassword, confirmPassword) {
    const url = `/change-password`;
    return instance.put(url, null, {
      params: {
        old_password: oldPassword,
        new_password: newPassword,
        confirm_password: confirmPassword,
      },
    });
  },
};

export default ChangePassword;
