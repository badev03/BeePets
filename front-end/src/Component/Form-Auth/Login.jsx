import { useState ,useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../Context/ContextAuth";
import loginUser from "../../api/loginUser";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { RecaptchaVerifier, signInWithPhoneNumber } from "firebase/auth";
import { toast, Toaster } from "react-hot-toast";
import { auth } from "../../firebase/config";
import OtpInput from "otp-input-react";
import PhoneInput from "react-phone-input-2";
import "react-phone-input-2/lib/style.css";
const MySwal = withReactContent(Swal);

const Login = () => {
  const [formData, setFormData] = useState({
    phone: "",
    password: "",
  });

  const [errors, setErrors] = useState({});
  const navigate = useNavigate();
  const { onLoginSuccess } = useAuth();
  const [showOTP, setShowOTP] = useState(false);
  const [otp, setOtp] = useState("");
  const [ph, setPh] = useState("");
  const [loading, setLoading] = useState(false);
  const [user, setUser] = useState(null);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
    setErrors({ ...errors, [name]: "" });
  };
  function onCaptchVerify() {
    if (!window.recaptchaVerifier) {
      window.recaptchaVerifier = new RecaptchaVerifier(
        "recaptcha-container",
        {
          size: "invisible",
          callback: (response) => {
            onSignup();
          },
          "expired-callback": () => { },
        },
        auth
      );
    }
  }

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
          // navigate("/user/dashbroad");
        }
      } catch (error) {
        MySwal.fire({
          title: "Bạn đã sai tài khoản hoặc mật khẩu!",
          icon: "error",
        });
      }
    }
  };
  
  
  function onSignup() {
    setLoading(true);
    onCaptchVerify();

    const appVerifier = window.recaptchaVerifier;

    const formatPh = "+84" + formData.phone
    console.log(formatPh);

    signInWithPhoneNumber(auth, formatPh, appVerifier)
      .then((confirmationResult) => {
        window.confirmationResult = confirmationResult;
        setLoading(false);
        setShowOTP(true);
        toast.success("OTP sended successfully!");
      })
      .catch((error) => {
        console.log(error);
        setLoading(false);
      });
  }
  function onOTPVerify() {
    setLoading(true);
    window.confirmationResult
      .confirm(otp)
      .then(async (res) => {
        console.log(res);
        setUser(res.user);
        setLoading(false);
        navigate("/user/dashbroad");
      })
      .catch((err) => {
        console.log(err);
        setLoading(false);
      });
  }


  return (
    <section className="bg-emerald-500 flex items-center justify-center h-screen">
      <div className="content top-space">
        <Toaster toastOptions={{ duration: 4000 }} />
        <div id="recaptcha-container"></div>
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

                    <form onSubmit={handleSubmit}>
                      {showOTP ? (
                        <div>
                          <div>
                            <div className="login-header">
                              <h2>Xác minh OTP <a href="doctor-register.html"></a></h2>
                              <p>Nhập OTP của bạn để đặt lại mật khẩu</p>
                            </div>
                            <div className="mb-3 form-focus">
                              <OtpInput
                                value={otp}
                                onChange={setOtp}
                                OTPLength={6}
                                otpType="number"
                                disabled={false}
                                autoFocus
                                className="opt-container "
                              ></OtpInput>
                            </div>
                            <button className="btn btn-primary w-100 btn-lg login-btn" onClick={onOTPVerify} type="button"> Xác minh OTP</button>
                          </div>
                        </div>
                      ) : (
                        <div>
                          <div className="login-header">
                            <h2>ĐĂNG NHẬP</h2>
                            <Link to="/login-doctor">
                              Đăng nhập với tư cách là bác sĩ?
                            </Link>
                          </div>
                          <div className="mb-3 form-focus">
                            <input
                              type="text"
                              className={`form-control floating ${errors.phone ? "is-invalid" : ""}`}
                              name="phone"
                              value={formData.phone}
                              onChange={handleChange}
                            />
                            {/* <PhoneInput country={"vn"} className={`form-control floating ${errors.phone ? "is-invalid" : ""}`} value={formData.phone} onChange={handleChange} countryCodeEditable={false} /> */}
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
                            onClick={onSignup}
                          >
                            {" "}
                            Đăng nhập
                          </button>
                        </div>

                      )}

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
    </section>
  );
};

export default Login;
