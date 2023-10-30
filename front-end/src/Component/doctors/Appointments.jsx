//appoi
import React from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useEffect, useState } from "react";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import ReactPaginate from "react-paginate";
import LoadingSkeleton from "../Loading";
import { Modal, Form, Input, Button } from 'antd';
const Appointments = () => {
  const [appointments, setAppointment] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [loading, setLoading] = useState(true);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const appointmentsPerPage = 5;
  const pagesVisited = pageNumber * appointmentsPerPage;
  const token = localStorage.getItem("token");
  if (token) {
    useEffect(() => {
      const fetchAppointment = async () => {
        try {
          const response = await appointmentsApi.getAll({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setAppointment(response.data);
          setLoading(false);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchAppointment();
    }, []);
  }
  const showModal = () => {
    setIsModalVisible(true);
  };

  const handleCancel = () => {
    setIsModalVisible(false);
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
  const displayAppointments = appointments
    .slice(pagesVisited, pagesVisited + appointmentsPerPage)
    .map((appointment) => (
      <tr key={appointment.id} data={appointment}>
        <td>
          <h2 className="table-avatar">
            <a href="doctor-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src={appointment.user.avatar}
                alt="User Image"
              />
            </a>
            <a href="doctor-profile.html">{appointment.user.name} </a>
          </h2>
        </td>
        <td >
          {/* <span className="d-block text-info">
            {appointment.time ? formatTime(appointment.time) : ''}
          </span> */}
          <span className="d-block text-info">{appointment.shift_name}</span>
          <span className="d-block ">
            {formatShiftTime(appointment.shift_name)}
          </span>
          <span className="d-block ">
          {formatDate(appointment.date)}
          </span>
        </td>
       
        <td>{appointment.user.phone}</td>
        <td>
          {appointment.status == 1 ? (
            <span className="badge rounded-pill bg-success-light">
              Xác nhận
            </span>
          ) : appointment.status == 2 ? (
            <span className="badge rounded-pill bg-danger-light">Đã hủy</span>
          ) : (
            // Optional default case
            <span className="badge rounded-pill bg-info-light">
              Không xác định
            </span>
          )}
        </td>
        <td>
          <div className="table-action">
          <Link to={`/doctors/accept-detail-appointments/${appointment.id}`} className="btn btn-sm bg-info-light">
              <i className="far fa-eye" /> Lịch Hẹn
            </Link>
            <Link
                to={appointment.bill[0]?.id ? `/doctors/detail-bill/${appointment.bill[0].id}` : "#"}
                className="btn btn-sm bg-info-light"
              >
                <i className="far fa-eye" /> Bill
              </Link>
              <Link
                to={appointment.bill[0]?.id ? `/doctors/edit-bill/${appointment.bill[0].id}` : "#"}
                className="btn btn-sm bg-success-light"
              >
                <i className="fas fa-edit" /> Sửa Bill
              </Link>
            
            <Link to="#" className="btn btn-sm bg-danger-light" onClick={showModal}>
              <i className="far fa-trash-alt" />Y/C Hủy Lịch
            </Link>
            <Link
              to={`/doctors/edit-bill/${appointment.id}`}
              className="btn btn-sm bg-success-light"
            >
              <i className="fas fa-edit" />Y/C Đổi Lịch
            </Link>
            <Link
              to={`/doctors/edit-bill/${appointment.id}`}
              className="btn btn-sm bg-success-light"
            >
              <i className="fas fa-edit" />Hoàn Thành
            </Link>
          </div>
          <Modal title="Yêu cầu Hủy Lịch" visible={isModalVisible}   onCancel={() => setIsModalVisible(false)}>
        <Form
         onFinish={(values) => {
          console.log('Received values of form: ', values);
        }}>
          {/* Thêm các trường form tại đây */}
          <Form.Item
      name="content"
      rules={[
        {
          required: true,
          message: 'Vui lòng nhập lí do hủy cuộc hẹn!',
        },
        {
          min: 6,
          message: 'Lí do hủy phải có ít nhất 6 ký tự!',
        },
      ]}
    >
      <Input.TextArea
        placeholder="Nhập lí do hủy cuộc hẹn tại đây"
        autoSize={{ minRows: 3, maxRows: 5 }}
      />
    </Form.Item>
          <Form.Item>
            <Button type="primary" htmlType="submit">
              Gửi Yêu cầu
            </Button>
          </Form.Item>
        </Form>
      </Modal>
        </td>
      </tr>
    ));

  const pageCount = Math.ceil(appointments.length / appointmentsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };
  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Lịch hẹn</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Trang chủ</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Lịch hẹn
                  </li>
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
              <div className="card card-table mb-0">
                <div className="card-body">
                  <div className="table-responsive">
                    <table className="table table-hover table-center mb-0">
                      <thead>
                        <tr>
                          <th>Khách hàng</th>
                          <th>Lịch khám</th>
                          {/* <th> Ngày đặt lịch</th> */}
                          <th>Số điện thoại</th>
                          <th>Trạng thái</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        {loading ? (
                          <tr>
                            <td colSpan="5">
                              <LoadingSkeleton />
                            </td>
                          </tr>
                        ) : (
                          displayAppointments
                        )}
                      </tbody>
                    </table>
                  </div>
                  <div className="row">
                    <div className="col-md-12">
                      <div className="pagination-doctor">
                        <ReactPaginate
                          nextLabel={<FaChevronRight />}
                          previousLabel={<FaChevronLeft />}
                          pageCount={pageCount}
                          onPageChange={changePage}
                          containerClassName={"pagination"}
                          previousLinkClassName={"previousBttn"}
                          activeClassName={"active"}
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Appointments;
