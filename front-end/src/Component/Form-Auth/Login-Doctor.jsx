import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import loginDoctor from "../../api/loginDoctor";
import SweetAlert from "react-bootstrap-sweetalert";
import { useAuth } from "../../Context/ContextAuth";

const LoginDoctor = () => {
  const [formData, setFormData] = useState({
    phone: "",
    password: "",
  });

  const [errors, setErrors] = useState({});
  const [showSuccessAlert, setShowSuccessAlert] = useState(false);
  const [showErrorAlert, setShowErrorAlert] = useState(false);
  const [isRedirecting, setIsRedirecting] = useState(false);
  const navigate = useNavigate();
  const { onLoginSuccess } = useAuth();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
    setErrors({ ...errors, [name]: "" });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await loginDoctor.add(formData);

      if (response.doctor) {
        setShowSuccessAlert(true);
        setIsRedirecting(true);

        onLoginSuccess();
      } else {
        setShowErrorAlert(true);
      }
    } catch (error) {
      console.error("Đăng nhập thất bại:", error.message);
      setShowErrorAlert(true);
    }
  };

  const handleConfirmSuccess = () => {
    setShowSuccessAlert(false);
    if (isRedirecting) {
      navigate("/doctors");
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
                    <h2>ĐĂNG NHẬP (doctor)</h2>
                    <Link to="/login">Đăng nhập với tư cách là user</Link>
                  </div>
                  <form onSubmit={handleSubmit}>
                    <div className="mb-3 form-focus">
                      <input
                        type="text"
                        className="form-control floating"
                        name="phone"
                        value={formData.phone}
                        onChange={handleChange}
                      />
                      <label className="focus-label">Nhập số điện thoại</label>
                    </div>
                    <div className="mb-3 form-focus">
                      <input
                        type="password"
                        className="form-control floating"
                        name="password"
                        value={formData.password}
                        onChange={handleChange}
                      />
                      <label className="focus-label">Mật khẩu</label>
                    </div>
                    <div className="text-end">
                      <Link
                        to="/forgot-password-doctor"
                        className="forgot-link"
                        href="forgot-password-Doctor"
                      >
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
                  </form>
                  <SweetAlert
                    success
                    title="Đăng nhập thành công!"
                    show={showSuccessAlert}
                    onConfirm={handleConfirmSuccess}
                  >
                    Chào mừng bạn!
                  </SweetAlert>

                  <SweetAlert
                    error
                    title="Đăng nhập thất bại!"
                    show={showErrorAlert}
                    onConfirm={() => setShowErrorAlert(false)}
                  >
                    Vui lòng kiểm tra lại thông tin đăng nhập.
                  </SweetAlert>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LoginDoctor;
