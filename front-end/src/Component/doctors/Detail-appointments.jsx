//detail appoi
import React from 'react'
import { Link } from 'react-router-dom'
import Menudashboard from './Menu-dashboard'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import appointmentsApi from '../../api/appointmentsApi';
import LoadingSkeleton from '../Loading';
import BreadcrumbBar from '../BreadcrumbBar';


const DetailAppointment = () => {
  const { id } = useParams();
  const [appointments, setAppointments] = useState(null);

  const token = localStorage.getItem('token');

  if (token) {
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



        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchAppointment();
    }, []);
    console.log(appointments);
  }
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "vi-VN",
        options,
      );
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace("lúc", "").trim();
    }
    return "";
  }
  const formatShiftTime = (shiftName) => {
    switch (shiftName) {
      case "Ca 1":
        return " 8:00h-12:00h";
      case "Ca 2":
        return "13:00h-17:00h";
      case "Ca 3":
        return "18:00h-20:00h";
      default:
        return "";
    }
  };
  const formatCurrency = (value) => {
    const numberValue = parseFloat(value);
    return numberValue.toLocaleString("vi-VN", {
      style: "currency",
      currency: "VND",
    });
  };
  if (!appointments) {
    return <LoadingSkeleton />;
  }
  return (
    <div>    
      <div>
      <BreadcrumbBar title="CHI TIẾT LỊCH KHÁM" lable="Chi tiết lịch khám" />

      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

              <Menudashboard />

            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">

              <div className="card">
                <div className="card-body">
                  <form>

                    <div className="row">
                      <div className="col-xl-6">   <div className="profile-info">
                        <div className="profile-item">
                          <span className="profile-label">Tên khách hàng:</span>
                          <span className="profile-value">{appointments[0].user.name} </span>
                        </div>
                        <div className="profile-item">
                          <span className="profile-label">Số điện thoại:</span>
                          <span className="profile-value">{appointments[0].user.phone}</span>
                        </div>
                        <div className="profile-item">
                          <span className="profile-label">Loại thú cưng:</span>
                          <span className="profile-value">{appointments[0].type_pet.name}</span>
                        </div>
                        <div className="profile-item">
                          <span className="profile-label">Dịch vụ:</span>
                          <span className="profile-value">{appointments[0].service.name}</span>
                        </div>
                        <div className="profile-item">
                          <span className="profile-label">Ngày đặt lịch:</span>
                          <span className="profile-value">{formatDate(appointments[0].date)}</span>
                        </div>
                        <div className="profile-item">
                          <span className="profile-label">Lịch khám:</span>
                          <span className="profile-value">{formatShiftTime(appointments[0].shift_name)}</span>
                          <span className="profile-value">{formatDate(appointments[0].date)}</span>
                        </div>

                        <div className="profile-item">
                          <span className="profile-label">Ghi chú:</span>
                          <span className="profile-value">  <div dangerouslySetInnerHTML={{ __html: appointments[0].description }} />
</span>
                        </div>
                      </div>
                      </div>
                      <div className="col-xl-6">  {appointments[0].user.image ? (
                        <div className="profile-img d-flex justify-content-center align-items-center">
                          <img src={appointments.user.image} alt="User Image" className="rounded-0"
                            style={{ width: '50%', border: 'none', marginBottom: '20px' }} />
                        </div>
                      ) : (
                        <div className="profile-img d-flex justify-content-center align-items-center">
                          <img src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="User Image" className="rounded-0"
                            style={{ width: '50%', border: 'none', marginBottom: '20px' }} />
                        </div>
                        // <div className="default-avatar booking-doc-img">
                        //   <img src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="Default Avatar" />
                        // </div>
                      )}
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