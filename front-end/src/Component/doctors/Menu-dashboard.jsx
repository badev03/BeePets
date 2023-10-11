import React from 'react'
import doctorsApi from '../../api/doctorsApi';
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'

const Menudashboard = () => {
  const [doctor, setDoctors] = useState([]);

  useEffect(() => {
    const fetchDoctor = async () => {
      try {
        const response = await doctorsApi.getDoctor();
        setDoctors(response.doctor);
        console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchDoctor();
  }, []); 
  return (
    <div className="profile-sidebar">
            <div className="widget-profile pro-widget-content">
              <div className="profile-info-widget">
                <Link to="#" className="booking-doc-img">
                  <img src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3>Dr. Darren Elder</h3>
                  <div className="patient-details">
                    <h5 className="mb-0">Đẹp trai &amp; ahihi</h5>
                  </div>
                </div>
              </div>
            </div>
            <div className="dashboard-widget">
              <nav className="dashboard-menu">
                <ul>
                  <li className="active">
                    <Link to="/doctors">
                      <i className="fas fa-columns" />
                      <span>Bộ điều khiển</span>
                    </Link>
                  </li>
                  <li>
                    <Link to="/doctors/appointments">
                      <i className="fas fa-calendar-check" />
                      <span>Cuộc hẹn</span>
                    </Link>
                  </li>
                  <li>
                    <Link to="/doctors/patients">
                      <i className="fas fa-user-injured" />
                      <span>Khách hàng của tôi</span>
                    </Link>
                  </li>
                  
                  
                  <li>
                    <Link to="/doctors/review">
                      <i className="fas fa-star" />
                      <span>Đánh Giá</span>
                    </Link>
                  </li>
                  
                  
                  <li>
                    <Link to="/doctors/profile">
                      <i className="fas fa-user-cog" />
                      <span>Thông tin tài khoản</span>
                    </Link>
                  </li>
                  
                  <li>
                    <Link to="/doctors/change-password">
                      <i className="fas fa-lock" />
                      <span>Đổi mật khẩu</span>
                    </Link>
                  </li>
                  <li>
                    <Link to="login.html">
                      <i className="fas fa-sign-out-alt" />
                      <span>Đăng xuất</span>
                    </Link>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        
  )
}

export default Menudashboard