import React from 'react'
import { Link } from 'react-router-dom'

const Sidebar = () => {
    
  return (
    <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div className="profile-sidebar">
      <div className="widget-profile pro-widget-content">
        <div className="profile-info-widget">
          <a href="#" className="booking-doc-img">
            <img src="../src/assets/img/patients/patient.jpg" alt="User Image" />
          </a>
          <div className="profile-det-info">
            <h3>Tạ Anh Quý</h3>
            <div className="patient-details">
              <h5><i className="fas fa-birthday-cake" /> 24 Jul 2003, 18 years</h5>
              <h5 className="mb-0"><i className="fas fa-map-marker-alt" /> Newyork, USA</h5>
            </div>
          </div>
        </div>
      </div>
      <div className="dashboard-widget">
        <nav className="dashboard-menu">
          <ul>
            <li className="active">
              <Link to={"/user/dashbroad"}><i className="fas fa-columns" />
                <span>Bảng điều khiển</span></Link>
              
            </li>
            
            <li>
            <Link to={"/user/profilesetting"}><i className="fas fa-user-cog" />
                <span>Thông Tin Cá Nhân</span></Link>
           
            </li>
            <li>
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
  )
}

export default Sidebar