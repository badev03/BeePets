import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import register from "../../api/register";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { RecaptchaVerifier, signInWithPhoneNumber } from "firebase/auth";
import { toast, Toaster } from "react-hot-toast";
import { auth } from "../../firebase/config";
import OtpInput from "otp-input-react";
const MySwal = withReactContent(Swal);

const Register = () => {
  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();
  const [phoneError, setPhoneError] = useState("");
  const [passwordError, setPasswordError] = useState("");
  const [otp, setOtp] = useState("");
  const [ph, setPh] = useState("");
  const [loading, setLoading] = useState(false);
  const [showOTP, setShowOTP] = useState(false);
  const [user, setUser] = useState(null);

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
    console.log
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
  function onSignup() {
    setLoading(true);
    onCaptchVerify();

    const appVerifier = window.recaptchaVerifier;

    const formatPh = "+84" + phone; // Sử dụng 'phone' trực tiếp thay vì 'formData.phone'

    signInWithPhoneNumber(auth, formatPh, appVerifier)
      .then((confirmationResult) => {
        window.confirmationResult = confirmationResult;
        setLoading(false);
        setShowOTP(true);
        toast.success("OTP đã được gửi thành công!");
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
                    <img src="src/assets/img/login-banner.png" className="img-fluid" alt="Doccure Register" />
                  </div>
                  <div className="col-md-12 col-lg-6 login-right">

                    <form onSubmit={handleSubmit}>
                      {showOTP ? (
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
                            <button className="btn btn-primary w-100 btn-lg login-btn" onClick={onOTPVerify} type="button"> Xác minh OTP</button>

                          </div>
                        </div>
                      ) : (
                        <div>
                          <div className="login-header">
                            <h3>
                              ĐĂNG KÝ <a href="doctor-register.html"></a>
                            </h3>
                          </div>
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
                            onClick={onSignup}
                          >
                            Đăng ký
                          </button>
                        </div>

                      )}
                      <div className="text-end">
                        <Link className="forgot-link" to="/login">Đăng nhập nếu bạn đã có tài khoản ?</Link>
                      </div>


                    </form>
                    <div className="login-or"></div>
                    <div className="login-or">
                    </div>
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

export default Register;
