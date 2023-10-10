import React from 'react'
import { Link } from 'react-router-dom'
import Appointments from './Appointments'
import Sidebar from './Sidebar'
import Prescription from './Prescription'
import Bill from './Bill'


const Dashboard = () => {
  return (
    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Bảng điều khiển</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Bảng điều khiển</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
       <Sidebar/>
        <div className="col-md-7 col-lg-8 col-xl-9">
       

          <div className="card">
            <div className="card-body pt-0">
              <nav className="user-tabs mb-4">
                <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
                  <li className="nav-item">
                    <a className="nav-link active" href="#pat_appointments" data-bs-toggle="tab">Lịch khám</a>
                  </li>
                  <li className="nav-item">
                    <a className="nav-link" href="#pat_prescriptions" data-bs-toggle="tab">Đơn thuốc</a>
                  </li>
                  <li className="nav-item">
                    <a className="nav-link" href="#pat_medical_records" data-bs-toggle="tab"><span className="med-records">Hóa đơn</span></a>
                  </li>

                </ul>
              </nav>
              <div className="tab-content pt-0">
                <Appointments/>
                <Prescription/>
                <Bill/>

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

export default Dashboard