import React, { useState } from "react";
import { useAuth } from "../Context/ContextAuth";
import { useNavigate } from "react-router-dom";
import logoutDoctor from "../api/logoutDoctor"; // Đảm bảo đã import logoutDoctor




const Logout = () => {
    const { onLogout } = useAuth();
    const navigate = useNavigate();
    const [showSuccessAlert, setShowSuccessAlert] = useState(false);
    const [showErrorAlert, setShowErrorAlert] = useState(false);

    const handleLogout = async () => {
        try {
            await logoutDoctor.logout(); // Gọi hàm logoutDoctor.logout() để đăng xuất

            // Thực hiện đăng xuất người dùng khỏi ứng dụng
            onLogout();
            setShowSuccessAlert(true);

            // Redirect hoặc thực hiện hành động sau khi đăng xuất thành công
            navigate("/"); // Ví dụ: Chuyển hướng đến trang chủ sau khi đăng xuất
        } catch (error) {
            console.error("Đăng xuất thất bại:", error.message);
            setShowErrorAlert(true);
        }
    };

    return (
        <div>
            <button onClick={handleLogout}>Đăng xuất</button>
            {showSuccessAlert && <div>Đăng xuất thành công.</div>}
            {showErrorAlert && <div>Đăng xuất thất bại.</div>}
        </div>
    );
};

export default Logout;