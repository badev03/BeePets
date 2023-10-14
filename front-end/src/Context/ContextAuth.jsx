import { createContext, useContext, useEffect, useState } from "react";

const AuthContext = createContext();

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {

  const [token, setToken] = useState(localStorage.getItem('token') || null);
  const [dataDoctor, setDataDoctor] = useState({});
  const handleLoginSuccess = (newToken) => {

  
    setToken(newToken);
    setUser(user);
    localStorage.setItem("token", newToken);
    localStorage.setItem("user", JSON.stringify(user));
  };



  const logout = () => {
    setToken(null);
    setUser(null);
    localStorage.removeItem("token");
    localStorage.removeItem("user");
  };

  useEffect(() => {

    const savedUser = localStorage.getItem("user");
    if (savedUser) {
      try {
        const parsedUser = JSON.parse(savedUser);
        setUser(parsedUser);
      } catch (error) {
        console.error("Lỗi khi parse dữ liệu từ localStorage:", error);
      }
    }
  }, [token]);

  const contextValue = {
    token,
    user,
    isLoggedIn: !!token,
    onLoginSuccess: handleLoginSuccess,
    onLogout: logout,
  };

  return (
    <AuthContext.Provider value={contextValue}>{children}</AuthContext.Provider>
  );
};