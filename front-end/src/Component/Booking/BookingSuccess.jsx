import React from 'react'



const BookingSuccess = () => {
  return (
    <div>
        
<div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Thông báo</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Thông báo</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content success-page-cont">
    <div className="container">
      <div className="row justify-content-center">
        <div className="col-lg-6">
          <div className="card success-card">
            <div className="card-body">
              <div className="success-cont">
                <i className="fas fa-check" />
                <h3>Đặt lich thành công!</h3>
                {/* <p>Appointment booked with <strong>Dr. Darren Elder</strong><br /> on <strong>12 Nov 2023 5:00PM to 6:00PM</strong></p>
                <a href="invoice-view.html" className="btn btn-primary view-inv-btn">View Invoice</a> */}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
  )
}

export default BookingSuccess