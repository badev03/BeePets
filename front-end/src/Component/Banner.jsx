import Booking from "./Booking";
import { useAuth } from "../Context/ContextAuth";

const Banner = () => {
  const { role } = useAuth();
  return (
    <div>
      <div>
        <section className="banner-section-fourteen banner-section-twelve">
          <div className="banner-section-twelve-bg">
            <img
              src="../src/assets/img/bg/home-12-banner-bg-1.png"
              alt="design-image"
            />
            <img
              src="../src/assets/img/bg/home-12-banner-bg-2.png"
              alt="design-image"
            />
          </div>
          <div className="container">
            <div className="row">
              <div className="col-lg-6">
                <div className="banner-img banner-img-twelve aos">
                  <img
                    src="../src/assets/img/bg/home-12-banner-1.png"
                    className="img-fluid"
                    alt="dog-image"
                  />
                  <img
                    src="../src/assets/img/bg/home-12-banner-2.png"
                    className="img-fluid"
                    alt="cat-image"
                  />
                  <div className="banner-banner-img-twelve-bg">
                    <img src="../src/assets/img/bg/dot-1.png" alt="dot-icon" />
                    <img src="../src/assets/img/bg/dot-2.png" alt="dot-icon" />
                    <img
                      src="../src/assets/img/bg/ring-1.png"
                      alt="ring-icon"
                    />
                    <img
                      src="../src/assets/img/bg/ring-2.png"
                      alt="ring-icon"
                    />
                  </div>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="banner-content banner-content-fourteen aos">
                  <h1>
                    Hãy để chúng tôi <span>chăm sóc thú cưng của bạn</span>
                  </h1>
                </div>
                {role !== "doctor" && <Booking />}
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default Banner;
