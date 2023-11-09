// PrivateRouteDoctors.js
import React from "react";
import { Navigate, Outlet, } from "react-router-dom";
import { useAuth } from "../Context/ContextAuth";

const PrivateRouteDoctors = ({ children }) => {
  const { isLoggedIn } = useAuth();

  return isLoggedIn ? <Outlet /> : <Navigate to="/Login-Doctor" />;
};

export default PrivateRouteDoctors;
