import React from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { useEffect, useState } from "react";
import doctorsApi from '../../api/doctorsApi';
import { useAuth } from '../../Context/ContextAuth';
import logoutDoctor from '../../api/logoutDoctor';
import TopLink from '../../Link/TopLink'
const Menudashboard = () => {

  const [doctor, setDoctors] = useState([]);
  const token = localStorage.getItem('token');
  const navigate = useNavigate();
  const { onLogout } = useAuth(); // Sử dụng context để lấy hàm onLogout

  const handleLogout = async () => {
    // Gọi hàm logout khi người dùng nhấp vào "Đăng Xuất"
    try {
      await logoutDoctor.logout({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      onLogout(); // Gọi hàm onLogout để xác định người dùng đã đăng xuất
      navigate('/'); // Sau khi đăng xuất, điều hướng đến trang chính hoặc trang bạn muốn
    } catch (error) {
      console.log(error);
    }
  };




  if (token) {
    useEffect(() => {
      const fetchDoctor = async () => {
        try {
          const response = await doctorsApi.getDoctor(
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setDoctors(response.doctor);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchDoctor();
    }, []);
  }


  const initialActiveItems = JSON.parse(
    localStorage.getItem("activeItems")
  ) || ["Bộ điều khiển"];
  const [activeItems, setActiveItems] = useState(initialActiveItems);

  const handleItemClick = (itemName) => {
    setActiveItems((prevActiveItems) => {
      if (prevActiveItems.includes(itemName)) {
        return prevActiveItems.filter((item) => item !== itemName);
      } else {
        return [itemName];
      }
    });
  };

  const handleScroll = () => {
    const position = window.scrollY;
    setScrollPosition(position);
  };

  useEffect(() => {
    localStorage.setItem("activeItems", JSON.stringify(activeItems));
  }, [activeItems]);

  useEffect(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);


  return (
    <div className="profile-sidebar" >
      <div className="widget-profile pro-widget-content">
        <div className="profile-info-widget">
          <Link to="#" className="booking-doc-img">
            <img src={doctor.image} alt="User Image" />
          </Link>
          <div className="profile-det-info">
            <h3>{doctor.name}</h3>
            <div className="patient-details">
              <h5 className="mb-0">{doctor.phone}</h5>
            </div>
          </div>
        </div>
      </div>
      <div className="dashboard-widget">
        <nav className="dashboard-menu">
          <ul>

            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Bảng điều khiển")}
            >
              <Link to={"/doctors"}>
                <i className="fas fa-columns" />
                <span>Bảng điều khiển</span>
              </Link>
            </li>
            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors/appointments" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Cuộc hẹn")}
            >
              <Link to={"/doctors/appointments"}>
              <i className="fas fa-calendar-check" />
                <span>Cuộc hẹn</span>
              </Link>
            </li>
            <li className={`has-submenu megamenu ${location.pathname === "/doctors/patients" ? "active" : ""
              }`}
              onClick={() => handleItemClick("Khách hàng của tôi")}>
              <Link to="/doctors/patients">
                <i className="fas fa-user-injured" />
                <span>Khách hàng của tôi</span>
              </Link>
            </li>


            
            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors/review" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Đánh giá")}
            >
              <Link to={"/doctors/review"}>
              <i className="fas fa-star" />
                <span>Đánh giá</span>
              </Link>
            </li>
            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors/customer-invoice" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Hóa đơn của khách hàng")}
            >
              <Link to={"/doctors/customer-invoice"}>
              <i className="fas fa-user-injured" />
                <span>Hóa đơn của khách hàng</span>
              </Link>
            </li>
            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors/profile" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Thông tin tài khoản")}
            >
              <Link to={"/doctors/profile"}>
              <i className="fas fa-user-cog" />
                <span>Thông tin tài khoản</span>
              </Link>
            </li>
            <li
              className={`has-submenu megamenu ${location.pathname === "/doctors/change-password" ? "active" : ""
                }`}
              onClick={() => handleItemClick("Đổi mật khẩu")}
            >
              <Link to={"/doctors/change-password"}>
              <i className="fas fa-lock" />
                <span>Đổi mật khẩu</span>
              </Link>
            </li>
            <li
                className={`has-submenu megamenu ${location.pathname === "/doctor/logout" ? "active" : ""
                  }`}
                onClick={() => handleLogout("Đăng xuất")}
              >
                <TopLink>
                <i className="fas fa-sign-out-alt" />
                  <span>Đăng Xuất</span>
                </TopLink>
              </li>
          </ul>
        </nav>
      </div>
    </div>

  )
}

export default Menudashboard