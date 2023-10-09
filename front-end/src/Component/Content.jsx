import Banner from "./Banner";
import HomepageDoctors from "./Homepage/HomepageDoctors";
import Homepage_Blog from "./Homepage/Homepage_blog";


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
            <div className="col-lg-12 aos" >
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
              <a href="servicerdetails">
                <div className="our-services-list w-100">
                  <div className="service-icon">
                    <img
                      src="../src/assets/img/icons/injection.svg"
                      alt="injection-icon"
                    />
                  </div>
                  <h4>Tiêm chủng</h4>
                  <p>
                    Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng.
                  </p>
                </div>
              </a>
            </div>
            <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
              <div className="our-services-list w-100">
                <div className="service-icon">
                  <img
                    src="../src/assets/img/icons/bottel.svg"
                    alt="bottel-icon"
                  />
                </div>
                <h4>Thuốc thú cưng</h4>
                <p>
                  Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng
                </p>
              </div>
            </div>
            <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
              <div className="our-services-list w-100">
                <div className="service-icon">
                  <img
                    src="../src/assets/img/icons/bath-tub.svg"
                    alt="pet-grooming-icon"
                  />
                </div>
                <h4>Chăm sóc thú cưng</h4>
                <p>
                  Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng
                </p>
              </div>
            </div>
            <div className="col-lg-3 col-md-4 col-sm-12 d-flex">
              <div className="our-services-list w-100">
                <div className="service-icon">
                  <img
                    src="../src/assets/img/icons/pet-doctor.svg"
                    alt="stethoscope-icon"
                  />
                </div>
                <h4>Khám phá</h4>
                <p>
                  Chúng ta cũng cần quan tâm tới vấn đề sức khỏe của thú cưng
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <HomepageDoctors />

      <Homepage_Blog />
    </div>

  )
}

export default Content