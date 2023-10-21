import React from 'react'
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import appointmentUsersApi from '../../api/appoinmentsUse'
import { useParams } from 'react-router-dom';

const AppoimentList = () => {
  const [appointments, setAppointmentsApi] = useState([]);
  const { id } = useParams();
  
  const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchUser = async () => {
        try {
         const response = await appointmentUsersApi.getAppoinmentsUser(id,
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
              <tr key={appointment} data={appointment}>
              <td>
                <h2 className="table-avatar">
                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                  <img className="avatar-img rounded-circle" src={appointment.image} alt="User Image" />
                  </a>
                  <a href="doctor-profile.html">{appointment.name} </a>
                </h2>
              </td>
              <td>{appointment.date} <span className="d-block text-info">{appointment.shift_name}</span></td>
              <td>{appointment.appointment_created_at}</td>
              <td>
                {appointment.status == 1 ? (
                  <span className="badge rounded-pill bg-success-light">Xác nhận</span>
                ) : appointment.status == 2 ? (
                  <span class="badge rounded-pill bg-danger-light">Đã hủy</span>
                ) : (
                  // Optional default case
                  <span className="badge rounded-pill bg-info-light">Không xác định</span>
                )}
              </td>

              <td>
                <div className="table-action">
                  
                  <button className="btn btn-sm bg-info-light">
                    <Link to={`/doctors/accept-detail-appointments/${appointment.id}`}> <i className="far fa-eye" /> View</Link>
                    
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