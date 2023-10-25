//detail appoi
import React from 'react'
import { Link } from 'react-router-dom'
import Menudashboard from './Menu-dashboard'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import appointmentsApi from '../../api/appointmentsApi';


const DetailAppointment = () => {
  const { id } = useParams();
    const [appointments, setAppointments] = useState(null);

    const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchAppointment = async () => {
        try {
         const response = await appointmentsApi.get(id,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setAppointments(response.data);     
        console.log(response.data);
      

        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchAppointment();
    }, []); 
    console.log(appointments);
   }
    if (!appointments) {
        return <div>Loading...</div>;
    }
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
      <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">
          <div className="card widget-profile pat-widget-profile">
            <div className="card-body">
                <Menudashboard/>
              {/* <div className="pro-widget-content">
                <div className="profile-info-widget">
                  <Link to="#" className="booking-doc-img">
                    <img src="/img/patients/patient.jpg" alt="User Image" />
                  </Link>
                  <div className="profile-det-info">
                    <h3>{appointments[0].user.name}</h3>
                    <div className="patient-details">
                      <h5><b>Patient ID :</b> {appointments[0].user_id}</h5>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div className="patient-info">
                <ul>
                  <li>SĐT <span>{appointments[0].user.phone}</span></li>
                </ul>
              </div> */}
            </div>
          </div>
          <div className="card">
            <div className="card-header">
              <h4 className="card-title">Lịch đặt gần đây</h4>
            </div>
            <ul className="list-group list-group-flush">
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">14 Nov 2023 5.00 PM</span>
                  </div>
                </div>
              </li>
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">12 Nov 2023 11.00 AM</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
       
        <div className="card">
            <div className="card-body">
              <form>
              
                <div className="row">
               
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên khách hàng</label>
                      <input type="text" className="form-control" value={appointments[0].user.name} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số điện thoại</label>
                      <input type="text" className="form-control" value={appointments[0].user.phone} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Loại thú cưng</label>
                      <input type="text" className="form-control" value={appointments[0].type_pet.name}  />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Ngày đặt lịch</label>
                      <input type="text" className="form-control" value={appointments[0].date} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Lịch khám</label>
                      <input type="text" className="form-control" value={appointments[0].shift_name} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Dịch vụ</label>
                      <input type="text" className="form-control" value={appointments[0].service.name} />
                    </div>
                  </div>
                 
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <label className="mb-2">Ghi chú</label>
                     
                        <textarea type="text" className="form-control datetimepicker" value={appointments[0].description} />
                      
                    </div>
                  </div>
                 
                  
  
                </div>
                {/* <div className="submit-section">
                  <button type="submit" className="btn btn-primary submit-btn">Lưu</button>
                </div> */}
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

export default DetailAppointment