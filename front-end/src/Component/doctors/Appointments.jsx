import React from 'react'
import Menudashboard from './Menu-dashboard'
import { Link } from 'react-router-dom'
import appointmentsApi from '../../api/appointments';
import { useEffect, useState } from 'react'


const Appointments = () => {
  const [appointmens, setAppointmens] = useState([]);

  useEffect(() => {
    const fetchAppointmens = async () => {
      try {
        const response = await appointmentsApi.getAll();
        setAppointmens(response);
        console.log(services);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchAppointmens();
  }, []);
  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Lịch hẹn</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
                  <li className="breadcrumb-item" aria-current="page">Lịch hẹn</li>
                </ol>
              </nav>
              {/* test */}
            </div>
          </div>
        </div>
      </div>
      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
              <Menudashboard />
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="appointments">
                {appointmens.map(appointmens => (
                  <div className="appointment-list">

                    <div className="profile-info-widget">
                      <Link to="patient-profile.html" className="booking-doc-img">
                        <img src="/img/patients/patient.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3><Link to={`/doctors/detail-appointments/${appointmens.id}`}>{appointmens.user}</Link></h3>
                        <div className="patient-details">
                          <h5><i className="far fa-clock" /> {appointmens.date}, {appointmens.time}</h5>

                          <h5 className="mb-0"><i className="fas fa-phone" /> +1 923 782 4575</h5>
                        </div>
                      </div>
                    </div>
                    <div className="appointment-action">
                      <Link to={`/doctors/detail-appointments/${appointmens.id}`} className="btn btn-sm bg-info-light" >
                        <i className="far fa-eye" /> View
                      </Link>

                      <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                        <i className="fas fa-times" /> Cancel
                      </Link>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  )
}

export default Appointments