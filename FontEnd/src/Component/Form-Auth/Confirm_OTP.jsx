import React from 'react'
import { Link } from 'react-router-dom'
const Confirm_OTP = () => {
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
                                        <h2>Xác nhận OTP</h2>
                                        <p>Chúng tôi đã gửi mã xác nhận về số điện thoại của bạn</p>
                                    </div>
                                    <form action="https://doccure.dreamguystech.com/html/template/patient-register-step1.html">
                                        <div className="mb-3 form-focus">
                                            <input type="text" className="form-control floating w-50" />
                                            <label className="focus-label ">Nhập mã OTP tại đây</label>
                                        </div>
                                        <div className="text-end">
                                            <Link className="forgot-link" to="/login">Gửi lại mã OTP  ?</Link>

                                        </div>
                                        <Link to="/create_password"><button className="btn btn-primary w-100 btn-lg login-btn" type="submit">Xác nhận</button></Link>

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

export default Confirm_OTP