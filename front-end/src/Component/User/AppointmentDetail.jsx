import React, { useEffect, useState } from 'react';

import { Link, useParams } from 'react-router-dom'
import Sidebar from './Sidebar'
import appointmentUsersApi from '../../api/appoinmentsUse';
import axios from 'axios';
import { Image } from 'react-bootstrap';


const AppointmentDetail = () => {
  const [appointments, setAppointments] = useState([]);
  const { id } = useParams();
  console.log(id);
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchAppointmentDetail = async () => {
        try {
          const response = await axios.get(`http://127.0.0.1:8000/api/get-appointment-user/${id}`, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setAppointments(response.data.appointment);
          // console.log(response.data.user);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };
      fetchAppointmentDetail();
    }
  }, [id, token]);
  const formatShiftTime = (shiftName) => {
    switch (shiftName) {
      case 'Ca 1':
        return ' 8:00h-12:00h';
      case 'Ca 2':
        return '13:00h-17:00h';
      case 'Ca 3':
        return '18:00h-20:00h';
      default:
        return '';
    }
  };
  return (
    <div>    <div><div className="breadcrumb-bar-two">
      <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">Chi tiết lịch khám</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
              <ol className="breadcrumb">
                <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li className="breadcrumb-item" aria-current="page">Chi tiết lịch khám</li>
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
                <div className="card-body">
                  <form>

                    <div className="row">

                      <div className="profile-img d-flex justify-content-center align-items-center">
                        <img src={appointments.doctor_image} alt="User Image" className="rounded-0"
                          style={{ width: '25%', border: 'none', marginBottom: '20px' }} />
                      </div>


                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Tên bác sĩ</label>
                          <input type="text" className="form-control" value={appointments.doctor_name} readOnly />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Loại thú cưng</label>
                          <input type="text" className="form-control" value={appointments.doctor_name} readOnly />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Ngày đặt lịch</label>
                          <input type="text" className="form-control" value={appointments.date} readOnly />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Lịch khám</label>
                          <input type="text" className="form-control" value={formatShiftTime(appointments.shift_name)} readOnly />
                        </div>
                      </div>

                      <div className="col-12 col-md-12">
                        <div className="mb-3">
                          <label className="mb-2">Ghi chú</label>

                          <textarea type="text" className="form-control datetimepicker" value={appointments.description} readOnly />

                        </div>
                      </div>



                    </div>

                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div></div>
  )
}

export default AppointmentDetail