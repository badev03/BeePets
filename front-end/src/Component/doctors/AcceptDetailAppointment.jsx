//detail appoi
import React from 'react'
import { Link } from 'react-router-dom'
import Menudashboard from './Menu-dashboard'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import appointmentsApi from '../../api/appointmentsApi';
import axios from "axios";
import { FaSpinner } from "react-icons/fa";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import LoadingSkeleton from "../Loading";
import { Modal, Form, Input, Button, Dropdown, Menu } from "antd";

const MySwal = withReactContent(Swal);

const AcceptDetailAppointment = () => {
  const { id } = useParams();
  const [appointments, setAppointments] = useState(null);

  const token = localStorage.getItem('token');
  const [loadingId, setLoadingId] = useState(null);
  const [loadingIdd, setLoadingIdd] = useState(null);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [error, setError] = useState(false);
  // const [cancelId, setCancelId] = useState(null);
  const [reason, setReason] = useState("");
  const [selectedAppointmentId, setSelectedAppointmentId] = useState(null);
  const handleCancel = () => {
    setIsModalVisible(false);
  };


  const fetchAppointment = async () => {
    try {
      const response = await appointmentsApi.getAcceptAppointment(id,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      setAppointments(response.appointment);



    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }
  };
  if (token) {

    useEffect(() => {
      fetchAppointment();
    }, []);

  }
  const handleUpdate = async (id) => {
    setLoadingId(id);
    try {
      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=1`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        },
      );

      MySwal.fire({
        title: "Cập nhật trạng thái  thành công!",
        icon: "success",
      });
      fetchAppointment();
    } catch (error) {
      console.log(error);
    } finally {
      setLoadingId(null);
    }
  };
  const showModal = (id) => {
    console.log(id);
    setSelectedAppointmentId(id);
    setIsModalVisible(true);
  };
  const handleCancelStatus = async (id, reason) => {
    console.log(reason);
    console.log(id);
    try {
      setLoadingIdd(id);

      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=6&reason_cancel=${reason}`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        },
      );

      setIsModalVisible(false);

      MySwal.fire({
        title: "Cập nhật trạng thái  thành công!",
        icon: "success",
      });
      fetchAppointment();
    } catch (error) {
      console.log(error);
    } finally {
      setLoadingIdd(null);
    }
  };
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
             
            </div>
          </div>
          {/* <div className="card">
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
          </div> */}
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
       
        <div className="card">
            <div className="card-body">
              <form>
              
                <div className="row">
              
<div className="col-xl-6">   <div className="profile-info">
  <div className="profile-item">
    <span className="profile-label">Tên khách hàng:</span>
    <span className="profile-value">{appointments.user_name}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Tên bác sĩ:</span>
    <span className="profile-value">{appointments.doctor_name}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Dịch vụ:</span>
    <span className="profile-value">{appointments.service_name}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Ca:</span>
    <span className="profile-value">{appointments.shift_name}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Ngày đặt lịch:</span>
    <span className="profile-value">{formatDate(appointments.appointment_created_at)}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Lịch khám:</span>
    <span className="profile-value">{formatShiftTime(appointments.shift_name)}</span>
    <span className="profile-value">{formatDate(appointments.date)}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Tổng tiền:</span>
    <span className="profile-value">{formatCurrency(appointments.total_amount)}</span>
  </div>
  <div className="profile-item">
    <span className="profile-label">Ghi chú:</span>
    <span className="profile-value">{appointments.description}</span>
  </div>
</div>
</div>
<div className="col-xl-6">     {appointments.doctor_image ? (
             <div className="profile-img d-flex justify-content-center align-items-center">
             <img src={appointments.doctor_image} alt="User Image" className="rounded-0"
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

export default AcceptDetailAppointment