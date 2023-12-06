import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import Sidebar from "./Sidebar";
import axios from "axios";
import LoadingSkeleton from "../Loading";
import TopLink from "../../Link/TopLink";
const AppointmentDetail = () => {
  const [appointments, setAppointments] = useState([]);
  const [isLoading, setIsLoading] = useState(true); // Khởi tạo isLoading
  const { id } = useParams();
  const token = localStorage.getItem("token");

  useEffect(() => {
    if (token) {
      const fetchAppointmentDetail = async () => {
        try {
          const response = await axios.get(
            `http://127.0.0.1:8000/api/get-appointment-user/${id}`,
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setAppointments(response.data.appointment);
          console.log(response);
          setIsLoading(false); // Set isLoading to false when data is fetched
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
      fetchAppointmentDetail();
    }
  }, [id, token]);

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
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "vi-VN",
        options
      );
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace("lúc", "").trim();
    }
    return "";
  }
  return (
    <div>
      {" "}
      <div>
        <div className="breadcrumb-bar-two">
          <div className="container">
            <div className="row align-items-center inner-banner">
              <div className="col-md-12 col-12 text-center">
                <h2 className="breadcrumb-title">Chi tiết lịch khám</h2>
                <nav aria-label="breadcrumb" className="page-breadcrumb">
                  <ol className="breadcrumb">
                    <li className="breadcrumb-item">
                      <a href="index.html">Trang chủ</a>
                    </li>
                    <li className="breadcrumb-item" aria-current="page">
                      Chi tiết lịch khám
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
              <Sidebar />
              <div className="col-md-7 col-lg-8 col-xl-9">
                {isLoading ? (
                  <LoadingSkeleton />
                ) : (
                  <div className="card">

                    <div className="card-body pb-0">
                      <div className="d-flex">
                        <img
                          src="https://res.cloudinary.com/dgr1k5tf5/image/upload/v1697884317/tgaqy9cgyffuneqzysjb.png"
                          alt=""
                          className="img-fluid"
                          style={{ width: '15%' }}
                        />

                        {/* <div className="footer-contact-info">
                                  <div className="footer-address">
                                    <p><i className="feather-map-pin"></i> Cao đẳng fpt</p>
                                  </div>
                                  <div className="footer-address">
                                    <p><i className="feather-phone-call"></i>108101910</p>
                                  </div>
                                  <div className="footer-address mb-0">
                                    <p><i className="feather-mail"></i> <TopLink to="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection" className="__cf_email__" data-cfemail="ee8a818d8d9b9c8bae8b968f839e828bc08d8183">BeePets@fpt.edu.vn</TopLink></p>
                                  </div>
                                </div> */}
                        <div className=" d-flex" style={{ marginLeft: '600px' }}>
                          <span className="mb-2 fw-bolder">
                            Mã cuộc hẹn :{" "}
                          </span>
                          <div className="ms-1">
                            {appointments.appointment_id}
                          </div>
                        </div>
                        {/* <div className="footer-contact-info">
                                  <div className="footer-address">
                                    <p><i className="feather-map-pin"></i> Cao đẳng fpt</p>
                                  </div>
                                  <div className="footer-address">
                                    <p><i className="feather-phone-call"></i>108101910</p>
                                  </div>
                                  <div className="footer-address mb-0">
                                    <p><i className="feather-mail"></i> <TopLink to="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection" className="__cf_email__" data-cfemail="ee8a818d8d9b9c8bae8b968f839e828bc08d8183">BeePets@fpt.edu.vn</TopLink></p>
                                  </div>
                                </div> */}
                      </div>


                      <br />
                      <hr />
                      <h2 className="breadcrumb-title text-center mx-auto">Chi tiết cuộc hẹn</h2>

                      <br />
                      <form>
                        <div className="row">
                          <div className="col-12">
                            <div className="row ms-0">
                              <div className="col-sm-6 ms-0 px-lg-0">
                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Tên bác sĩ :{" "}
                                  </span>
                                  <div className="ms-1">
                                    {appointments.doctor_name}
                                  </div>
                                </div>
                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Dịch vụ :{" "}
                                  </span>
                                  <div className="ms-1">
                                    {appointments.service_name}
                                  </div>
                                </div>
                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Loại thú cưng :{" "}
                                  </span>
                                  <div className="ms-1">
                                    {appointments.type_pet_name}
                                  </div>
                                </div>
                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Ngày đặt lịch :
                                  </span>
                                  <div className="ms-1">
                                    {appointments.date}
                                  </div>
                                </div>
                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Lịch khám :{" "}
                                  </span>
                                  <div className="ms-1">
                                    {formatShiftTime(appointments.shift_name)}
                                  </div>
                                </div>

                                <div className="mb-3 d-flex">
                                  <span className="mb-2 fw-bolder">
                                    Trạng thái :{" "}
                                  </span>
                                  <div className="ms-1">
                                    {
                                      <span className="profile-value">
                                        {appointments.status == 1 ? (
                                          <span className="badge rounded-pill bg-success-light">
                                            Xác nhận
                                          </span>
                                        ) : appointments.status == 0 ? (
                                          <span className="badge rounded-pill bg-warning-light">
                                            Chờ xác nhận
                                          </span>
                                        ) : appointments.status == 2 ? (
                                          <span className="badge rounded-pill bg-danger-light">
                                            Đã xóa
                                          </span>
                                        ) : appointments.status == 4 ? (
                                          <span className="badge rounded-pill bg-primary-light">
                                            Đã hoàn thành
                                          </span>
                                        ) : appointments.status == 3 ? (
                                          <span className="badge rounded-pill bg-danger-light">
                                            Đã hủy
                                          </span>
                                        ) : appointments.status == 6 ? (
                                          <span className="badge rounded-pill bg-warning-light">
                                            Yêu cầu hủy
                                          </span>
                                        ) : appointments.status == 7 ? (
                                          <span className="badge rounded-pill bg-info-light">
                                            Yêu cầu đổi lịch
                                          </span>
                                        ) : (
                                          <span className="badge rounded-pill bg-info-light">
                                            Không xác định
                                          </span>
                                        )}
                                      </span>
                                    }
                                  </div>
                                </div>


                              </div>
                              <div
                                className="col-sm-6 profile-img d-flex justify-content-center align-items-center"
                                style={{ gap: "1rem" }}
                              >
                                {/* <span className="mb-2 fw-bolder ">
                                  Ảnh bác sĩ :{" "}
                                </span> */}
                                <img
                                  src={appointments.doctor_image}
                                  alt="User Image"
                                  className="rounded-0"
                                  style={{ width: '50%', border: 'none', marginBottom: '20px' }}
                                />
                                {/* <div className="footer-contact-info">
                                  <div className="footer-address">
                                    <p><i className="feather-map-pin"></i> Cao đẳng fpt</p>
                                  </div>
                                  <div className="footer-address">
                                    <p><i className="feather-phone-call"></i>108101910</p>
                                  </div>
                                  <div className="footer-address mb-0">
                                    <p><i className="feather-mail"></i> <TopLink to="https://doccure.dreamguystech.com/cdn-cgi/l/email-protection" className="__cf_email__" data-cfemail="ee8a818d8d9b9c8bae8b968f839e828bc08d8183">BeePets@fpt.edu.vn</TopLink></p>
                                  </div>
                                </div> */}
                              </div>
                            </div>
                          </div>
                          <div className="col-12 col-md-12 ms-0">
                            <div className="mb-3 ">
                              {appointments.status == 3 ? (
                                <div>
                                  <span className="mb-2 fw-bolder">
                                    <strong>Lý do hủy</strong>
                                  </span>
                                  <div
                                    className="alert alert-danger"
                                    role="alert"
                                  >
                                    {appointments.reason_cancel}
                                  </div>
                                </div>
                              ) : (
                                <>
                                  <span className="mb-2 fw-bolder">
                                    Ghi chú :
                                  </span>
                                  <span className="profile-value">
                                    {appointments.description}
                                  </span>
                                </>
                              )}
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div className="row ms-2 mb-3">
                      <Link to={`/user/dashbroad`}>
                        {" "}
                        <button type="reset" className="btn btn-success">
                          Quay lại
                        </button>
                      </Link>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AppointmentDetail;
