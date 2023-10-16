// AuthContext.js
import { createContext, useContext, useEffect, useState } from 'react';

const AuthContext = createContext();

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {
  const [token, setToken] = useState(localStorage.getItem("token") || null);
  const [user, setUser] = useState(null);

  const handleLoginSuccess = (newToken, newUser) => {
    setToken(newToken);
    setUser(newUser);
    localStorage.setItem("token", newToken);
    localStorage.setItem("user", JSON.stringify(newUser));
  };



  const logout = () => {
    setToken(null);
    localStorage.removeItem('token');
  };

  useEffect(() => {
    // const savedUser = localStorage.getItem('user');
    // if (savedUser) {
    //   setUser(JSON.parse(savedUser));
    // }
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
    <AuthContext.Provider value={contextValue}>
      {children}
    </AuthContext.Provider>
  );
};
