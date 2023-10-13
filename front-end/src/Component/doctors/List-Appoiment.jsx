import React from 'react'
import { Link } from 'react-router-dom'
import listAppiontmentApi from '../../api/listAppiontment';
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
const AppoimentList = () => {
  const { id } = useParams();
    const [listAppiontment, setListAppiontment] = useState(null);

    const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchAppointments = async () => {
        try {
         const response = await listAppiontmentApi.get(id,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setListAppiontment(response.appointments);     
        console.log(response.appointments);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchAppointments();
    }, []);
    
   }
   
    if (!listAppiontment) {
        return <div>Loading...</div>;
    }
  return (
    <div className="table-responsive">
      <table className="table table-hover table-center mb-0">
        <thead>
          <tr>
            <th>Bác sĩ</th>
            <th>Ngày đặt lịch</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>
              <h2 className="table-avatar">
                <Link to="/doctors/detail-appointments" className="avatar avatar-sm me-2">
                  <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                </Link>
                <Link to="/doctors/detail-appointments">haha
                  <span></span></Link>
              </h2>
            </td>
            <td>14 Nov 2023 <span className="d-block text-info">10.00
              AM</span></td>

            <td>$160</td>

            <td><span className="badge rounded-pill bg-success-light">Confirm</span>
            </td>
            <td>
              <div className="table-action">
                <Link to="/doctors/detail-appointments" className="btn btn-sm bg-info-light">
                  <i className="far fa-eye" /> View
                </Link>
              </div>
            </td>
          </tr>


        </tbody>
      </table>
    </div>
  )
}

export default AppoimentList