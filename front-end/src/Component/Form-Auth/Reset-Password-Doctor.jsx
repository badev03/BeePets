import React from "react";

const ResetPasswordDoctor = () => {
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
                    <h2>
                      Đặt lại mật khẩu (doctor){" "}
                      <a href="doctor-register.html"></a>
                    </h2>
                  </div>
                  <form action="https://doccure.dreamguystech.com/html/template/patient-register-step1.html">
                    <div className="mb-3 form-focus">
                      <input type="text" className="form-control floating" />
                      <label className="focus-label">Mật khẩu mới</label>
                    </div>
                    <div className="mb-3 form-focus">
                      <input type="text" className="form-control floating" />
                      <label className="focus-label">Nhập lại mật khẩu</label>
                    </div>

                    <div className="text-end">
                      <a className="forgot-link" href="login">
                        Đăng nhập nếu bạn đã có tài khoản ?
                      </a>
                    </div>
                    <button
                      className="btn btn-primary w-100 btn-lg login-btn"
                      type="submit"
                    >
                      Đặt lại mật khẩu
                    </button>
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

export default ResetPasswordDoctor;
