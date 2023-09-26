import React from 'react'
import Banner from "./Banner";

const Content = () => {
  return (
    <div>
      <Banner />
      <h1>hehe</h1>
  <section className="services-section-fourteen">
    <div className="floating-bg">
      <img src="../src/assets/img/bg/big-paw.png" alt="paw-image" />
      <img src="../src/assets/img/bg/small-paw.png" alt="paw-image" />
    </div>
    <div className="container">
      <div className="row">
        <div className="col-lg-12 aos" data-aos="fade-up">
          <div className="section-header-fourteen service-inner-fourteen">
            <div className="service-inner-fourteen">
              <div className="service-inner-fourteen-two">
                <h3>DỊCH VỤ CỦA CHÚNG TÔI</h3>
              </div>
            </div>
            <h2>Chúng tôi có thể</h2>
            <p>Dịch vụ chuyên nghiệp của chúng tôi</p>
          </div>
        </div>
      </div>
      <div className="row row-gap justify-content-center">
        <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
          <div className="our-services-list w-100">
            <div className="service-icon">
              <img src="../src/assets/img/icons/injection.svg" alt="injection-icon" />
            </div>
            <h4>Tiêm chủng</h4>
            <p>Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng.</p>
          </div>
        </div>
        <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
          <div className="our-services-list w-100">
            <div className="service-icon">
              <img src="../src/assets/img/icons/bottel.svg" alt="bottel-icon" />
            </div>
            <h4>Thuốc thú cưng</h4>
            <p>Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng</p>
          </div>
        </div>
        <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
          <div className="our-services-list w-100">
            <div className="service-icon">
              <img src="../src/assets/img/icons/bath-tub.svg" alt="pet-grooming-icon" />
            </div>
            <h4>Chăm sóc thú cưng</h4>
            <p>Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng</p>
          </div>
        </div>
        <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
          <div className="our-services-list w-100">
            <div className="service-icon">
              <img src="../src/assets/img/icons/pet-doctor.svg" alt="stethoscope-icon" />
            </div>
            <h4>Khám phá</h4>
            <p>Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div className="blog-section-fourteen our-doctor-twelve">
    <div className="floating-bg">
      <img src="../src/assets/img/bg/small-paw.png" alt="paw-image" />
      <img src="../src/assets/img/bg/big-paw.png" alt="paw-image" />
    </div>
    <div className="container">
      <div className="row">
        <div className="col-lg-12">
          <div className="section-header-fourteen service-inner-fourteen">
            <div className="service-inner-fourteen">
              <div className="service-inner-fourteen-two">
                <h3>OUR TEAM</h3>
              </div>
            </div>
            <h2>Meet Our Doctors</h2>
            <p>Our Qualified Professionals</p>
          </div>
        </div>
      </div>
      {/* <div className="owl-carousel blog-slider-twelve owl-theme aos" data-aos="fade-up"> */}
      <div className="owl-carousel blog-slider-twelve owl-theme aos" > 
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/doctors/veterinary-doctor-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content content-pricing">
                    <span>$ 200</span>4
                  </div>
                  <div className="blog-inner-top-content">
                    <span>Veterinarian</span>
                  </div>
                </div>
              </a>
              <h4 className="blog-inner-right-fourt-care">
                <a href="doctor-profile.html">Dr. Marie Wells</a>
              </h4>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="fa fa-location-dot" /> <strong>0.9</strong> min - New York, USA
                </li>
              </ul>
              <div className="blog-list-ratings">
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star" />
                <span>(20)</span>
              </div>
              <a href="booking.html" className="btn btn-primary">Consult</a>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/doctors/veterinary-doctor-02.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content content-pricing">
                    <span>$ 150</span>
                  </div>
                  <div className="blog-inner-top-content">
                    <span>Pet Care Specialist</span>
                  </div>
                </div>
              </a>
              <h4 className="blog-inner-right-fourt-care">
                <a href="doctor-profile.html">Dr. Justin Parker</a>
              </h4>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="fa fa-location-dot" /> <strong>2</strong> hrs - Chicago, USA
                </li>
              </ul>
              <div className="blog-list-ratings">
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star" />
                <span>(22)</span>
              </div>
              <a href="booking.html" className="btn btn-primary">Consult</a>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/doctors/veterinary-doctor-03.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content content-pricing">
                    <span>$ 110</span>
                  </div>
                  <div className="blog-inner-top-content">
                    <span>Veterinarian</span>
                  </div>
                </div>
              </a>
              <h4 className="blog-inner-right-fourt-care">
                <a href="doctor-profile.html">Dr. Pamela Curtis</a>
              </h4>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="fa fa-location-dot" /> <strong>0.8</strong> min - Sandiago, USA
                </li>
              </ul>
              <div className="blog-list-ratings">
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star" />
                <span>(30)</span>
              </div>
              <a href="booking.html" className="btn btn-primary">Consult</a>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/doctors/veterinary-doctor-04.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content content-pricing">
                    <span>$ 50</span>
                  </div>
                  <div className="blog-inner-top-content">
                    <span>Veterinarian</span>
                  </div>
                </div>
              </a>
              <h4 className="blog-inner-right-fourt-care">
                <a href="doctor-profile.html">Dr.Ronald Jacobs</a>
              </h4>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="fa fa-location-dot" /> <strong>10</strong> min - Texas, USA
                </li>
              </ul>
              <div className="blog-list-ratings">
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star" />
                <span>(45)</span>
              </div>
              <a href="booking.html" className="btn btn-primary">Consult</a>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/doctors/veterinary-doctor-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content content-pricing">
                    <span>$ 200</span>
                  </div>
                  <div className="blog-inner-top-content">
                    <span>Veterinarian</span>
                  </div>
                </div>
              </a>
              <h4 className="blog-inner-right-fourt-care">
                <a href="doctor-profile.html">Dr. Marie Wells</a>
              </h4>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="fa fa-location-dot" /> <strong>0.9</strong> min - New York, USA
                </li>
              </ul>
              <div className="blog-list-ratings">
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star rated" />
                <i className="fa-solid fa-star" />
                <span>(20)</span>
              </div>
              <a href="booking.html" className="btn btn-primary">Consult</a>
            </div>
          </div>
        </div>
      </div>
      <div className="owl-nav slide-nav-16 text-end nav-control" />
      {/* <div className="blog-btn-sec text-center aos aos-init aos-animate" data-aos="fade-up"> */}
      <div className="blog-btn-sec text-center aos aos-init aos-animate" >
        <a href="search.html" className="btn btn-primary btn-view">See All Doctors</a>
      </div>
    </div>
  </div>
  
  <div className="blog-section-fourteen">
    <div className="container">
      <div className="row">
        <div className="col-lg-12">
          <div className="section-header-fourteen service-inner-fourteen">
            <div className="service-inner-fourteen">
              <div className="service-inner-fourteen-two">
                <h3>BLOG</h3>
              </div>
            </div>
            <h2>Our Blogs</h2>
            <p>Our Recent Articles</p>
          </div>
        </div>
      </div>
      <div className="owl-carousel blog-slider-fourteen owl-theme aos" data-aos="fade-up">
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="blog-details.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/blog/veterinary-blog-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="../src/assets/img/doctors/doctor-04.jpg" alt="Pamila Certis" className="me-2" />
                    <span>Dr. Pamila Certis</span>
                  </div>
                </div>
              </a>
              <a href="blog-details.html" className="blog-inner-right-fourt-care">What You Might Not Know About The Best Dog Food in India</a>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="feather-calendar" /> 13 Aug, 2023
                </li>
                <li>
                  <i className="feather-message-square" /> 68
                </li>
                <li>
                  <i className="feather-eye" /> 1.5k
                </li>
              </ul>
              <ul className="articles-list nav blog-articles-list-two">
                <li>Dog</li>
                <li>Health</li>
                <li>Diet Foods</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ad minim veniam, quis magna aliqua. </p>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="blog-details.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/blog/veterinary-blog-02.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="../src/assets/img/doctors/doctor-07.jpg" alt="James Matthew" className="me-2" />
                    <span>Dr. James Matthew</span>
                  </div>
                </div>
              </a>
              <a href="blog-details.html" className="blog-inner-right-fourt-care">How to Care for Rabbits in the Winter</a>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="feather-calendar" /> 13 Apr, 2023
                </li>
                <li>
                  <i className="feather-message-square" /> 87
                </li>
                <li>
                  <i className="feather-eye" /> 2.5k
                </li>
              </ul>
              <ul className="articles-list nav blog-articles-list-two">
                <li>Pet Care</li>
                <li>Rabbit</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ad minim veniam, quis magna aliqua. </p>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="blog-details.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/blog/veterinary-blog-03.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="../src/assets/img/doctors/doctor-06.jpg" alt="James Certis" className="me-2" />
                    <span>Dr. James Certis</span>
                  </div>
                </div>
              </a>
              <a href="blog-details.html" className="blog-inner-right-fourt-care">Why Cat Scratches?</a>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="feather-calendar" /> 26 May, 2023
                </li>
                <li>
                  <i className="feather-message-square" /> 78
                </li>
                <li>
                  <i className="feather-eye" /> 1.6k
                </li>
              </ul>
              <ul className="articles-list nav blog-articles-list-two">
                <li>Cat</li>
                <li>Cat Scratcher</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ad minim veniam, quis magna aliqua. </p>
            </div>
          </div>
        </div>
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="blog-details.html">
                <div className="blog-inner-right-img">
                  <img src="../src/assets/img/blog/veterinary-blog-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="../src/assets/img/doctors/doctor-04.jpg" alt="Pamila Certis" className="me-2" />
                    <span>Dr. Pamila Certis</span>
                  </div>
                </div>
              </a>
              <a href="blog-details.html" className="blog-inner-right-fourt-care">What You Might Not Know About The Best Dog Food in India</a>
              <ul className="articles-list nav blog-articles-list">
                <li>
                  <i className="feather-calendar" /> 13 Aug, 2023
                </li>
                <li>
                  <i className="feather-message-square" /> 68
                </li>
                <li>
                  <i className="feather-eye" /> 1.5k
                </li>
              </ul>
              <ul className="articles-list nav blog-articles-list-two">
                <li>Dog</li>
                <li>Health</li>
                <li>Diet Foods</li>
              </ul>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore ad minim veniam, quis magna aliqua. </p>
            </div>
          </div>
        </div>
      </div>
      <div className="owl-nav slide-nav-15 text-end nav-control" />
      <div className="blog-btn-sec text-center aos aos-init aos-animate" data-aos="fade-up">
        <a href="search.html" className="btn btn-primary btn-view">Read More Articles</a>
      </div>
    </div>
  </div>
</div>

  )
}

export default Content