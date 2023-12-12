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
          <img src="/assets/img/bg/big-paw.png" alt="paw-image" />
          <img src="/assets/img/bg/small-paw.png" alt="paw-image" />
        </div>
        <Services />
      </section>

      <HomepageDoctors />

      <Homepage_Blog />
    </div>

  )
}

export default Content