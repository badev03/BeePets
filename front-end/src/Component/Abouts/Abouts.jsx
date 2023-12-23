import React, { useEffect, useState } from "react";
import aboutsApi from "../../api/aboutApi";
import Servicer from "../Servicer/service";
import DoctorAbout from "../Homepage/DoctorAbout";
import { Link } from "react-router-dom";
import LoadingSkeleton from "../Loading";

const Abouts = () => {
  const [abouts, setAbouts] = useState("");
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
    return <div><LoadingSkeleton/></div>;
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
                      {/* <a href="/">Trang Chủ</a> */}
                      <Link to={"/"}>Trang chủ</Link>
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
                          src="/assets/img/icons/phone-icon.svg"
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
            <img src="/assets/img/bg/big-paw.png" alt="paw-image" />
            <img src="/assets/img/bg/small-paw.png" alt="paw-image" />
          </div>
          <Servicer />
        </section>
       <DoctorAbout />
        
      </div>
    </>
  );
};

export default Abouts;
