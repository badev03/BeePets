import React from 'react'
import { Link } from 'react-router-dom'
import usersApi from '../../api/usersApi';
import { useEffect, useState } from "react";
import Booking from '../Booking';
import BookingUser from './BookingUser';

const Sidebar = () => {
  const [user, setUser] = useState([]);

  const token = localStorage.getItem('token');

  if (token) {
    useEffect(() => {
      const fetchUser = async () => {
        try {
          const response = await usersApi.getUser(
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setUser(response.user);
          console.log(response.user);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchUser();
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
    <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
      <div className="profile-sidebar">
        <div className="widget-profile pro-widget-content">
          <div className="profile-info-widget">
            {user.avatar ? (
              <a href="#" className="booking-doc-img">
                <img src={user.avatar} alt="User Image" />
              </a>
            ) : (
              <div className="default-avatar booking-doc-img">
                <img src="https://dvdn247.net/wp-content/uploads/2020/07/avatar-mac-dinh-1.png" alt="Default Avatar" />
              </div>
            )}
            <div className="profile-det-info" style={{ display: user && (user.name || user.phone || user.address) ? 'block' : 'none' }}>
              {user.name && <h3>{user.name}</h3>}
              <div className="patient-details">
                {user.phone && <h5><i className="fas fa-phone" />{user.phone}</h5>}
                {user.address && <h5 className="mb-0"><i className="fas fa-map-marker-alt" />{user.address}</h5>}
              </div>
            </div>
          </div>
        </div>
        <BookingUser/>
        <div className="dashboard-widget">
          <nav className="dashboard-menu">
            <ul>
              <li className={`has-submenu megamenu ${activeItems.includes("Bảng điều khiển") ? "active" : ""
                }`}
                onClick={() => handleItemClick("Bảng điều khiển")}>
                <Link to={"/user/dashbroad"}><i className="fas fa-columns" />
                  <span>Bảng điều khiển</span></Link>

              </li>

              <li className={`has-submenu megamenu ${activeItems.includes("Thông tin cá nhân") ? "active" : ""
                }`}
                onClick={() => handleItemClick("Thông tin cá nhân")}>
                <Link to={"/user/profilesetting"}><i className="fas fa-user-cog" />
                  <span>Thông Tin Cá Nhân</span></Link>

              </li>
              <li className={`has-submenu megamenu ${activeItems.includes("Thay đổi mật khẩu") ? "active" : ""
                }`}
                onClick={() => handleItemClick("Thay đổi mật khẩu")}>
                <Link to={"/user/changepassword"}><i className="fas fa-lock" />
                  <span>Thay Đổi Mật Khẩu</span></Link>

              </li>
              <li className={`has-submenu megamenu ${activeItems.includes("Đăng xuất") ? "active" : ""
                }`}
                onClick={() => handleItemClick("Đăng xuất")}>
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