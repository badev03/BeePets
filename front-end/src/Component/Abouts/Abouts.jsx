import React from "react";

const Abouts = () => {
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
                      <a href="index.html">Trang Chủ</a>
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
                            src="../src/assets/img/about-img1.jpg"
                            className="img-fluid"
                            alt="about-image"
                          />
                        </div>
                        <div className="about-img">
                          <img
                            src="../src/assets/img/about-img2.jpg"
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
                            src="../src/assets/img/about-img3.jpg"
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
                    Chúng tôi luôn đảm bảo điều trị y tế tốt nhất cho sức khỏe
                    thú cưng của bạn
                  </h2>
                </div>
                <div className="about-content">
                  <div className="about-content-details">
                    <p>
                      Dịch vụ y tế thú cưng của chúng tôi cam kết mang đến cho
                      bạn và thú cưng của bạn trải nghiệm chăm sóc y tế tốt
                      nhất. Với đội ngũ bác sĩ thú y chuyên nghiệp và có kinh
                      nghiệm, chúng tôi cam kết đưa ra những chẩn đoán chính xác
                      và phương pháp điều trị hiệu quả cho các vấn đề sức khỏe
                      của thú cưng.
                    </p>
                    <p>
                      Chúng tôi hiểu rằng thú cưng là thành viên quan trọng
                      trong gia đình của bạn, và vì vậy, chúng tôi luôn tận tâm
                      và chu đáo trong mọi phiên làm việc với thú cưng. Từ khám
                      sức khỏe định kỳ đến điều trị các bệnh lý cụ thể, chúng
                      tôi cam kết mang lại sự an tâm và thoải mái cho bạn và thú
                      cưng của mình.
                    </p>
                    <p>
                      Hãy đồng hành cùng chúng tôi để đảm bảo rằng thú cưng của
                      bạn sẽ luôn được đối xử với sự chăm sóc cao cấp và có một
                      cuộc sống khỏe mạnh và hạnh phúc.
                    </p>
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
        <section className="why-choose-section">
          <div className="container">
            <div className="row">
              <div className="col-md-12">
                <div className="section-inner-header text-center">
                  <h2>Tại sao lại chọn chúng tôi ?</h2>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="card why-choose-card w-100">
                  <div className="card-body">
                    <div className="why-choose-icon">
                      <span>
                        <img
                          src="../src/assets/img/icons/choose-01.svg"
                          alt="choose-image"
                        />
                      </span>
                    </div>
                    <div className="why-choose-content">
                      <h4>Dịch vụ Y Tế Vượt Trội</h4>
                      <p>
                        Với đội ngũ bác sĩ thú y chuyên nghiệp, trang thiết bị
                        hiện đại chúng tôi tự hào là đối tác đáng tin cậy cho
                        sức khỏe của thú cưng bạn.{" "}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="card why-choose-card w-100">
                  <div className="card-body">
                    <div className="why-choose-icon">
                      <span>
                        <img
                          src="../src/assets/img/icons/choose-02.svg"
                          alt="choose-image"
                        />
                      </span>
                    </div>
                    <div className="why-choose-content">
                      <h4>Dịch vụ Y tế 24/7</h4>
                      <p>
                        Với cam kết phục vụ 24/7, chúng tôi là đối tác đáng tin
                        cậy của bạn trong việc giữ cho thú cưng luôn khỏe mạnh
                        và hạnh phúc, bất kể lúc nào, mọi nơi.{" "}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="card why-choose-card w-100">
                  <div className="card-body">
                    <div className="why-choose-icon">
                      <span>
                        <img
                          src="../src/assets/img/icons/choose-03.svg"
                          alt="choose-image"
                        />
                      </span>
                    </div>
                    <div className="why-choose-content">
                      <h4>Dịch Vụ Y Tế Hiện Đại</h4>
                      <p>
                        Với trang thiết bị y tế tiên tiến và phương pháp điều
                        trị hiện đại, chúng tôi không chỉ điều trị bệnh lý mà
                        còn đảm bảo sự thoải mái và an tâm tuyệt đối cho thú
                        cưng của bạn.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 d-flex">
                <div className="card why-choose-card w-100">
                  <div className="card-body">
                    <div className="why-choose-icon">
                      <span>
                        <img
                          src="../src/assets/img/icons/choose-04.svg"
                          alt="choose-image"
                        />
                      </span>
                    </div>
                    <div className="why-choose-content">
                      <h4>Chăm Sóc Thú Cưng Tận Tâm</h4>
                      <p>
                        Với tâm huyết và sự chuyên nghiệp, chúng tôi không chỉ
                        là đội ngũ bác sĩ thú y, mà còn là những người yêu thú
                        cưng.{" "}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
        {/* <section className="testimonial-section">
          <div className="testimonial-shape-img">
            <div className="testimonial-shape-left">
              <img src="../src/assets/img/shape-04.png" alt="shape-image" />
            </div>
            <div className="testimonial-shape-right">
              <img src="../src/assets/img/shape-05.png" alt="shape-image" />
            </div>
          </div>
          <div className="container">
            <div className="row">
              <div className="col-md-12">
                <div className="testimonial-slider slick">
                <div className="section-inner-header text-center">
                  <h2>Đánh giá của khách hàng</h2>
                </div>
                  <div className="testimonial-grid">
                    <div className="testimonial-info">
                      <div className="testimonial-img">
                        <img
                          src="../src/assets/img/clients/client-01.jpg"
                          className="img-fluid"
                          alt="client-image"
                        />
                      </div>
                      <div className="testimonial-content">
                        <div className="testimonial-details">
                          <p>
                          Dịch vụ chăm sóc thú cưng ở đây thực sự làm tôi yên tâm. Đội ngũ chuyên nghiệp, thân thiện và luôn sẵn lòng giải đáp mọi thắc mắc của tôi. Việc phục vụ 24/7 càng làm cho tôi cảm thấy an tâm hơn, đặc biệt là trong những trường hợp khẩn cấp. Cảm ơn đội ngũ vì tận tâm của mình!
                          </p>
                          <h6>
                            <span>Quang Thiều</span> 
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="testimonial-grid">
                    <div className="testimonial-info">
                      <div className="testimonial-img">
                        <img
                          src="../src/assets/img/clients/client-02.jpg"
                          className="img-fluid"
                          alt="client-image"
                        />
                      </div>
                      <div className="testimonial-content">
                        <div className="testimonial-details">
                          <p>
                          Mọi lần đưa thú cưng đến đây, tôi đều cảm thấy chúng được chăm sóc như là gia đình. Bác sĩ và nhân viên luôn thân thiện và nhiệt huyết. Họ không chỉ quan tâm đến vấn đề y tế mà còn đặt tâm huyết vào việc tạo ra một môi trường thoải mái cho thú cưng và chủ nhân.
                          </p>
                          <h6>
                            <span>Anh Bá</span> 
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="testimonial-grid">
                    <div className="testimonial-info">
                      <div className="testimonial-img">
                        <img
                          src="../src/assets/img/clients/client-03.jpg"
                          className="img-fluid"
                          alt="client-image"
                        />
                      </div>
                      <div className="testimonial-content">
                        <div className="testimonial-details">
                          <p>
                          Rất ấn tượng với tốc độ phản hồi và sự hiệu quả của dịch vụ. Đã có một vài trường hợp cần giải quyết gấp và đội ngũ đã giúp đỡ rất nhanh chóng. Cảm ơn vì sự chuyên nghiệp và nhiệt đồng của bạn!
                          </p>
                          <h6>
                            <span>Thiều</span> 
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="testimonial-grid">
                    <div className="testimonial-info">
                      <div className="testimonial-img">
                        <img
                          src="../src/assets/img/clients/client-04.jpg"
                          className="img-fluid"
                          alt="client-image"
                        />
                      </div>
                      <div className="testimonial-content">
                        <div className="testimonial-details">
                          <p>
                          Nơi này thực sự là chỗ tốt nhất cho thú cưng của bạn. Dịch vụ chất lượng và chi phí hợp lý. Tôi đã tìm thấy nơi mà tôi có thể tin tưởng và thú cưng của tôi được chăm sóc tận tình. Ở đây, chất lượng không bao giờ giảm sút!
                          </p>
                          <h6>
                            <span>Thiều</span> 
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="testimonial-grid">
                    <div className="testimonial-info">
                      <div className="testimonial-img">
                        <img
                          src="../src/assets/img/clients/client-05.jpg"
                          className="img-fluid"
                          alt="client-image"
                        />
                      </div>
                      <div className="testimonial-content">
                        <div className="testimonial-details">
                          <p>
                          Thích hợp cho mọi tình huống, từ kiểm tra định kỳ đến những trường hợp khẩn cấp. Đội ngũ ở đây không chỉ chăm sóc y tế mà còn cung cấp các giải pháp sáng tạo khi thú cưng gặp vấn đề. Sự linh hoạt và chuyên nghiệp làm cho đây là nơi tốt nhất cho thú cưng của bạn
                          </p>
                          <h6>
                            <span>Thiều</span> 
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> */}
        {/* <section className="faq-section faq-section-inner">
          <div className="container">
            <div className="row">
              <div className="col-md-12">
                <div className="section-inner-header text-center">
                  <h2>Các câu hỏi thường gặp</h2>
                </div>
              </div>
            </div>
            <div className="row align-items-center">
              <div className="col-lg-6 col-md-12">
                <div className="faq-img">
                  <img
                    src="../src/assets/img/faq-img.png"
                    className="img-fluid"
                    alt="img"
                  />
                  <div className="faq-patients-count">
                    <div className="faq-smile-img">
                      <img src="../src/assets/img/icons/smiling-icon.svg" alt="icon" />
                    </div>
                    <div className="faq-patients-content">
                      <h4>
                        <span className="count-digit">95</span>k+
                      </h4>
                      <p>Hạnh Phúc</p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6 col-md-12">
                <div className="faq-info">
                  <div className="accordion" id="accordionExample">
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingOne">
                        <a
                          href="javascript:void(0)"
                          className="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseOne"
                          aria-expanded="true"
                          aria-controls="collapseOne"
                        >
                          Can i make an Appointment Online with White Plains
                          Hospital Kendi?
                        </a>
                      </h2>
                      <div
                        id="collapseOne"
                        className="accordion-collapse collapse show"
                        aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample"
                      >
                        <div className="accordion-body">
                          <div className="accordion-content">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing
                              elit, sed do eiusmod tempor incididunt ut labore
                              et dolore magna aliqua. Ut enim ad minim veniam,{" "}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingTwo">
                        <a
                          href="javascript:void(0)"
                          className="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseTwo"
                          aria-expanded="false"
                          aria-controls="collapseTwo"
                        >
                          Can i make an Appointment Online with White Plains
                          Hospital Kendi?
                        </a>
                      </h2>
                      <div
                        id="collapseTwo"
                        className="accordion-collapse collapse"
                        aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample"
                      >
                        <div className="accordion-body">
                          <div className="accordion-content">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing
                              elit, sed do eiusmod tempor incididunt ut labore
                              et dolore magna aliqua. Ut enim ad minim veniam,{" "}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingThree">
                        <a
                          href="javascript:void(0)"
                          className="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseThree"
                          aria-expanded="false"
                          aria-controls="collapseThree"
                        >
                          Can i make an Appointment Online with White Plains
                          Hospital Kendi?
                        </a>
                      </h2>
                      <div
                        id="collapseThree"
                        className="accordion-collapse collapse"
                        aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample"
                      >
                        <div className="accordion-body">
                          <div className="accordion-content">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing
                              elit, sed do eiusmod tempor incididunt ut labore
                              et dolore magna aliqua. Ut enim ad minim veniam,{" "}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingFour">
                        <a
                          href="javascript:void(0)"
                          className="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseFour"
                          aria-expanded="false"
                          aria-controls="collapseFour"
                        >
                          Can i make an Appointment Online with White Plains
                          Hospital Kendi?
                        </a>
                      </h2>
                      <div
                        id="collapseFour"
                        className="accordion-collapse collapse"
                        aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample"
                      >
                        <div className="accordion-body">
                          <div className="accordion-content">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing
                              elit, sed do eiusmod tempor incididunt ut labore
                              et dolore magna aliqua. Ut enim ad minim veniam,{" "}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingFive">
                        <a
                          href="javascript:void(0)"
                          className="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseFive"
                          aria-expanded="false"
                          aria-controls="collapseFive"
                        >
                          Can i make an Appointment Online with White Plains
                          Hospital Kendi?
                        </a>
                      </h2>
                      <div
                        id="collapseFive"
                        className="accordion-collapse collapse"
                        aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample"
                      >
                        <div className="accordion-body">
                          <div className="accordion-content">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing
                              elit, sed do eiusmod tempor incididunt ut labore
                              et dolore magna aliqua. Ut enim ad minim veniam,{" "}
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> */}
      </div>
    </>
  );
};

export default Abouts;
