import React from 'react'
import { Link } from 'react-router-dom'



const ChangePassword = () => {
  return (
<div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Thay đổi mật khẩu</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Thay đổi mật khẩu</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div className="profile-sidebar">
            <div className="widget-profile pro-widget-content">
              <div className="profile-info-widget">
                <a href="#" className="booking-doc-img">
                  <img src="../src/assets/img/patients/patient.jpg" alt="User Image" />
                </a>
                <div className="profile-det-info">
                  <h3>Richard Wilson</h3>
                  <div className="patient-details">
                    <h5><i className="fas fa-birthday-cake" /> 24 Jul 1983, 38 years</h5>
                    <h5 className="mb-0"><i className="fas fa-map-marker-alt" /> Newyork, USA</h5>
                  </div>
                </div>
              </div>
            </div>
            <div className="dashboard-widget">
              <nav className="dashboard-menu">
                <ul>
                  <li >
                    <Link to={"/user/dashbroad"}><i className="fas fa-columns" />
                      <span>Bảng điều khiển</span></Link>
                    
                  </li>
                  
                  <li>
                  <Link to={"/user/profilesetting"}><i className="fas fa-user-cog" />
                      <span>Thông Tin Cá Nhân</span></Link>
                 
                  </li>
                  <li className="active">
                  <Link to={"/user/changepassword"}><i className="fas fa-lock" />
                      <span>Thay Đổi Mật Khẩu</span></Link>
                  
                  </li>
                  <li>
                    <a href="login.html">
                      <i className="fas fa-sign-out-alt" />
                      <span>Đăng Xuất</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
          <div className="card">
            <div className="card-body">
              <div className="row">
                <div className="col-md-12 col-lg-6">
                  <form>
                    <div className="mb-3">
                      <label className="mb-2">Mật khẩu cũ</label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="mb-3">
                      <label className="mb-2">Mật khẩu mới</label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="mb-3">
                      <label className="mb-2">Nhập lại mật khẩu </label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="submit-section">
                      <button type="submit" className="btn btn-primary submit-btn">Lưu</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div></div>

  )
}

export default ChangePassword