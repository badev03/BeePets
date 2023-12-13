import React from 'react'
import BreadcrumbBar from '../BreadcrumbBar'



const BookingSuccess = () => {
  return (
    <div>
        
<div>
<BreadcrumbBar title="THÔNG BÁO" lable="Thông báo" />

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