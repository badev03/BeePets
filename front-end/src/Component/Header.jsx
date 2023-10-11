import { useEffect, useState } from "react";
import { useAuth } from "../Context/ContextAuth";
import { useNavigate } from "react-router-dom";

const Header = () => {
  const { isLoggedIn, onLogout  } = useAuth();
  const navigate = useNavigate(); 
  
  const handleLogout = () => {
    onLogout();
    navigate('/');
  };


  const initialActiveItems = JSON.parse(
    localStorage.getItem("activeItems")
  ) || ["TRANG CHỦ"];
  const [activeItems, setActiveItems] = useState(initialActiveItems);
  const [scrollPosition, setScrollPosition] = useState(0);

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

  const handleLogoClick = () => {
    handleItemClick("TRANG CHỦ");
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
    <header
      className="header header-fixed header-fourteen header-twelve"
      style={{ backgroundColor: scrollPosition > 40 ? "#fff" : "transparent" }}
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
            <a
              href={"/"}
              className="navbar-brand logo"
              onClick={handleLogoClick}
            >
              <img
                src="../src/assets/img/logo.jpg"
                className="img-fluid"
                alt="Logo"
              />
            </a>
          </div>
          <div className="main-menu-wrapper">
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
                  activeItems.includes("TRANG CHỦ") ? "active" : ""
                }`}
                onClick={() => handleItemClick("TRANG CHỦ")}
              >
                <a href="/">TRANG CHỦ </a>
              </li>
              <li
                className={`has-submenu ${
                  activeItems.includes("BÁC SĨ") ? "active" : ""
                }`}
                onClick={() => handleItemClick("BÁC SĨ")}
              >
                <a href="/doctor">BÁC SĨ </a>
              </li>
              <li
                className={`has-submenu ${
                  activeItems.includes("GIỚI THIỆU") ? "active" : ""
                }`}
                onClick={() => handleItemClick("GIỚI THIỆU")}
              >
                <a href="/abouts">GIỚI THIỆU </a>
              </li>
              <li
                className={`has-submenu ${
                  activeItems.includes("TIN TỨC") ? "active" : ""
                }`}
                onClick={() => handleItemClick("TIN TỨC")}
              >
                <a href="/blog">TIN TỨC </a>
              </li>
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
                      <span className="badge">5</span>
                    </a>
                    <div className="dropdown-menu notifications dropdown-menu-end ">
                      <div className="topnav-dropdown-header">
                        <span className="notification-title">Notifications</span>
                      </div>
                      <div className="noti-content">
                        <ul className="notification-list">
                          <li className="notification-message">
                            <a href="#">
                              <div className="notify-block d-flex">
                                <span className="avatar">
                                  <img
                                    className="avatar-img"
                                    alt="Ruby perin"
                                    src="../src/assets/img/clients/client-01.jpg"
                                  />
                                </span>
                                <div className="media-body">
                                  <h6>
                                    Travis Tremble{" "}
                                    <span className="notification-time">
                                      18.30 PM
                                    </span>
                                  </h6>
                                  <p className="noti-details">
                                    Sent a amount of $210 for his Appointment{" "}
                                    <span className="noti-title">Dr.Ruby perin </span>
                                  </p>
                                </div>
                              </div>
                            </a>
                          </li>
                          <li className="notification-message">
                            <a href="#">
                              <div className="notify-block d-flex">
                                <span className="avatar">
                                  <img
                                    className="avatar-img"
                                    alt="Hendry Watt"
                                    src="../src/assets/img/clients/client-02.jpg"
                                  />
                                </span>
                                <div className="media-body">
                                  <h6>
                                    Travis Tremble{" "}
                                    <span className="notification-time">
                                      12 Min Ago
                                    </span>
                                  </h6>
                                  <p className="noti-details">
                                    {" "}
                                    has booked her appointment to{" "}
                                    <span className="noti-title">
                                      Dr. Hendry Watt
                                    </span>
                                  </p>
                                </div>
                              </div>
                            </a>
                          </li>
                          <li className="notification-message">
                            <a href="#">
                              <div className="notify-block d-flex">
                                <div className="avatar">
                                  <img
                                    className="avatar-img"
                                    alt="Maria Dyen"
                                    src="../src/assets/img/clients/client-03.jpg"
                                  />
                                </div>
                                <div className="media-body">
                                  <h6>
                                    Travis Tremble{" "}
                                    <span className="notification-time">
                                      6 Min Ago
                                    </span>
                                  </h6>
                                  <p className="noti-details">
                                    {" "}
                                    Sent a amount $210 for his Appointment{" "}
                                    <span className="noti-title">Dr.Maria Dyen</span>
                                  </p>
                                </div>
                              </div>
                            </a>
                          </li>
                          <li className="notification-message">
                            <a href="#">
                              <div className="notify-block d-flex">
                                <div className="avatar avatar-sm">
                                  <img
                                    className="avatar-img"
                                    alt="client-image"
                                    src="../src/assets/img/clients/client-04.jpg"
                                  />
                                </div>
                                <div className="media-body">
                                  <h6>
                                    Travis Tremble{" "}
                                    <span className="notification-time">8.30 AM</span>
                                  </h6>
                                  <p className="noti-details">
                                    {" "}
                                    Send a message to his doctor
                                  </p>
                                </div>
                              </div>
                            </a>
                          </li>
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
                          src="../src/assets/img/doctors/doctor-thumb-02.jpg"
                          width={31}
                          alt="Darren Elder"
                        />
                      </span>
                    </a>
                    <div className="dropdown-menu dropdown-menu-end">
                      <div className="user-header">
                        <div className="avatar avatar-sm">
                          <img
                            src="../src/assets/img/doctors/doctor-thumb-02.jpg"
                            alt="User Image"
                            className="avatar-img rounded-circle"
                          />
                        </div>
                        <div className="user-text">
                          <h6>Darren Elder</h6>
                          <p className="text-muted mb-0">Doctor</p>
                        </div>
                      </div>
                      <a className="dropdown-item" href="doctor-dashboard.html">
                        Dashboard
                      </a>
                      <a
                        className="dropdown-item"
                        href="doctor-profile-settings.html"
                      >
                        Profile Settings
                      </a>
                      <a className="dropdown-item" href="login.html">
                        Logout
                      </a>
                    </div>
                  </li>
                  <a className="dropdown-item" onClick={handleLogout}>
                        Logout
                      </a>
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
