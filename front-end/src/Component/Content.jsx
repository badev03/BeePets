import Banner from "./Banner";
import HomepageDoctors from "./Homepage/HomepageDoctors";
import Homepage_Blog from "./Homepage/Homepage_blog";
import Services from "./Servicer/Services";


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
          <Services/>
        </div>
      </section>

      <HomepageDoctors />

      <Homepage_Blog />
    </div>

  )
}

export default Content