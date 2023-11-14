import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import { toast, Toaster } from "react-hot-toast";
const CreateRegister = () => {
  const location = useLocation();
  const queryParams = new URLSearchParams(location.search);
  const phone = queryParams.get('phone');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const handleFormSubmit = (event, ph) => {
    event.preventDefault();
    const data = { password, password_confirmation: passwordConfirmation };
    const formattedPh = ph.startsWith("0") ? ph : "" + ph.replace(/^84/, "");
    axios.post(`http://127.0.0.1:8000/api/register-password-new/${encodeURIComponent(formattedPh)}`, data)
      .then(response => {
        console.log(response.data);
        // Xử lý dữ liệu phản hồi theo yêu cầu của bạn
        toast.success("Tạo mật khẩu thành công!");
        window.location.href = `/login`;
      })
      .catch(error => {
        console.error(error);
        toast.error("Lỗi!");
        // Xử lý lỗi theo yêu cầu của bạn
      });
  };

  return (
    <div className="content top-space">
      <Toaster toastOptions={{ duration: 4000 }} />
      <div className="container-fluid">
        <div className="row">
          <div className="col-md-8 offset-md-2">
            <div className="account-content">
              <div className="row align-items-center justify-content-center">
                <div className="col-md-7 col-lg-6 login-left">
                  <img src="src/assets/img/login-banner.png" className="img-fluid" alt="Doccure Register" />
                </div>
                <div className="col-md-12 col-lg-6 login-right">
                  <div className="login-header">
                    <h2>Tạo mật khẩu haha<a href="doctor-register.html"></a></h2>
                  </div>
                  <form onSubmit={(e) => handleFormSubmit(e, phone)}>
                    <div className="mb-3 form-focus">
                      <input type="password" className="form-control floating" value={password} onChange={(e) => setPassword(e.target.value)} />
                      <label className="focus-label">Nhập mật khẩu</label>
                    </div>
                    <div className="mb-3 form-focus">
                      <input type="password" className="form-control floating" value={passwordConfirmation} onChange={(e) => setPasswordConfirmation(e.target.value)} />
                      <label className="focus-label">Nhập lại mật khẩu</label>
                    </div>
                    <button className="btn btn-primary w-100 btn-lg login-btn" type="submit">Xác nhận</button>
                    <div className="login-or"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CreateRegister;
