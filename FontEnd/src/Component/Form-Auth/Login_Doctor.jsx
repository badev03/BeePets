import React from 'react'
import { Link } from 'react-router-dom'
const Login_Doctor = () => {
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
                                        <h2>ĐĂNG NHẬP (doctor)</h2>
                                        <Link to="/login" >Đăng nhập với tư cách là user</Link>
                                    </div>
                                    <form action="https://doccure.dreamguystech.com/html/template/patient-register-step1.html">
                                        <div className="mb-3 form-focus">
                                            <input type="text" className="form-control floating" />
                                            <label className="focus-label">Nhập số điện thoại</label>
                                        </div>
                                        <div className="mb-3 form-focus">
                                            <input type="password" className="form-control floating" />
                                            <label className="focus-label">Mật khẩu</label>
                                        </div>
                                        <div className="text-end">
                                            <Link to="/forgot_password_doctor" className="forgot-link" href="forgot_password_Doctor">Quên mật khẩu ?</Link>
                                        </div>
                                        <Link to="/"><button className="btn btn-danger w-100 btn-lg login-btn" type="submit"> Đăng nhập</button></Link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div >
        </div >
    )
}

export default Login_Doctor