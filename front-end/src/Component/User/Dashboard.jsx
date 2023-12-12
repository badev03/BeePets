import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import Appointments from './Appointments';
import Prescription from './Prescription';
import Bill from './Bill';
import Sidebar from './Sidebar';
import TopLink from '../../Link/TopLink';

const Dashboard = () => {
  const [activeTab, setActiveTab] = useState('appointments');
  const handleTabChange = (tab) => {
    setActiveTab(tab);
  };
  return (
    <div><div className="breadcrumb-bar-two">
      <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">Bảng điều khiển</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
              <ol className="breadcrumb">
                <li className="breadcrumb-item"><Link to={`/`} >Trang chủ</Link></li>
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
            <Sidebar />
            <div className="col-md-7 col-lg-8 col-xl-9">


              <div className="card">
                <div className="card-body pt-0">
                  <nav className="user-tabs mb-4">
                    <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
                      <li className="nav-item">
                        <Link className={`nav-link ${activeTab === 'appointments' ? 'active' : ''}`}
                          onClick={() => handleTabChange('appointments')} data-bs-toggle="tab">Lịch khám</Link>
                      </li>
                      {/*<li className="nav-item">*/}
                      {/*  <a className={`nav-link ${activeTab === 'prescriptions' ? 'active' : ''}`}*/}
                      {/*    onClick={() => handleTabChange('prescriptions')} href="#pat_prescriptions" data-bs-toggle="tab">Đơn thuốc</a>*/}
                      {/*</li>*/}
                      <li className="nav-item">
                        <Link className={`nav-link ${activeTab === 'bill' ? 'active' : ''}`}
                          onClick={() => handleTabChange('bill')} href="#pat_medical_records" data-bs-toggle="tab"><span className="med-records">Hóa đơn</span></Link>
                      </li>

                    </ul>
                  </nav>
                  <div className="tab-content pt-0">
                    {activeTab === 'appointments' && <Appointments />}
                    {activeTab === 'prescriptions' && <Prescription />}
                    {activeTab === 'bill' && <Bill />}

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