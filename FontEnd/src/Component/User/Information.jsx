import React from 'react'



const Information = () => {
  return (
<div>
  <div className="doctor-content">
    <div className="container">
      <div className="row">
        <div className="col-md-12">
          <div className="back-link">
            <a href="booking.html"><i className="fa-solid fa-arrow-left-long" /> Quay lại</a>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-lg-8 col-md-12">
          <div className="paitent-header">
            <h4 className="paitent-title">Thông tin</h4>
          </div>
          <div className="paitent-appointment">
            <form action="">
              
              <div className="forms-block">
                <label className="form-group-title">Họ và tên </label>
                <input type="text" className="form-control"  />
              </div>
              <div className="forms-block">
                <label className="form-group-title">Số điện thoại</label>
                <input type="text" className="form-control"  />
              </div>
              <div className="forms-block">
                <label className="form-group-title">Loại thú cưng</label>
                <input type="text" className="form-control"  />
              </div>
              <div className="forms-block">
                <label className="form-group-title">Chọn dịch vụ</label>
                <input type="text" className="form-control"  />
              </div>
              <div className="forms-block">
                <label className="form-group-title">Ghi chú</label>
                <input type="text" className="form-control"  />
              </div>
              <div className="forms-block mb-0">
                <div className="booking-btn">
                  <button type="submit" className="btn btn-primary prime-btn justify-content-center align-items-center">
                    Tiếp tục <i className="feather-arrow-right-circle" />
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div className="col-lg-4 col-md-12">
          <div className="booking-header">
            <h4 className="booking-title">Tóm tắt thông tin</h4>
          </div>
          <div className="card booking-card">
            <div className="card-body booking-card-body">
              <div className="booking-doctor-details">
                <div className="booking-doctor-left">
                  <div className="booking-doctor-img">
                    <a href="doctor-profile.html">
                      <img src="../src/assets/img/doctors/doctor-02.jpg" alt="John Doe" />
                    </a>
                  </div>
                  <div className="booking-doctor-info">
                    <h4><a href="doctor-profile.html">Dr. John Doe</a></h4>
                    <p>MBBS, Dentist</p>
                  </div>
                </div>
                <div className="booking-doctor-right">
                  <p>
                    <i className="fas fa-circle-check" />
                    <a href="doctor-profile-settings.html">Sửa</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div className="card booking-card">
            <div className="card-body booking-card-body booking-list-body">
              <div className="booking-list">
                <div className="booking-date-list">
                  <ul>
                    <li>Ngày đặt: <span>Sun, 30 Aug 2023</span></li>
                    <li>Thời gian: <span>10.00AM to 11:00AM</span></li>
                  </ul>
                </div>
                <div className="booking-doctor-right">
                  <p>
                    <a href="booking.html">Sửa</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>
  <div className="mouse-cursor cursor-outer" />
  <div className="mouse-cursor cursor-inner" />
</div>

  )
}

export default Information