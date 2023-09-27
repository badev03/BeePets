import React from 'react'
import { Link } from 'react-router-dom'

/// COPPY HTML -> PASTE -> CONVERT TO JSX -> PASTE CSS,JS VAO INDEX.HTML

const Register = () => {
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
                    <h3>ĐĂNG KÝ <a href="doctor-register.html"></a></h3>
                    {/* Đăng nhập với tư cách là bác sĩ? */}
                  </div>
                  <form action="">
                    {/* <div className="mb-3 form-focus">
                  <input type="text" className="form-control floating" />
                  <label className="focus-label">Name</label>
                </div> */}
                    <div className="mb-3 form-focus">
                      <input type="text" className="form-control floating" />
                      <label className="focus-label">Nhập SĐT</label>
                    </div>
                    <div className="text-end">
                      <Link to="/login" className="/login">Bạn đã có tài khoản ?</Link>
                    </div>
                    <Link to="/login"> <button className="btn btn-primary w-100 btn-lg login-btn" type="submit">Đăng ký</button> </Link>
                    <div className="login-or">
                      <span className="or-line" />
                      <span className="span-or">or</span>
                    </div>
                    {/* <div className="row social-login">
                  <div className="col-6">
                    <a href="#" className="btn btn-facebook w-100"><i className="fab fa-facebook-f me-1" /> Đăng nhập</a>
                  </div>
                  <div className="col-6">
                    <a href="#" className="btn btn-google w-100"><i className="fab fa-google me-1" /> Đăng nhập</a>
                  </div>
                </div> */}
                    <Link to="/login"><button className="btn btn-danger w-100 btn-lg login-btn" type="submit">Đăng nhập</button></Link>
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

export default Register