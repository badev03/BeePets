import React from "react";
import { Link } from "react-router-dom";
const Header = () => {
  return (
    <header className="header header-fixed header-fourteen header-twelve">
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
            <Link to={"/"} className="navbar-brand logo">
              <img
                src="../src/assets/img/logo.jpg"
                className="img-fluid"
                alt="Logo"
              />
            </Link>
          </div>
          <div className="main-menu-wrapper">
            <div className="menu-header">
              <a href="index.html" className="menu-logo">
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
              <li className="has-submenu megamenu active">
                <Link to={"/"}>TRANG CHỦ </Link>
              </li>
              <li className="has-submenu">
                <a href="#">BÁC SĨ </a>
              </li>
              <li className="has-submenu">
                <a href="#">
                  GIỚI THIỆU <i className="fas fa-chevron-down"></i>
                </a>
              </li>
              <li className="has-submenu">
                <Link to={"blog"}>TIN TỨC </Link>
              </li>
            </ul>
          </div>
          <ul className="nav header-navbar-rht">
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
              <a href="login-email.html">Đăng nhập / Đăng kí</a>
            </li>
            <li className="login-in-fourteen">
              <a href="login-email.html" className="btn reg-btn">
                <i className="feather-user me-2"></i>Đăng nhập
              </a>
            </li>
            <li className="login-in-fourteen">
              <a
                href="signup.html"
                className="btn btn-primary reg-btn reg-btn-fourteen"
              >
                <i className="feather-user me-2"></i>Đăng kí
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;
