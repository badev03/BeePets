import React from "react";
import { Link } from "react-router-dom";
import Menudashboard from "./Menu-dashboard";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import axios from "axios";
import { FaSpinner } from "react-icons/fa";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import LoadingSkeleton from "../Loading";
import { Modal, Form, Input, Button } from "antd";

const MySwal = withReactContent(Swal);

const AcceptDetailAppointment = () => {
  const { id } = useParams();
  const [appointments, setAppointments] = useState(null);

  const token = localStorage.getItem("token");
  const [loadingId, setLoadingId] = useState(null);
  const [loadingIdd, setLoadingIdd] = useState(null);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [reason, setReason] = useState("");
  const [selectedAppointmentId, setSelectedAppointmentId] = useState(null);

  const fetchAppointment = async () => {
    try {
      const response = await appointmentsApi.getAcceptAppointment(id, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
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
        `https://beepets.id.vn/api/update-appointment/${id}?status=1`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
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

  const handleSuccess = async (id) => {
    setLoadingId(id);
    try {
      const respon = await axios.put(
        `https://beepets.id.vn/api/update-appointment/${id}?status=4`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
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
        `https://beepets.id.vn/api/update-appointment/${id}?status=6&reason_cancel=${reason}`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
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
        options
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
                      <Link to="/">Trang chủ</Link>
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
              <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">
                <div className="card widget-profile pat-widget-profile">
                  <div className="card-body">
                    <Menudashboard />
                  </div>
                </div>
              </div>
              <div className="col-md-7 col-lg-8 col-xl-9">
                <div className="card">
                  <div className="card-body">
                    <form>
                      <div className="row">
                        <div className="col-xl-6">
                          {" "}
                          <div className="profile-info">
                            <div className="profile-item">
                              <span className="profile-label">
                                Tên khách hàng:
                              </span>
                              <span className="profile-value">
                                {appointments.user_name}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Tên bác sĩ:</span>
                              <span className="profile-value">
                                {appointments.doctor_name}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Dịch vụ:</span>
                              <span className="profile-value">
                                {appointments.service_name}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Ca:</span>
                              <span className="profile-value">
                                {appointments.shift_name}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">
                                Ngày đặt lịch:
                              </span>
                              <span className="profile-value">
                                {formatDate(
                                  appointments.appointment_created_at
                                )}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Lịch khám:</span>
                              <span className="profile-value">
                                {formatShiftTime(appointments.shift_name)}
                              </span>
                              <span className="profile-value">
                                {formatDate(appointments.date)}
                              </span>
                            </div>
                            {appointments.total_amount ? (
                              <div className="profile-item">
                                <span className="profile-label">
                                  Tổng tiền:
                                </span>
                                <span className="profile-value">
                                  {formatCurrency(appointments.total_amount)}
                                </span>
                              </div>
                            ) : null}
                            <div className="profile-item">
                              <span className="profile-label">Ghi chú:</span>
                              <span className="profile-value">
                                {appointments.description}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Trạng thái:</span>
                              <span className="profile-value">
                                {appointments.appointment_status == 1 ? (
                                  <span className="badge rounded-pill bg-success-light">
                                    Xác nhận
                                  </span>
                                ) : appointments.appointment_status == 0 ? (
                                  <span className="badge rounded-pill bg-warning-light">
                                    Chờ xác nhận
                                  </span>
                                ) : appointments.appointment_status == 2 ? (
                                  <span className="badge rounded-pill bg-danger-light">
                                    Đã xóa
                                  </span>
                                ) : appointments.appointment_status == 4 ? (
                                  <span className="badge rounded-pill bg-primary-light">
                                    Đã hoàn thành
                                  </span>
                                ) : appointments.appointment_status == 3 ? (
                                  <span className="badge rounded-pill bg-danger-light">
                                    Đã hủy
                                  </span>
                                ) : appointments.appointment_status == 6 ? (
                                  <span className="badge rounded-pill bg-warning-light">
                                    Yêu cầu hủy
                                  </span>
                                ) : appointments.appointment_status == 7 ? (
                                  <span className="badge rounded-pill bg-info-light">
                                    Yêu cầu đổi lịch
                                  </span>
                                ) : (
                                  <span className="badge rounded-pill bg-info-light">
                                    Không xác định
                                  </span>
                                )}
                              </span>
                              <br />
                            </div>
                          </div>
                        </div>

                        <div className="col-xl-6">
                          {" "}
                          {appointments.doctor_image ? (
                            <div className="profile-img d-flex justify-content-center align-items-center">
                              <img
                                src={appointments.doctor_image}
                                alt="User Image"
                                className="rounded-0"
                                style={{
                                  width: "50%",
                                  border: "none",
                                  marginBottom: "20px",
                                }}
                              />
                            </div>
                          ) : (
                            <div className="profile-img d-flex justify-content-center align-items-center">
                              <img
                                src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg"
                                alt="User Image"
                                className="rounded-0"
                                style={{
                                  width: "50%",
                                  border: "none",
                                  marginBottom: "20px",
                                }}
                              />
                            </div>
                          )}
                        </div>

                        <div
                          className="profile-item"
                          style={{ marginTop: "20px" }}
                        >
                          <span
                            className="profile-value ms-0"
                            style={{ width: "100%" }}
                          >
                            <div className="table-action d-flex">
                              {/* Xác nhận Button */}
                              <Link
                                style={{ color: "white", marginRight: "10px" }}
                                to={`/doctors/appointments`}
                              >
                                <button
                                  type="submit"
                                  className="btn btn-sm bg-success-light position-relative"
                                >
                                  Quay Lại
                                </button>
                              </Link>
                              {appointments.appointment_status == 1 ? (
                                <>
                                  <div
                                    onClick={() => showModal(appointments.id)}
                                    className={`btn btn-sm bg-danger-light position-relative`}
                                  >
                                    {loadingIdd === appointments.id ? (
                                      <div className="loading-spinner">
                                        <FaSpinner className="spinner" /> Y/C
                                        Hủy
                                      </div>
                                    ) : (
                                      <>
                                        <i className="fas fa-times" /> Y/C Hủy
                                      </>
                                    )}
                                  </div>

                                  <div
                                    onClick={() =>
                                      handleSuccess(appointments.id)
                                    }
                                    className={`btn btn-sm bg-info-light position-relative ms-2`}
                                    style={{
                                      marginRight: "10px",
                                      display: "inline-block",
                                    }}
                                  >
                                    {loadingId === appointments.id ? (
                                      <div className="loading-spinner ">
                                        <FaSpinner className="spinner" /> Hoàn
                                        thành
                                      </div>
                                    ) : (
                                      <>
                                        <i className="fas fa-check me-2" /> Hoàn
                                        thành
                                      </>
                                    )}
                                  </div>
                                  <Link
                                    to={`/doctors/edit-bill/${id}`}
                                    className="btn btn-sm bg-info-light"
                                  >
                                    <i className="far fa-eye" /> Sửa Hóa Đơn
                                  </Link>
                                </>
                              ) : appointments.appointment_status == 0 ? (
                                <>
                                  <div
                                    onClick={() =>
                                      handleUpdate(appointments.id)
                                    }
                                    className={`btn btn-sm bg-info-light position-relative`}
                                    style={{
                                      marginRight: "10px",
                                    }}
                                  >
                                    {loadingId === appointments.id ? (
                                      <div className="loading-spinner ">
                                        <FaSpinner className="spinner" /> Xác
                                        nhận
                                      </div>
                                    ) : (
                                      <>
                                        <i className="fas fa-check me-2" /> Xác
                                        nhận
                                      </>
                                    )}
                                  </div>
                                  <div
                                    onClick={() => showModal(appointments.id)}
                                    className={`btn btn-sm bg-danger-light position-relative`}
                                  >
                                    {loadingIdd === appointments.id ? (
                                      <div className="loading-spinner">
                                        <FaSpinner className="spinner" /> Y/C
                                        Hủy
                                      </div>
                                    ) : (
                                      <>
                                        <i className="fas fa-times" /> Y/C Hủy
                                      </>
                                    )}
                                  </div>
                                </>
                              ) : (
                                <></>
                              )}
                            </div>
                          </span>
                          <Modal
                            title="Yêu cầu Hủy Lịch"
                            visible={isModalVisible}
                            onCancel={() => setIsModalVisible(false)}
                            footer={[
                              <Button
                                key="cancel"
                                onClick={() => setIsModalVisible(false)}
                              >
                                Huỷ
                              </Button>,
                            ]}
                          >
                            <Form
                              onFinish={(values) => {
                                handleCancelStatus(
                                  selectedAppointmentId,
                                  values.content
                                );
                              }}
                            >
                              {/* Thêm các trường form tại đây */}
                              <Form.Item
                                name="content"
                                rules={[
                                  {
                                    required: true,
                                    message:
                                      "Vui lòng nhập lí do hủy cuộc hẹn!",
                                  },
                                  {
                                    min: 6,
                                    message:
                                      "Lí do hủy phải có ít nhất 6 ký tự!",
                                  },
                                ]}
                              >
                                <Input.TextArea
                                  placeholder="Nhập lí do hủy cuộc hẹn tại đây"
                                  autoSize={{ minRows: 3, maxRows: 5 }}
                                  onChange={(e) => setReason(e.target.value)}
                                />
                              </Form.Item>
                              <Form.Item>
                                <Button type="primary" htmlType="submit">
                                  Gửi Yêu cầu
                                </Button>
                              </Form.Item>
                            </Form>
                          </Modal>
                        </div>
                      </div>
                    </form>
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

export default AcceptDetailAppointment;
