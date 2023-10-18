// firebase.js
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';

const firebaseConfig = {
  apiKey: "AIzaSyAy-p7LI0CaVFvG57Ppy9K6o5y_w00TgFw",
  authDomain: "laraveltest-607f2.firebaseapp.com",
  projectId: "laraveltest-607f2",
  storageBucket: "laraveltest-607f2.appspot.com",
  messagingSenderId: "1043415196689",
  appId: "1:1043415196689:web:b49dbe270025b7739cfdb0",
  measurementId: "G-M6N42QBZTW",
};

const app = initializeApp(firebaseConfig);

export const auth = getAuth(app);
