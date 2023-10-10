import { Link } from 'react-router-dom'
import { DatePicker, Select } from 'antd';
import moment from 'moment';
import 'moment/locale/vi';
import locale from 'antd/es/date-picker/locale/vi_VN';
moment.locale('vi');

const Banner = () => {
  const today = moment();

  const handleChange = (value) => {
    console.log(`selected ${value}`);
  };

  const onChange = (date, dateString) => {
    console.log(date, dateString);
  };

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
                <div className="banner-img banner-img-twelve aos" >
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
                <div className="banner-content banner-content-fourteen aos" >
                  <h1>Hãy để chúng tôi <span>chăm sóc thú cưng của bạn</span></h1>
                </div>
                <div className="search-box-fourteen aos" >
                  <form action="https://doccure.dreamguystech.com/html/template/search.html" className="form-block d-flex">
                    <div className="search-input">
                      <div className="forms-block">
                        <label className="mb-0">Chọn Ngày</label>
                        <div className="input-group" >
                          <DatePicker
                            onChange={onChange}
                            style={{
                              height: 35,
                            }}
                            defaultValue={today}
                            placeholder='Chọn Ngày'
                            locale={locale}
                          />
                        </div>
                      </div>
                    </div>
                    <div className="search-input">
                      <div className="forms-block mb-0">
                        <label className="location-icon">Chọn Dịch Vụ</label>
                        <Select
                          defaultValue="Khám Bệnh"
                          style={{
                            width: 130,
                            height: 35,
                          }}
                          onChange={handleChange}
                          options={[
                            {
                              value: 'Khám Bệnh',
                              label: 'Khám Bệnh',
                            },
                            {
                              value: 'Chữa Bệnh',
                              label: 'Chữa Bệnh',
                            },
                            {
                              value: 'Spa',
                              label: 'Spa',
                            },
                          ]}
                        />
                      </div>
                    </div>
                    <div className="search-btn">
                      <Link to={'booking'}><button className="btn btn-primary" type="submit">Đặt Lịch Nhanh</button></Link>
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