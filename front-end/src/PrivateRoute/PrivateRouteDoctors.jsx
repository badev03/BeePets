import React from "react";
import { Route, Navigate } from "react-router-dom";
import { useAuth } from "../Context/ContextAuth";

const PrivateRouteDoctors = ({ element, ...rest }) => {
  const { isLoggedIn } = useAuth();

  if (!isLoggedIn) {
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    return <Navigate to="/login-doctor" />;
  }

  // Nếu người dùng đã đăng nhập, cho phép họ truy cập trang `/doctors`
  return <Route {...rest} element={element} />;
};

export default PrivateRouteDoctors;
