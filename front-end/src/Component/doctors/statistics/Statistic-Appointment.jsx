import React from 'react'
import Menudashboard from '../Menu-dashboard';
import { Link } from 'react-router-dom'

const StatisticAppointment = () => {
  return (
    <div>
      {/* Phần breadcrumb */}
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Bảng điều khiển</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Trang chủ</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Bảng điều khiển
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>

      {/* Phần nội dung */}
      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
              <Menudashboard />
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="row">
                <div className="col-md-12">
                  <h4 className="mb-4">Thống kê lịch hẹn</h4>
                  <div className="appointment-tab">
                    <div className="search-container">
                      {/* Phần mã HTML tìm kiếm hiện tại của bạn */}
                    </div>
                    <div className="tab-content">
                      
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

export default StatisticAppointment