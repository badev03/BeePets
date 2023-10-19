//appoi
import React from 'react'
import Menudashboard from './Menu-dashboard'
import { Link } from 'react-router-dom'
import appointmentsApi from '../../api/appointmentsApi';
import { useEffect, useState } from "react";

const Appointments = () => {
  const [appointments, setAppointment] = useState([]);
  
  const token = localStorage.getItem('token');
   if(token){
     useEffect(() => {
      const fetchAppointment = async () => {
        try {
         const response = await appointmentsApi.getAll(
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setAppointment(response.data);     
        console.log(response);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchAppointment();
    }, []); 
   }
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
                {appointments.map(appointment => (
                  <div key={appointment.id} className="appointment-list">

                    <div className="profile-info-widget">
                      <Link to="patient-profile.html" className="booking-doc-img">
                        <img src="/img/patients/patient.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3><Link to={`/doctors/patient-profile/${appointment.user.id}`}>{appointment.user.name}</Link></h3>
                        <div className="patient-details">
                          <h5><i className="far fa-clock" /> {appointment.date}, {appointment.shift_name}</h5>

                          <h5 className="mb-0"><i className="fas fa-phone" /> {appointment.user.phone}</h5>
                        </div>
                      </div>
                    </div>
                    <div className="appointment-action">
                      <Link to={`/doctors/patient-profile/${appointment.user.id}`} className="btn btn-sm bg-info-light" >
                        <i className="far fa-eye" /> View
                      </Link>

                      <Link to="#" className="btn btn-sm bg-danger-light">
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