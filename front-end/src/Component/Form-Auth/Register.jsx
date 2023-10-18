import React, { useState } from 'react'
import { Link } from 'react-router-dom'
import register from '../../api/register';

const Register = () => {
  const [phoneNumber, setPhoneNumber] = useState('');
  const [error, setError] = useState('');

  const handlePhoneChange = (e) => {
    setPhoneNumber(e.target.value);
    setError(''); 
  };

  const handleSignUp = async () => {
    try {
      const confirmationResult = await register.createPhoneNumber(phoneNumber);
      console.log('OTP sent successfully:', confirmationResult);
    } catch (error) {
      console.error('Error signing up:', error);
      setError('Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại.'); 
  }
}

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
                  </div>
                  <form action="">
                    <div className="mb-3 form-focus">
                      <input type="text" value={phoneNumber} onChange={handlePhoneChange} className="form-control floating" />
                      <label className="focus-label">Nhập SĐT</label>
                    </div>
                    <div className="text-end">
                      <p></p>
                      <Link to="/login" className="/login">Bạn đã có tài khoản ?</Link>
                    </div>
                    <Link to="/create-password"> <button onClick={handleSignUp} className="btn btn-primary w-100 btn-lg login-btn" type="submit">Đăng ký</button> </Link>
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