import React from 'react'

const Banner = () => {
  return (
    <div>
  <div>
    <section className="banner-section-fourteen banner-section-twelve">
      <div className="banner-section-twelve-bg">
        <img src="../src/assets/img/bg/home-12-banner-bg-1.png" alt="design-image" />
        <img src="../src/assets/img/bg/home-12-banner-bg-2.png" alt="design-image" />
      </div>
      <div className="container">
        <div className="row">
          <div className="col-lg-6">
            <div className="banner-img banner-img-twelve aos" data-aos="fade-up">
              <img src="../src/assets/img/bg/home-12-banner-1.png" className="img-fluid" alt="dog-image" />
              <img src="../src/assets/img/bg/home-12-banner-2.png" className="img-fluid" alt="cat-image" />
              <div className="banner-banner-img-twelve-bg">
                <img src="../src/assets/img/bg/dot-1.png" alt="dot-icon" />
                <img src="../src/assets/img/bg/dot-2.png" alt="dot-icon" />
                <img src="../src/assets/img/bg/ring-1.png" alt="ring-icon" />
                <img src="../src/assets/img/bg/ring-2.png" alt="ring-icon" />
              </div>
            </div>
          </div>
          <div className="col-lg-6">
            <div className="banner-content banner-content-fourteen aos" data-aos="fade-up">
              <h1>Hãy để chúng tôi <span>chăm sóc thú cưng của bạn</span></h1>
            </div>
            <div className="search-box-fourteen aos" data-aos="fade-up">
              <form action="https://doccure.dreamguystech.com/html/template/search.html" className="form-block d-flex">
                <div className="search-input">
                  <div className="forms-block">
                    <label className="mb-0">Date</label>
                    <input type="text" className="form-control datetimepicker" placeholder="Thu, Mar 24, 2023" />
                  </div>
                </div>
                <div className="search-input">
                  <div className="forms-block mb-0">
                    <label className="location-icon">Location</label>
                    <input type="text" className="form-control" placeholder="San Diego Branch" />
                  </div>
                </div>
                <div className="search-btn">
                  <button className="btn btn-primary" type="submit">Book Now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
  )
}

export default Banner