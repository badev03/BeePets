import { useEffect, useState } from 'react'
import settingApi from '../api/settingApi';
import TopLink from '../Link/TopLink';
import LoadingSkeleton from './Loading';

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
    return <LoadingSkeleton/>;
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
                    <TopLink to="/"><img src={setting.image_footer} alt="logo" /></TopLink>
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
                        <li><TopLink to="/">Trang Chủ</TopLink></li>
                        <li><TopLink to="/doctor">Bác Sĩ</TopLink></li>
                        <li><TopLink to="/abouts">Giới Thiệu</TopLink></li>
                        <li><TopLink to="/blog">Tin Tức</TopLink></li>
                      </ul>
                    </div>
                  </div>
                  <div className="col-lg-3 col-md-4">
                    <div className="footer-widget footer-menu">
                      <h2 className="footer-title">DỊCH VỤ</h2>
                      <ul>
                        <li><TopLink to="#">Khám Bệnh</TopLink></li>
                        <li><TopLink to="#">Chữa Bệnh</TopLink></li>
                        <li><TopLink to="#">Spa Thú Cưng</TopLink></li>
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
                          <p><i className="feather-mail"></i> <TopLink to="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection" className="__cf_email__" data-cfemail="ee8a818d8d9b9c8bae8b968f839e828bc08d8183">{setting.email}</TopLink></p>
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