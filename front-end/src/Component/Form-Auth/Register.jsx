import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import register from "../../api/register";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);

const Register = () => {
  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();
  const [phoneError, setPhoneError] = useState("");
  const [passwordError, setPasswordError] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!phone) {
      setPhoneError("Vui lòng nhập số điện thoại.");
      return;
    } else if (!/^\d{10}$/.test(phone)) {
      setPhoneError("Số điện thoại phải có 10 chữ số.");
      return;
    } else {
      setPhoneError(""); 
    }

    if (!password) {
      setPasswordError("Vui lòng nhập mật khẩu.");
      return;
    } else if (password.length < 6) {
      setPasswordError("Mật khẩu phải có ít nhất 6 ký tự.");
      return;
    } else {
      setPasswordError(""); 
    }
    
    try {
      const response = await register.add({
        phone: phone,
        password: password,
      });

      console.log(response.data);

      MySwal.fire({
        title: "Đăng kí thành công!",
        icon: "success",
      });
      navigate("/login");
    } catch (error) {
      MySwal.fire({
        title: "Số điện thoại đã tồn tại",
        icon: "error",
      });
    }
  };

  return (
    <div className="content top-space">
      <div className="container-fluid">
        <div className="row">
          <div className="col-md-8 offset-md-2">
            <div className="account-content">
              <div className="row align-items-center justify-content-center">
                <div className="col-md-7 col-lg-6 login-left">
                  <img
                    src="src/assets/img/login-banner.png"
                    className="img-fluid"
                    alt="Doccure Register"
                  />
                </div>
                <div className="col-md-12 col-lg-6 login-right">
                  <div className="login-header">
                    <h3>
                      ĐĂNG KÝ <a href="doctor-register.html"></a>
                    </h3>
                  </div>
                  <form onSubmit={handleSubmit}>
                    <div className="mb-3 form-focus">
                      <input
                        type="text"
                        className="form-control floating"
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                      />
                      <label className="focus-label">Nhập SĐT</label>
                      <p className="text-danger">{phoneError}</p>
                    </div>
                    <div className="mb-3 form-focus">
                      <input
                        type="text"
                        className="form-control floating"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                      />
                      <label className="focus-label">Nhập mật khẩu</label>
                      <p className="text-danger">{passwordError}</p>
                    </div>
                    <div className="text-end">
                      <p></p>
                      <Link to="/login" className="/login">
                        Bạn đã có tài khoản ?
                      </Link>
                    </div>
                    <button
                      className="btn btn-primary w-100 btn-lg login-btn"
                      type="submit"
                    >
                      Đăng ký
                    </button>
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

export default Register;
