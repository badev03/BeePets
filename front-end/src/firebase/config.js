import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

const firebaseConfig = {
  apiKey: "AIzaSyCpWUBUww9rimyb6KkfJ5BObSVg08PGaOw",
  authDomain: "otp-beepets.firebaseapp.com",
  projectId: "otp-beepets",
  storageBucket: "otp-beepets.appspot.com",
  messagingSenderId: "273144371159",
  appId: "1:273144371159:web:4d83fe169223908ee1dd92",
  measurementId: "G-4YHWNMST3H"

  // apiKey: "AIzaSyAFt2t-PHFV9fzfnvdrqCnYQkeibZbiojE",
  // authDomain: "beepets-a5b48.firebaseapp.com",
  // projectId: "beepets-a5b48",
  // storageBucket: "beepets-a5b48.appspot.com",
  // messagingSenderId: "24423023673",
  // appId: "1:24423023673:web:0a4475fc0dd1d7c03839e8",
  // measurementId: "G-Y9NSXB5W47"
};

const app = initializeApp(firebaseConfig);

export const auth = getAuth(app);
