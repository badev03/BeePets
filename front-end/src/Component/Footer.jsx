import React, { useEffect, useState } from 'react'
import settingApi from '../api/settingApi';

const Footer = () => {
  const [setting, setSetting] = useState([]);

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
  return (
    <>
      <footer className="footer footer-one footer-fourteen footer-twelve">
        <div className="footer-top">
          <div className="container">
            <div className="row">
              <div className="col-lg-4 col-md-4">
                <div className="footer-widget footer-about">
                  <div className="footer-logo">
                    <a href="index-10.html"><img src={setting.image_footer} alt="logo" /></a>
                  </div>
                  <div className="footer-about-content">
                    <p>{setting.description}</p>
                  </div>
                </div>
              </div>
              <div className="col-lg-8">
                <div className="row">
                  <div className="col-lg-3 col-md-4">
                    <div className="footer-widget footer-menu">
                      <h2 className="footer-title">BEE PETS</h2>
                      <ul>
                        <li><a href="/">Trang Chủ</a></li>
                        <li><a href="/doctor">Bác Sĩ</a></li>
                        <li><a href="/abouts">Giới Thiệu</a></li>
                        <li><a href="/blog">Tin Tức</a></li>
                      </ul>
                    </div>
                  </div>
                  <div className="col-lg-3 col-md-4">
                    <div className="footer-widget footer-menu">
                      <h2 className="footer-title">DỊCH VỤ</h2>
                      <ul>
                        <li><a href="#">Khám Bệnh</a></li>
                        <li><a href="#">Chữa Bệnh</a></li>
                        <li><a href="#">Spa Thú Cưng</a></li>
                      </ul>
                    </div>
                  </div>
                  <div className="col-lg-6 col-md-4">
                    <div className="footer-widget footer-contact">
                      <h2 className="footer-title">Liên Hệ</h2>
                      <div className="footer-contact-info">
                        <div className="footer-address">
                          <p><i className="feather-map-pin"></i> {setting.address}</p>
                        </div>
                        <div className="footer-address">
                          <p><i className="feather-phone-call"></i>{setting.phone}</p>
                        </div>
                        <div className="footer-address mb-0">
                          <p><i className="feather-mail"></i> <a href="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection" className="__cf_email__" data-cfemail="ee8a818d8d9b9c8bae8b968f839e828bc08d8183">{setting.email}</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </footer>

      <div className="mouse-cursor cursor-outer"></div>
      <div className="mouse-cursor cursor-inner"></div>

    </>
  )
}

export default Footer