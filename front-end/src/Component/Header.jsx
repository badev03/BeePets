import { useEffect, useState } from "react";
import { useAuth } from "../Context/ContextAuth";
import { Link, useNavigate } from "react-router-dom";
import logoutDoctor from "../api/logoutDoctor";
import notification from "../api/notification";
import BookingUser from "./User/BookingUser";
import settingApi from "../api/settingApi";
import { Button } from "antd";

const Header = () => {
  const { isLoggedIn, onLogout, token } = useAuth();
  const navigate = useNavigate();
  const [noti, setNoti] = useState([]);
  const imgDefault =
    "https://dvdn247.net/wp-content/uploads/2020/07/avatar-mac-dinh-1.png";
  let userLocal = localStorage.getItem("user");
  const [setting, setSetting] = useState([]);
  const [scrollPosition, setScrollPosition] = useState(0);
  const [data, setData] = useState(null);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await settingApi.getAll();
        setSetting(response.setting);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, []);
  if (!setting) {
    return <div>Loading...</div>;
  }

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
      navigate("/login");
    } catch (error) {
      console.log(error);
    }
  };

  const handleScroll = () => {
    const position = window.scrollY;
    setScrollPosition(position);
  };

  useEffect(() => {
    if (userLocal) {
      setData(JSON.parse(userLocal));
    }
  }, [userLocal]);

  useEffect(() => {
    if (data) {
      handleGetNotice(data);
    }
  }, [data]);

  const handleCheckAccount = (data) => {
    if (data?.role_id === 4) {
      return true;
    } else {
      return false;
    }
  };

  const handleGetNotice = async (data) => {
    if (data?.role_id === 4) {
      const response = await notification.getUser({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setNoti(response.notifications);

      const pusher = new Pusher("2798806e868dbe640e2e", {
        cluster: "ap1",
      });

      const channel = pusher.subscribe("user-notification-" + data.id);

      channel.bind("notification-event-test", function (data) {
        setNoti((prevData) => {
          const newData = {
            message: data.message,
            name: data.name,
            avatar: data.avatar,
            id: data.id,
          };
          return [newData, ...prevData];
        });
      });
    } else {
      const response = await notification.getDoctor({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setNoti(response.notifications);

      const pusher = new Pusher("2798806e868dbe640e2e", {
        cluster: "ap1",
      });

      const channel = pusher.subscribe("doctor-notification-" + data.id);
      channel.bind("notification-event-doctor", function (data) {
        setNoti((prevData) => {
          const newData = {
            message: data.message,
            name: data.name,
            avatar: data.avatar,
            id: data.id,
          };
          return [newData, ...prevData];
        });
      });
    }
  };

  useEffect(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  const isActive = (pathsToExclude) => {
    return !pathsToExclude.some(
      (path) => location.pathname === path || location.pathname.startsWith(path)
    );
  };

  return (
    <header
      id="page-header"
      className="header header-fixed header-fourteen header-twelve"
      style={{
        backgroundColor: scrollPosition > 40 ? "#fff" : "transparent",
        boxShadow:
          scrollPosition > 40 ? "rgba(0, 0, 0, 0.35) 0px 5px 15px" : "",
      }}
    >
      <div className="container">
        <nav className="navbar navbar-expand-lg header-nav">
          <div className="navbar-header">
            <a id="mobile_btn" href="#">
              <span className="bar-icon">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </a>
            <a href={"/"} className="navbar-brand logo">
              <img
                src={setting.image_header}
                className="img-fluid"
                alt="Logo"
              />
            </a>
          </div>
          <div className="main-menu-wrapper" role="list">
            <div className="menu-header">
              <a href="/" className="menu-logo">
                <img
                  src="../src/assets/img/logo.png"
                  className="img-fluid"
                  alt="Logo"
                />
              </a>
              <a id="menu_close" className="menu-close" href="#">
                <i className="fas fa-times"></i>
              </a>
            </div>

            <ul className="main-nav">
              <li
                className={`has-submenu megamenu ${
                  isActive(["/doctor", "/doctors", "/abouts", "/blog"])
                    ? "active"
                    : ""
                }`}
              >
                <a href="/">TRANG CHỦ</a>
              </li>
              <li
                className={`has-submenu ${
                  location.pathname.startsWith("/doctor", "/doctors")
                    ? "active"
                    : ""
                }`}
              >
                <a href="/doctor">BÁC SĨ </a>
              </li>
              <li
                className={`has-submenu ${
                  location.pathname.startsWith("/abouts") ? "active" : ""
                }`}
              >
                <a href="/abouts">GIỚI THIỆU </a>
              </li>
              <li
                className={`has-submenu ${
                  location.pathname.startsWith("/blog") ? "active" : ""
                }`}
              >
                <a href="/blog">TIN TỨC </a>
              </li>
              <div
                style={{
                  display: "flex",
                  alignItems: "center",
                  color: "white",
                }}
              >
                <Button style={{ color: "white" }} type="primary">
                  <BookingUser />
                </Button>
              </div>
            </ul>
          </div>
          <ul className="nav header-navbar-rht">
            {isLoggedIn ? (
              <>
                <li className="nav-item dropdown noti-nav me-3 pe-0">
                  <a
                    href="#"
                    className="dropdown-toggle nav-link p-0"
                    data-bs-toggle="dropdown"
                  >
                    <i className="fa-solid fa-bell" />{" "}
                    <span className="badge">{noti.length}</span>
                  </a>
                  <div className="dropdown-menu notifications dropdown-menu-end ">
                    <div className="topnav-dropdown-header">
                      <span className="notification-title">Notifications</span>
                    </div>
                    <div className="noti-content">
                      <ul className="notification-list">
                        {noti.map((notifications) => (
                          <li className="notification-message" key={noti.id}>
                            <a href="#">
                              <div className="notify-block d-flex">
                                <span className="avatar">
                                  <img
                                    className="avatar-img"
                                    alt="Ruby perin"
                                    src={notifications.avatar}
                                  />
                                </span>
                                <div className="media-body">
                                  <h6>
                                    {notifications.name}
                                    <span className="notification-time">
                                      {notifications.created_at}
                                    </span>
                                  </h6>
                                  <p className="noti-details">
                                    {notifications.message}
                                  </p>
                                </div>
                              </div>
                            </a>
                          </li>
                        ))}
                      </ul>
                    </div>
                  </div>
                </li>
                <li className="nav-item dropdown has-arrow logged-item">
                  <a
                    href="#"
                    className="dropdown-toggle nav-link"
                    data-bs-toggle="dropdown"
                  >
                    <span className="user-img">
                      <img
                        className="rounded-circle"
                        src={
                          handleCheckAccount(data)
                            ? data?.avatar
                              ? data?.avatar
                              : imgDefault
                            : data?.image
                            ? data?.image
                            : imgDefault
                        }
                        width={31}
                      />
                    </span>
                  </a>
                  <div className="dropdown-menu dropdown-menu-end">
                    <div className="user-header">
                      <div className="avatar avatar-sm">
                        <img
                          src={
                            handleCheckAccount(data)
                              ? data?.avatar
                                ? data?.avatar
                                : imgDefault
                              : data?.image
                              ? data?.image
                              : imgDefault
                          }
                          alt="User Image"
                          className="avatar-img rounded-circle"
                        />
                      </div>
                      <div className="user-text">
                        <h6>{data?.name}</h6>
                        <p className="text-muted mb-0">
                          {handleCheckAccount(data) ? "User" : "Doctor"}
                        </p>
                      </div>
                    </div>

                    <Link
                      to={
                        handleCheckAccount(data)
                          ? "/user/dashbroad"
                          : "/doctors"
                      }
                      className="dropdown-item"
                    >
                      Dashboard
                    </Link>
                    <Link
                      to={
                        handleCheckAccount(data)
                          ? "/user/profilesetting"
                          : "/doctors/profile"
                      }
                      className="dropdown-item"
                      href="doctor-profile-settings.html"
                    >
                      Profile Settings
                    </Link>
                    <button className="dropdown-item" onClick={handleLogout}>
                      {" "}
                      Logout{" "}
                    </button>
                  </div>
                </li>
              </>
            ) : (
              <>
                <li className="searchbar searchbar-fourteen me-2">
                  <a href="#">
                    <i className="feather-search"></i>
                  </a>
                  <div className="togglesearch">
                    <form action="https://doccure.dreamguystech.com/html/template/search-2.html">
                      <div className="input-group">
                        <input type="text" className="form-control" />
                        <button type="submit" className="btn btn-primary">
                          Tìm kiếm
                        </button>
                      </div>
                    </form>
                  </div>
                </li>
                <li className="login-link">
                  <a href="login">Đăng nhập / Đăng kí</a>
                </li>
                <li className="login-in-fourteen">
                  <a href="login" className="btn reg-btn">
                    <i className="feather-user me-2"></i>Đăng nhập
                  </a>
                </li>
                <li className="login-in-fourteen">
                  <a
                    href="register"
                    className="btn btn-primary reg-btn reg-btn-fourteen"
                  >
                    <i className="feather-user me-2"></i>Đăng kí
                  </a>
                </li>
              </>
            )}
          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;
