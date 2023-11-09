import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import usersApi from "../../api/usersApi";
import logoutDoctor from "../../api/logoutDoctor";
import { useAuth } from "../../Context/ContextAuth";

const Sidebar = () => {
  const [user, setUser] = useState([]);
  const token = localStorage.getItem("token");
  const navigate = useNavigate();
  const { onLogout } = useAuth();


  const handleLogout = async () => {
    try {
      await logoutDoctor.logout({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      onLogout();
      navigate("/");
    } catch (error) {
      console.log(error);
    }
  };



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
          // console.log(response.user);
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
                <img src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="Default Avatar" />
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

        <div className="dashboard-widget">
          <nav className="dashboard-menu">
            <ul>
              <li
                className={`has-submenu megamenu ${location.pathname === "/user/dashbroad" ? "active" : ""
                  }`}
                onClick={() => handleItemClick("Bảng điều khiển")}
              >
                <Link to={"/user/dashbroad"}>
                  <i className="fas fa-columns" />
                  <span>Bảng điều khiển</span>
                </Link>
              </li>

              {/* Thêm các menu khác tương tự */}
              <li
                className={`has-submenu megamenu ${location.pathname === "/user/profilesetting" ? "active" : ""
                  }`}
                onClick={() => handleItemClick("Thông tin cá nhân")}
              >
                <Link to={"/user/profilesetting"}>
                  <i className="fas fa-user-cog" />
                  <span>Thông Tin Cá Nhân</span>
                </Link>
              </li>
              <li
                className={`has-submenu megamenu ${location.pathname === "/user/changepassword" ? "active" : ""
                  }`}
                onClick={() => handleItemClick("Thay đổi mật khẩu")}
              >
                <Link to={"/user/changepassword"}>
                  <i className="fas fa-lock" />
                  <span>Thay Đổi Mật Khẩu</span>
                </Link>
              </li>

              <li
                className={`has-submenu megamenu ${location.pathname === "/user/logout" ? "active" : ""
                  }`}
                onClick={() => handleLogout("Đăng xuất")}
              >
                <a>
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