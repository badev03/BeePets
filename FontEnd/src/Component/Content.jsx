import React from 'react'
import Banner from "./Banner";

const Content = () => {
  return (
    <div>
      <Banner />
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
        <div className="../src/col-lg-3 col-md-4 col-sm-12 d-flex">
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
  {/* <div className="blog-section-fourteen our-doctor-twelve">
    <div className="floating-bg">
      <img src="assets/img/bg/small-paw.png" alt="paw-image" />
      <img src="assets/img/bg/big-paw.png" alt="paw-image" />
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
      <div className="owl-carousel blog-slider-twelve owl-theme aos" data-aos="fade-up">
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="assets/img/doctors/veterinary-doctor-01.jpg" alt="image" className="img-fluid " />
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
        <div className="card blog-inner-fourt-all">
          <div className="card-body blog-inner-fourt-main">
            <div className="blog-inner-right-fourt">
              <a href="doctor-profile.html">
                <div className="blog-inner-right-img">
                  <img src="assets/img/doctors/veterinary-doctor-02.jpg" alt="image" className="img-fluid " />
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
                  <img src="assets/img/doctors/veterinary-doctor-03.jpg" alt="image" className="img-fluid " />
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
                  <img src="assets/img/doctors/veterinary-doctor-04.jpg" alt="image" className="img-fluid " />
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
                  <img src="assets/img/doctors/veterinary-doctor-01.jpg" alt="image" className="img-fluid " />
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
      <div className="blog-btn-sec text-center aos aos-init aos-animate" data-aos="fade-up">
        <a href="search.html" className="btn btn-primary btn-view">See All Doctors</a>
      </div>
    </div>
  </div>
  <section className="clients-section-fourteen">
    <div className="floating-bg">
      <img src="assets/img/bg/two-paw.png" alt="paw-image" />
    </div>
    <div className="container">
      <div className="row">
        <div className="col-lg-5">
          <div className="client-inner-main">
            <img src="assets/img/bg/home-12-testimonial.png" alt="image" className="img-fluid" />
          </div>
        </div>
        <div className="col-lg-7 col-md-12">
          <div className="section-header-fourteen service-inner-fourteen">
            <div className="service-inner-fourteen">
              <div className="service-inner-fourteen-two">
                <h3>CLIENT REVIEWS</h3>
              </div>
            </div>
            <h2>Testimonials</h2>
            <p>What our customers says about us</p>
          </div>
          <div className="owl-carousel feedback-slider-fourteen owl-theme aos" data-aos="fade-up">
            <div className="card feedback-card">
              <div className="card-body feedback-card-body">
                <div className="feedback-inner-main">
                  <div className="feedback-inner-img">
                    <img src="assets/img/clients/client-10.jpg" alt="image" className="img-fluid" />
                    <div className="feedback-user-details">
                      <h4>Jenifer Robinson</h4>
                      <h6>Texas, USA</h6>
                      <div className="rating rating-fourteen">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star" />
                      </div>
                    </div>
                  </div>
                  <p>“Thank you! for giving excellent care of my doggies, the best pet care ever! I recommend”
                  </p>
                </div>
              </div>
            </div>
            <div className="card feedback-card">
              <div className="card-body feedback-card-body">
                <div className="feedback-inner-main">
                  <div className="feedback-inner-img">
                    <img src="assets/img/clients/client-09.jpg" alt="image" className="img-fluid" />
                    <div className="feedback-user-details">
                      <h4>Ronald Jacobs</h4>
                      <h6>Texas, USA</h6>
                      <div className="rating rating-fourteen">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star" />
                      </div>
                    </div>
                  </div>
                  <p>“Thank you! for giving excellent care of my doggies, the best pet care ever! I recommend”
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section className="home-twelve-pricing">
    <div className="container">
      <div className="row">
        <div className="col-lg-12 aos" data-aos="fade-up">
          <div className="section-header-fourteen service-inner-fourteen">
            <div className="service-inner-fourteen">
              <div className="service-inner-fourteen-two">
                <h3>OUR PACKAGES</h3>
              </div>
            </div>
            <h2>Our Pricing Plan</h2>
            <p>Our Special Package</p>
          </div>
        </div>
      </div>
      <div className="row row-gap justify-content-center">
        <div className="col-lg-4 col-md-6 col-sm-12">
          <div className="price-card-twelve">
            <div className="price-bg">
              <img src="assets/img/bg/home-12-pricing-bg-4.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-5.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-3.png" alt="design-image" />
            </div>
            <div className="price-content">
              <div className="card-title">
                <h3>Friendly Pack</h3>
              </div>
              <div className="price">
                <h2><sup>$</sup> 150 / <span>Visit</span></h2>
              </div>
              <div className="pack-details">
                <ul>
                  <li>
                    <i className="feather-check-circle" />Basic Checkup
                  </li>
                  <li>
                    <i className="feather-check-circle" />Grooming
                  </li>
                  <li>
                    <i className="feather-check-circle" />Pet Shower
                  </li>
                  <li>
                    <i className="feather-check-circle" />Vaccination
                  </li>
                </ul>
              </div>
              <div className="price-btn">
                <a href="pricing.html" className="btn">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
        <div className="col-lg-4 col-md-6 col-sm-12">
          <div className="price-card-twelve active">
            <div className="price-bg">
              <img src="assets/img/bg/home-12-pricing-bg-4.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-5.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-3.png" alt="design-image" />
            </div>
            <div className="price-content">
              <div className="card-title">
                <h3>Exclusive Pack</h3>
                <span>Best Offer</span>
              </div>
              <div className="price">
                <h2><sup>$</sup> 175 / <span>Visit</span></h2>
              </div>
              <div className="pack-details">
                <ul>
                  <li>
                    <i className="feather-check-circle" />Basic Checkup
                  </li>
                  <li>
                    <i className="feather-check-circle" />Grooming
                  </li>
                  <li>
                    <i className="feather-check-circle" />Pet Shower
                  </li>
                  <li>
                    <i className="feather-check-circle" />Vaccination
                  </li>
                  <li>
                    <i className="feather-check-circle" />Hair fall Pack
                  </li>
                  <li>
                    <i className="feather-check-circle" />30 day Services
                  </li>
                </ul>
              </div>
              <div className="price-btn">
                <a href="pricing.html" className="btn">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
        <div className="col-lg-4 col-md-6 col-sm-12">
          <div className="price-card-twelve">
            <div className="price-bg">
              <img src="assets/img/bg/home-12-pricing-bg-4.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-5.png" alt="design-image" />
              <img src="assets/img/bg/home-12-pricing-bg-3.png" alt="design-image" />
            </div>
            <div className="price-content">
              <div className="card-title">
                <h3>Family Pack</h3>
              </div>
              <div className="price">
                <h2><sup>$</sup> 200 / <span>Visit</span></h2>
              </div>
              <div className="pack-details">
                <ul>
                  <li>
                    <i className="feather-check-circle" />30 day Services
                  </li>
                  <li>
                    <i className="feather-check-circle" />Grooming
                  </li>
                  <li>
                    <i className="feather-check-circle" />Pet Shower
                  </li>
                  <li>
                    <i className="feather-check-circle" />Vaccination
                  </li>
                </ul>
              </div>
              <div className="price-btn">
                <a href="pricing.html" className="btn">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
                  <img src="assets/img/blog/veterinary-blog-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="assets/img/doctors/doctor-04.jpg" alt="Pamila Certis" className="me-2" />
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
                  <img src="assets/img/blog/veterinary-blog-02.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="assets/img/doctors/doctor-07.jpg" alt="James Matthew" className="me-2" />
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
                  <img src="assets/img/blog/veterinary-blog-03.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="assets/img/doctors/doctor-06.jpg" alt="James Certis" className="me-2" />
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
                  <img src="assets/img/blog/veterinary-blog-01.jpg" alt="image" className="img-fluid " />
                  <div className="blog-inner-top-content">
                    <img src="assets/img/doctors/doctor-04.jpg" alt="Pamila Certis" className="me-2" />
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
  <section className="choose-us-fourteen">
    <div className="container">
      <div className="row">
        <div className="col-md-12">
          <div className="section-header-fourteen text-center">
            <div className="service-inner-fourteen justify-content-center">
              <div className="service-inner-fourteen-two">
                <h3>Why Us</h3>
              </div>
            </div>
            <h2>Why Choose Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-lg-6">
          <div className="choose-us-right-main">
            <img src="assets/img/bg/home-12-why-us.png" alt="image" className="img-fluid" />
          </div>
        </div>
        <div className="col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div className="why-us-content">
            <div className="us-faq aos" data-aos="fade-up" data-aos-delay={200}>
              <div className="accordion" id="accordionExample">
                <div className="accordion-item">
                  <h2 className="accordion-header" id="headingOne">
                    <button className="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="collapseOne" className="accordion-collapse collapse shade show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div className="accordion-body">
                      <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6>
                    </div>
                  </div>
                </div>
                <div className="accordion-item">
                  <h2 className="accordion-header" id="headingTwo">
                    <button className="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="collapseTwo" className="accordion-collapse collapse shade" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div className="accordion-body">
                      <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6>
                    </div>
                  </div>
                </div>
                <div className="accordion-item">
                  <h2 className="accordion-header" id="headingThree">
                    <button className="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="collapseThree" className="accordion-collapse collapse shade" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div className="accordion-body">
                      <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6>
                    </div>
                  </div>
                </div>
                <div className="accordion-item">
                  <h2 className="accordion-header" id="headingFour">
                    <button className="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="collapseFour" className="accordion-collapse collapse shade" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div className="accordion-body">
                      <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6>
                    </div>
                  </div>
                </div>
                <div className="accordion-item">
                  <h2 className="accordion-header" id="headingFive">
                    <button className="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Lorem ipsum dolor sit amet
                    </button>
                  </h2>
                  <div id="collapseFive" className="accordion-collapse collapse shade" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                    <div className="accordion-body">
                      <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h6>
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

  )
}

export default Content