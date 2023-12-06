import { Link } from "react-router-dom";
import React, { useState } from "react";
import PhoneInput from "react-phone-input-2";
import "react-phone-input-2/lib/style.css";
import { RecaptchaVerifier, signInWithPhoneNumber } from "firebase/auth";
import { toast, Toaster } from "react-hot-toast";
import { auth } from "../../firebase/config";
import OtpInput from "otp-input-react";
import axios from "axios";
import {linkSrc} from "../globalSrc.jsx";
const Register = () => {
  const [otp, setOtp] = useState("");
  const [ph, setPh] = useState("");
  const [loading, setLoading] = useState(false);
  const [showOTP, setShowOTP] = useState(false);
  const [user, setUser] = useState(null);
  function onCaptchVerify() {
    if (!window.recaptchaVerifier) {
      window.recaptchaVerifier = new RecaptchaVerifier(
        auth,

        "recaptcha-container",
        {
          size: "invisible",
          callback: (response) => {
            checkPhoneNumberExistsAndSignup();
          },
          "expired-callback": () => {},
        }
      );
    }
  }

  function checkPhoneNumberExistsAndSignup() {
    const data = { phone: ph.replace(/^840/, "0") };
    axios
      .post("http://127.0.0.1:8000/api/check-verify-register", data)
      .then((response) => {
        onSignup();
      })
      .catch((error) => {
        toast.error("Số điện thoại đã đăng ký");
        console.error(error);
        setShowOTP(false);
        return;
      });
  }

  function onSignup() {
    setLoading(true);
    onCaptchVerify();

    const appVerifier = window.recaptchaVerifier;

    let formattedPh = ph; // Giữ nguyên số điện thoại ban đầu

    // Kiểm tra nếu số điện thoại có số 0 ở đầu thì loại bỏ nó
    if (ph.startsWith("0")) {
      formattedPh = ph.slice(1);
    }

    const formatPh = "+" + formattedPh;

    signInWithPhoneNumber(auth, formatPh, appVerifier)
      .then((confirmationResult) => {
        window.confirmationResult = confirmationResult;
        setLoading(false);
        setShowOTP(true);
        toast.success("OTP đã được gửi thành công!");
      })
      .catch((error) => {
        console.error(error);
        setLoading(false);
      });
  }

  function onOTPVerify() {
    const formatPh = "+" + ph;
    const formattedPh = formatPh.replace("+84", "");
    setLoading(true);
    window.confirmationResult
      .confirm(otp)
      .then(async (res) => {
        console.log(res);
        setUser(res.user);
        setLoading(false);
        window.location.href = `/Register-password?phone=${encodeURIComponent(
          formattedPh
        )}`;
        toast.success("OTP chính xác!"); // Hiển thị thông báo khi OTP chính xác
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
        toast.error("OTP không chính xác!"); // Hiển thị thông báo khi OTP không chính xác
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
                      src={linkSrc + "/assets/img/login-banner.png"}
                      className="img-fluid"
                      alt="Doccure Register"
                    />
                  </div>
                  <div className="col-md-12 col-lg-6 login-right">
                    <form action="https://doccure.dreamguystech.com/html/template/patient-register-step1.html">
                      {showOTP ? (
                        <div>
                          <div className="login-header">
                            <h2>
                              Xác minh OTP <a href="doctor-register.html"></a>
                            </h2>
                            <p>Nhập OTP của bạn để đặt đăng ký</p>
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
                        </div>
                      ) : (
                        <div>
                          <div className="login-header">
                            <h2>
                              Đăng ký ? <a href="doctor-register.html"></a>
                            </h2>
                            <p>Nhập SĐT của bạn để nhận link đặt mật khẩu</p>
                          </div>
                          <div className="mb-3 form-focus">
                            <PhoneInput
                              country={"vn"}
                              value={ph}
                              onChange={setPh}
                              countryCodeEditable={false}
                            />
                          </div>
                        </div>
                      )}
                      <div className="text-end">
                        <Link className="forgot-link" to="/login">
                          Đăng nhập nếu bạn đã có tài khoản ?
                        </Link>
                      </div>
                      {showOTP ? (
                        <button
                          className="btn btn-primary w-100 btn-lg login-btn"
                          onClick={onOTPVerify}
                          type="button"
                        >
                          {" "}
                          Xác minh OTP
                        </button>
                      ) : (
                        <button
                          className="btn btn-primary w-100 btn-lg login-btn"
                          onClick={checkPhoneNumberExistsAndSignup}
                          type="button"
                        >
                          {" "}
                          Gửi mã qua SMS
                        </button>
                      )}
                    </form>
                    <div className="login-or"></div>
                    <div className="login-or"></div>
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
