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
};

const app = initializeApp(firebaseConfig);

export const auth = getAuth(app);
