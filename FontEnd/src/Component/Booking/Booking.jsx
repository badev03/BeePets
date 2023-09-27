import React from 'react'



const Booking = () => {
  return (
 <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Đặt lịch</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Đặt lịch</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <div className="col-12">
          <div className="card">
            <div className="card-body">
              <div className="booking-doc-info">
                <a href="doctor-profile.html" className="booking-doc-img">
                  <img src="src/assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                </a>
                <div className="booking-info">
                  <h4><a href="doctor-profile.html">Dr. Thành Đoàn</a></h4>
                  <div className="rating">
                    <i className="fas fa-star filled" />
                    <i className="fas fa-star filled" />
                    <i className="fas fa-star filled" />
                    <i className="fas fa-star filled" />
                    <i className="fas fa-star" />
                    <span className="d-inline-block average-rating">35</span>
                  </div>
                  <p className="text-muted mb-0"><i className="fas fa-map-marker-alt" /> Newyork, USA</p>
                </div>
              </div>
            </div>
          </div>
          <div className="row">


          </div>
          <div className="card booking-schedule schedule-widget">
            <div className="schedule-header">
              <div className="row">
                <div className="col-md-12">
                  <div className="day-slot">
                    <ul>
                      <li className="left-arrow">
                        <a href="javascript:void(0)">
                          <i className="fa fa-chevron-left" />
                        </a>
                      </li>
                      <li>
                        <span>Mon</span>
                        <span className="slot-date">11 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Tue</span>
                        <span className="slot-date">12 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Wed</span>
                        <span className="slot-date">13 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Thu</span>
                        <span className="slot-date">14 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Fri</span>
                        <span className="slot-date">15 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Sat</span>
                        <span className="slot-date">16 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li>
                        <span>Sun</span>
                        <span className="slot-date">17 Nov <small className="slot-year">2023</small></span>
                      </li>
                      <li className="right-arrow">
                        <a href="javascript:void(0)">
                          <i className="fa fa-chevron-right" />
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="schedule-cont">
           <div className="row">
  <div className="col-lg-4 col-md-4">
    <div className="time-slot time-slot-blk">
   
      <div className="time-slot-list">
        <ul>
          <li>
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 09:00 - 09:30</span>
            </a>
          </li>
          <li>
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 10:00 - 10:30</span>
            </a>
          </li>
          <li >
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 11:00 - 11:30</span>
            </a>
          </li>
          <li>
            
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div className="col-lg-4 col-md-4">
    <div className="time-slot time-slot-blk">

      <div className="time-slot-list">
        <ul>
          <li>
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 12:00 - 12:30</span>
            </a>
          </li>
          <li>
            <a className="timing active" href="#">
              <span><i className="feather-clock" /> 01:00 - 01:30</span>
            </a>
          </li>
          <li >
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 02:30 - 03:00</span>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
  <div className="col-lg-4 col-md-4">
    <div className="time-slot time-slot-blk">
   
      <div className="time-slot-list">
        <ul>
          <li>
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 03:00 - 03:30</span>
            </a>
          </li>
          <li>
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 04:00 - 04:30</span>
            </a>
          </li>
          <li >
            <a className="timing" href="#">
              <span><i className="feather-clock" /> 05:00 - 05:30</span>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
</div>

            </div>
          </div>
          <div className="booking-btn">
  <a href="informationuser" className="btn btn-primary prime-btn justify-content-center align-items-center">
    Tiếp tục <i className="feather-arrow-right-circle" />
  </a>
</div>

        </div>
      </div>
    </div>
  </div>
</div>

  )
}

export default Booking