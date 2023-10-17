import React from 'react'
import { Link } from 'react-router-dom'
const ForgotPassword = () => {
    return (
        <div className="content top-space">
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
                                        <h2>Quên mật khẩu ? <a href="doctor-register.html"></a></h2>
                                        <p>Nhập SĐT của bạn để nhận link đặt lại mật khẩu</p>
                                    </div>
                                    <form action="https://doccure.dreamguystech.com/html/template/patient-register-step1.html">
                                        <div className="mb-3 form-focus">
                                            <input type="text" className="form-control floating" />
                                            <label className="focus-label">Nhập SĐT</label>
                                        </div>
                                        <div className="text-end">
                                            <Link className="forgot-link" to="/login">Đăng nhập nếu bạn đã có tài khoản ?</Link>

                                        </div>
                                        <Link to="/Create-Password"> <button className="btn btn-primary w-100 btn-lg login-btn" type="submit"> Đặt lại mật khẩu</button></Link>
                                        <div className="login-or"></div>
                                        <div className="login-or">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default ForgotPassword