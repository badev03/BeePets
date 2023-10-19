import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import appointmentUsersApi from '../../api/appoinmentsUse';

const Appointments = () => {
  const [appointments, setAppointments] = useState([]);

  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchUser = async () => {
        try {
          const response = await appointmentUsersApi.getHistoryAppoinments({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setAppointments(response.appointments);
          console.log(response.appointments);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };

      fetchUser();
    }
  }, [token]);
  // const formatTime = (time) => {
  //   const splitTime = time.split(":");
  //   const hours = parseInt(splitTime[0]);
  //   const minutes = splitTime[1];
  //   const seconds = splitTime[2];
  //   const suffix = hours >= 12 ? 'PM' : 'AM';
  //   const formattedHours = hours % 12 || 12;
  //   return `${formattedHours}:${minutes}:${seconds} ${suffix}`;
  // };
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
    <div id="pat_appointments" className="tab-pane fade show active">
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Bác sĩ</th>
                  <th>Lịch khám</th>
                  <th> Ngày đặt lịch</th>
                  <th>Trạng thái</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {appointments.map(appointment => (
                  <tr key={appointment.id}>
                    <td>
                      <h2 className="table-avatar">
                        <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                          <img className="avatar-img rounded-circle" src={appointment.avatar} alt="User Image" />
                          <span>{appointment.doctor_name}</span>
                        </a>
                        <a href="doctor-profile.html">{appointment.doctor_id}</a>
                      </h2>
                    </td>
                    <td>
                      {/* <span className="d-block text-info">
                        {appointment.time ? formatTime(appointment.time) : ''}
                      </span> */}
                      <span className="d-block text-info">
                        {appointment.shift_name}
                      </span>
                      <span className="d-block ">
                        {formatShiftTime(appointment.shift_name)}
                      </span>
                    </td>
                    <td>{appointment.date}</td>
                    <td>
                      <span className={`badge rounded-pill ${parseInt(appointment.status) === 0 ? 'bg-success-light' : parseInt(appointment.status) === 1 ? 'bg-danger-light' : ''}`}>
                        {parseInt(appointment.status) === 0 ? 'Confirm' : parseInt(appointment.status) === 1 ? 'Panding' : ''}
                      </span>
                    </td>
                    <td>
                      <div className="table-action">
                        <button className="btn btn-sm bg-info-light">
                          <Link to={'/user/appointment/{appointment.id}'}>
                            <i className="far fa-eye" /> View
                          </Link>
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Appointments;
