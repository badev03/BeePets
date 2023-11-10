import React, { useEffect, useState } from "react";
import aboutsApi from "../../api/aboutApi";
import Services from "../Servicer/services";
import Servicer from "../Servicer/service";

const Abouts = () => {
  const [abouts, setAbouts] = useState([]);
  useEffect(() => {
    const fetchAbout = async () => {
      try {
        const response = await aboutsApi.getAll();
        setAbouts(response.data);
        console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchAbout();
  }, []);
  if (!abouts) {
    return <div>Loading...</div>;
  }
  return (
    <>
      <div>
        <div className="breadcrumb-bar-two">
          <div className="container">
            <div className="row align-items-center inner-banner">
              <div className="col-md-12 col-12 text-center">
                <h2 className="breadcrumb-title">GIỚI THIỆU</h2>
                <nav aria-label="breadcrumb" className="page-breadcrumb">
                  <ol className="breadcrumb">
                    <li className="breadcrumb-item">
                      <a href="/">Trang Chủ</a>
                    </li>
                    <li className="breadcrumb-item" aria-current="page">
                      Giới Thiệu
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <section className="about-section">
          <div className="container">
            <div className="row align-items-center">
              <div className="col-lg-6 col-md-12">
                <div className="about-img-info">
                  <div className="row">
                    <div className="col-md-6">
                      <div className="about-inner-img">
                        <div className="about-img">
                          <img
                            src={abouts.image}
                            className="img-fluid"
                            alt="about-image"
                          />
                        </div>
                        <div className="about-img">
                          <img
                            src={abouts.image}
                            className="img-fluid"
                            alt="about-image"
                          />
                        </div>
                      </div>
                    </div>
                    <div className="col-md-6">
                      <div className="about-inner-img">
                        <div className="about-box">
                          <h4>Với trình độ hơn 10 năm kinh nghiệm</h4>
                        </div>
                        <div className="about-img">
                          <img
                            src={abouts.image}
                            className="img-fluid"
                            alt="about-image"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6 col-md-12">
                <div className="section-inner-header about-inner-header">
                  <h6>Thông tin về phòng khám</h6>
                  <h2>
                    {abouts.title}
                  </h2>
                </div>
                <div className="about-content">
                  <div className="about-content-details">
                    <div dangerouslySetInnerHTML={{ __html: abouts.content }} />
                
                  </div>
                  <div className="about-contact">
                    <div className="about-contact-icon">
                      <span>
                        <img
                          src="../src/assets/img/icons/phone-icon.svg"
                          alt="phone-image"
                        />
                      </span>
                    </div>
                    <div className="about-contact-text">
                      <p>Gọi tư vấn ngay?</p>
                      <h4>0376732833</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section className="services-section-fourteen">
          <div className="floating-bg">
            <img src="../src/assets/img/bg/big-paw.png" alt="paw-image" />
            <img src="../src/assets/img/bg/small-paw.png" alt="paw-image" />
          </div>
          <Servicer />
        </section>
        <section className="doctors-section professional-section">
          <div className="container">
            <div className="row">
              <div className="col-md-12">
                <div className="section-inner-header text-center">
                  <h2>Bác sĩ hàng đầu</h2>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="doctor-profile-widget w-100">
                  <div className="doc-pro-img">
                    <a href="doctor-profile.html">
                      <div className="doctor-profile-img">
                        <img
                          src="../src/assets/img/doctors/doctor-03.jpg"
                          className="img-fluid"
                          alt="Ruby Perrin"
                        />
                      </div>
                    </a>
                    <div className="doctor-amount">
                      <span>$ 200</span>
                    </div>
                  </div>
                  <div className="doc-content">
                    <div className="doc-pro-info">
                      <div className="doc-pro-name">
                        <a href="doctor-profile.html">Dr. Ruby Perrin</a>
                        <p>Cardiology</p>
                      </div>
                      <div className="reviews-ratings">
                        <p>
                          <span>
                            <i className="fas fa-star" /> 4.5
                          </span>{" "}
                          (35)
                        </p>
                      </div>
                    </div>
                    <div className="doc-pro-location">
                      <p>
                        <i className="feather-map-pin" /> Newyork, USA
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="doctor-profile-widget w-100">
                  <div className="doc-pro-img">
                    <a href="doctor-profile.html">
                      <div className="doctor-profile-img">
                        <img
                          src="../src/assets/img/doctors/doctor-04.jpg"
                          className="img-fluid"
                          alt="Darren Elder"
                        />
                      </div>
                    </a>
                    <div className="doctor-amount">
                      <span>$ 360</span>
                    </div>
                  </div>
                  <div className="doc-content">
                    <div className="doc-pro-info">
                      <div className="doc-pro-name">
                        <a href="doctor-profile.html">Dr. Darren Elder</a>
                        <p>Neurology</p>
                      </div>
                      <div className="reviews-ratings">
                        <p>
                          <span>
                            <i className="fas fa-star" /> 4.0
                          </span>{" "}
                          (20)
                        </p>
                      </div>
                    </div>
                    <div className="doc-pro-location">
                      <p>
                        <i className="feather-map-pin" /> Florida, USA
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="doctor-profile-widget w-100">
                  <div className="doc-pro-img">
                    <a href="doctor-profile.html">
                      <div className="doctor-profile-img">
                        <img
                          src="../src/assets/img/doctors/doctor-05.jpg"
                          className="img-fluid"
                          alt="Sofia Brient"
                        />
                      </div>
                    </a>
                    <div className="doctor-amount">
                      <span>$ 450</span>
                    </div>
                  </div>
                  <div className="doc-content">
                    <div className="doc-pro-info">
                      <div className="doc-pro-name">
                        <a href="doctor-profile.html">Dr. Sofia Brient</a>
                        <p>Urology</p>
                      </div>
                      <div className="reviews-ratings">
                        <p>
                          <span>
                            <i className="fas fa-star" /> 4.5
                          </span>{" "}
                          (30)
                        </p>
                      </div>
                    </div>
                    <div className="doc-pro-location">
                      <p>
                        <i className="feather-map-pin" /> Georgia, USA
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="doctor-profile-widget w-100">
                  <div className="doc-pro-img">
                    <a href="doctor-profile.html">
                      <div className="doctor-profile-img">
                        <img
                          src="../src/assets/img/doctors/doctor-02.jpg"
                          className="img-fluid"
                          alt="Paul Richard"
                        />
                      </div>
                    </a>
                    <div className="doctor-amount">
                      <span>$ 570</span>
                    </div>
                  </div>
                  <div className="doc-content">
                    <div className="doc-pro-info">
                      <div className="doc-pro-name">
                        <a href="doctor-profile.html">Dr. Paul Richard</a>
                        <p>Orthopedic</p>
                      </div>
                      <div className="reviews-ratings">
                        <p>
                          <span>
                            <i className="fas fa-star" /> 4.3
                          </span>{" "}
                          (45)
                        </p>
                      </div>
                    </div>
                    <div className="doc-pro-location">
                      <p>
                        <i className="feather-map-pin" /> Michigan, USA
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
      </div>
    </>
  );
};

export default Abouts;
