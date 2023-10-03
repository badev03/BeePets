import React, { useEffect, useState } from "react";

const Header = () => {
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
          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;
