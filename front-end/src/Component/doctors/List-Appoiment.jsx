import React from 'react'
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import appointmentsApi from '../../api/appointmentsApi'
import appointmentUsersApi from '../../api/appoinmentsUse'

const AppoimentList = () => {
  const [appointments, setAppointmentsApi] = useState([]);
  
  const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchUser = async () => {
        try {
         const response = await appointmentUsersApi.getAppoinments(
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setAppointmentsApi(response.appointments); 
        console.log(response.appointments);    
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchUser();
    }, []); 
   }
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
              {appointments.map(appointment=>(
              <tr key={appointment.id}>
              <td>
                <h2 className="table-avatar">
                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                    <img className="avatar-img rounded-circle" src={appointment.avatar} alt="User Image" />
                  </a>
                  <a href="doctor-profile.html">{appointment.doctor_id}</a>
                </h2>
              </td>
              <td>{appointment.date} <span className="d-block text-info">{appointment.time} AM</span></td>
              <td>{appointment.date}</td>

              <td><span className="badge rounded-pill bg-success-light">Confirm</span></td>
              <td>
                <div className="table-action">
                  
                  <button className="btn btn-sm bg-info-light">
                    <Link to={"/user/appointment"}> <i className="far fa-eye" /> View</Link>
                    
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
  )
}


export default AppoimentList