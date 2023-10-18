// register.js
// import { auth } from '../firebase/config';
import instance from './instance';

const register = {
    async createPhoneNumber(phone) {
        try {
          const url = "/check-verify-register";
          const confirmationResult = await instance.post(url, { phone });
          return confirmationResult;
        } catch (error) {
          console.error('Error creating phone number:', error);
          throw error;
        }
      },
    
      async confirmPhoneNumber(confirmationResult, code) {
        try {
          const userCredential = await confirmationResult.confirm(code);
          return userCredential;
        } catch (error) {
          console.error('Error confirming phone number:', error);
          throw error;
        }
      },

  async createPassword(passwordData) {
    try {
      const url = "/create-password";
      const userCredential = await instance.post(url, passwordData);
      return userCredential;
    } catch (error) {
      console.error('Error creating password:', error);
      throw error;
    }
  },
};

export default register;
