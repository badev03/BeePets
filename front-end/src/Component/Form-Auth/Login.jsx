import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../Context/ContextAuth";
import loginUser from "../../api/loginUser";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);

const Login = () => {
  const [formData, setFormData] = useState({
    phone: "",
    password: "",
  });

  const [errors, setErrors] = useState({});
  const navigate = useNavigate();
  const { onLoginSuccess } = useAuth();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
    setErrors({ ...errors, [name]: "" });
  };

  const validateForm = () => {
    let isValid = true;
    const newErrors = {};

    if (!formData.phone.trim()) {
      newErrors.phone = "Vui lòng nhập số điện thoại.";
      isValid = false;
    }

    if (!formData.password.trim()) {
      newErrors.password = "Vui lòng nhập mật khẩu.";
      isValid = false;
    }

    setErrors(newErrors);
    return isValid;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (validateForm()) {
      try {
        const response = await loginUser.add(formData);

        if (response.token) {
          onLoginSuccess(response.token, response.user);
          MySwal.fire({
            title: "Đăng nhập thành công!",
            icon: "success",
          });
          navigate("/user/dashbroad");
        } 
      } catch (error) {
        MySwal.fire({
          title: "Bạn đã sai tài khoản hoặc mật khẩu!",
          icon: "error",
        });
      }
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
                    src="/assets/img/login-banner.png"
                    className="img-fluid"
                    alt="Doccure Register"
                  />
                </div>
                <div className="col-md-12 col-lg-6 login-right">
                  <div className="login-header">
                    <h2>ĐĂNG NHẬP</h2>
                    <Link to="/login-doctor">
                      Đăng nhập với tư cách là bác sĩ?
                    </Link>
                  </div>
                  <form onSubmit={handleSubmit}>
                    <div className="mb-3 form-focus">
                      <input
                        type="text"
                        className={`form-control floating ${errors.phone ? "is-invalid" : ""}`}
                        name="phone"
                        value={formData.phone}
                        onChange={handleChange}
                      />
                      <label className="focus-label">Nhập số điện thoại</label>
                      {errors.phone && <div className="invalid-feedback">{errors.phone}</div>}
                    </div>
                    <div className="mb-3 form-focus">
                      <input
                        type="password"
                        className={`form-control floating ${errors.password ? "is-invalid" : ""}`}
                        name="password"
                        value={formData.password}
                        onChange={handleChange}
                      />
                      <label className="focus-label">Mật khẩu</label>
                      {errors.password && <div className="invalid-feedback">{errors.password}</div>}
                    </div>
                    <div className="text-end">
                      <Link className="forgot-link" to="/Forgot-password">
                        Quên mật khẩu ?
                      </Link>
                    </div>
                    <button
                      className="btn btn-danger w-100 btn-lg login-btn"
                      type="submit"
                    >
                      {" "}
                      Đăng nhập
                    </button>
                    <div className="login-or">
                      <span className="or-line" />
                      <span className="span-or">or</span>
                    </div>
                    <div className="text-end">
                      <label htmlFor=""> Bạn chưa có tài khoản ? </label>
                      <Link className="forgot-link" to="/register">
                        Đăng ký ?
                      </Link>
                    </div>
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

export default Login;
