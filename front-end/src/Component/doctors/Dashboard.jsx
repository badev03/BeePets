import React from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useEffect, useState } from "react";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import axios from "axios";
import ReactPaginate from "react-paginate";
import { FaSpinner } from "react-icons/fa";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import LoadingSkeleton from "../Loading";
import { Modal, Form, Input, Button, Dropdown, Menu } from "antd";

const MySwal = withReactContent(Swal);

const Dashboarddoctors = () => {
  const [appointments, setAppointment] = useState([]);
  const [searchName, setSearchName] = useState("");
  const [searchDate, setSearchDate] = useState("");
  const [searchShift, setSearchShift] = useState("");
  const [searchService, setSearchService] = useState("");
  const [loadingId, setLoadingId] = useState(null);
  const [loadingIdd, setLoadingIdd] = useState(null);
  const [loading, setLoading] = useState(true);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [error, setError] = useState(false);
  const token = localStorage.getItem("token");
  // const [cancelId, setCancelId] = useState(null);
  const [reason, setReason] = useState("");
  const [selectedAppointmentId, setSelectedAppointmentId] = useState(null);
  const handleCancel = () => {
    setIsModalVisible(false);
  };
  const fetchAppointment = async () => {
    try {
      const response = await appointmentsApi.getStatus({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setAppointment(response.data);
      console.log(response);
      setLoading(false);
      setError(false);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
      setAppointment([]);
      setLoading(false);
      setError(true);
    }
  };

  useEffect(() => {
    fetchAppointment();
  }, []);
  const [pageNumber, setPageNumber] = useState(0);
  const appointmentsPerPage = 5;
  const pagesVisited = pageNumber * appointmentsPerPage;
  const filteredAppointments = appointments.filter((appointment) => {
    return (
      appointment.user.name.toLowerCase().includes(searchName.toLowerCase()) &&
      appointment.date.toLowerCase().includes(searchDate.toLowerCase()) &&
      appointment.shift_name
        .toLowerCase()
        .includes(searchShift.toLowerCase()) &&
      appointment.service.name
        .toLowerCase()
        .includes(searchService.toLowerCase())
    );
  });

  const pageCount = Math.ceil(appointments.length / appointmentsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

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
  const displayAppointments = filteredAppointments
    .slice(pagesVisited, pagesVisited + appointmentsPerPage)
    .map((appointment) => (
      <tr key={appointment.id}>
        <td>
          <h2 className="table-avatar">
            <Link to="patient-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src={
                  appointment.user.avatar
                    ? appointment.user.avatar
                    : "https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg"
                }
                alt="User Image"
              />
            </Link>
            <Link to="patient-profile.html">{appointment.user.name} </Link>
          </h2>
        </td>
        <td>
          <span className="d-block text-info">{appointment.shift_name}</span>
          <span className="d-block ">
            {formatShiftTime(appointment.shift_name)}
          </span>
          <span className="d-block ">{formatDate(appointment.date)}</span>
        </td>
        {/*<td>{appointment.service.name}</td>*/}
        <td>{appointment.type_pet.name}</td>
        <td>
          {appointment.status == 1 ? (
            <span className="badge rounded-pill bg-success-light">
              Xác nhận
            </span>
          ) : appointment.status == 2 ? (
            <span className="badge rounded-pill bg-danger-light">Đã xóa</span>
          ) : appointment.status == 4 ? (
            <span className="badge rounded-pill bg-primary-light">
              Đã hoàn thành
            </span>
          ) : appointment.status == 3 ? (
            <span className="badge rounded-pill bg-danger-light">Đã hủy</span>
          ) : appointment.status == 6 ? (
            <span className="badge rounded-pill bg-warning-light">
              Yêu cầu hủy
            </span>
          ) : appointment.status == 0 ? (
            <span className="badge rounded-pill bg-warning-light">
              Chờ xác nhận
            </span>
          ) : (
            <span className="badge rounded-pill bg-info-light">
              Không xác định
            </span>
          )}
        </td>
        <td>
          <div className="table-action">
            <Dropdown
              overlay={
                <Menu>
                  <Menu.Item>
                    <Link
                      to={`/doctors/detail-appointments/${appointment.id}`}
                      className="btn btn-sm bg-info-light"
                      style={{ width: "100%" }}
                    >
                      <i className="far fa-eye" /> Xem Lịch Hẹn
                    </Link>
                  </Menu.Item>
                  <Menu.Item>
                    <div
                      onClick={() => handleUpdate(appointment.id)}
                      className="btn btn-sm bg-success-light position-relative"
                      style={{ width: "100%" }}
                    >
                      {loadingId === appointment.id ? (
                        <div className="loading-spinner">
                          <FaSpinner className="spinner" /> Chấp nhận
                        </div>
                      ) : (
                        <>
                          <i className="fas fa-check me-2" /> Chấp nhận
                        </>
                      )}
                    </div>
                  </Menu.Item>
                  <Menu.Item>
                    <div
                      onClick={() => showModal(appointment.id)}
                      className="btn btn-sm bg-danger-light position-relative"
                      style={{ width: "100%" }}
                    >
                      {loadingIdd === appointment.id ? (
                        <div className="loading-spinner">
                          <FaSpinner className="spinner" /> Y/C Hủy
                        </div>
                      ) : (
                        <>
                          <i className="fas fa-times" /> Y/C Hủy
                        </>
                      )}
                    </div>
                  </Menu.Item>
                </Menu>
              }
            >
              <a
                className="btn btn-sm bg-info-light"
                onClick={(e) => e.preventDefault()}
              >
                Hành động
              </a>
            </Dropdown>
          </div>
        </td>
      </tr>
    ));
  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Bảng điều khiển</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Trang chủ</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Bảng điều khiển
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
              <div className="row">
                <div className="col-md-12">
                  <h4 className="mb-4">Lịch hẹn của bệnh nhân</h4>
                  <div className="appointment-tab">
                    <div className="search-container">
                      <div className="input-group">
                        <input
                          type="text"
                          id="searchName"
                          placeholder="Lọc theo tên"
                          onChange={(e) => setSearchName(e.target.value)}
                          className="input-group-item"
                        />
                      </div>

                      <div className="input-group">
                        <input
                          type="text"
                          id="searchDate"
                          placeholder="Lọc theo ngày"
                          onChange={(e) => setSearchDate(e.target.value)}
                          className="input-group-item"
                        />
                      </div>

                      <div className="input-group">
                        <input
                          type="text"
                          id="searchShift"
                          placeholder="Lọc theo ca"
                          onChange={(e) => setSearchShift(e.target.value)}
                          className="input-group-item"
                        />
                      </div>

                      {/*<div className="input-group">*/}
                      {/*  <input*/}
                      {/*    type="text"*/}
                      {/*    id="searchService"*/}
                      {/*    placeholder="Lọc theo dịch vụ"*/}
                      {/*    onChange={(e) => setSearchService(e.target.value)}*/}
                      {/*    className="input-group-item"*/}
                      {/*  />*/}
                      {/*</div>*/}
                    </div>
                    <div className="tab-content">
                      <div
                        className="tab-pane show active"
                        id="upcoming-appointments"
                      >
                        <div className="card card-table mb-0">
                          <div className="card-body">
                            <div className="table-responsive">
                              <table className="table table-hover table-center mb-0">
                                <thead>
                                  <tr>
                                    <th>Tên bệnh nhân</th>
                                    <th>Thời gian</th>
                                    {/*<th>Dịch vụ</th>*/}
                                    <th>Loại thú cưng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  {loading ? (
                                    <tr>
                                      <td colSpan="5">
                                        <LoadingSkeleton />
                                      </td>
                                    </tr>
                                  ) : error ? (
                                    <tr>
                                      <td
                                        colSpan="5"
                                        className="empty-appointments"
                                      >
                                        Hiện tại chưa có lịch hẹn nào cần xác
                                        nhận
                                      </td>
                                    </tr>
                                  ) : filteredAppointments.length == 0 ? (
                                    <tr>
                                      <td
                                        colSpan="5"
                                        className="empty-appointments"
                                      >
                                        Không có dữ liệu phù hợp với tìm kiếm
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
                                  {filteredAppointments.length > 0 && (
                                    <ReactPaginate
                                      nextLabel={<FaChevronRight />}
                                      previousLabel={<FaChevronLeft />}
                                      pageCount={pageCount}
                                      onPageChange={changePage}
                                      containerClassName={"pagination"}
                                      previousLinkClassName={"previousBttn"}
                                      activeClassName={"active"}
                                    />
                                  )}
                                  <Modal
                                    title="Yêu cầu Hủy Lịch"
                                    visible={isModalVisible}
                                    onCancel={() => setIsModalVisible(false)}
                                    footer={[
                                      <Button
                                        key="cancel"
                                        onClick={() => setIsModalVisible(false)}
                                      >
                                        Cancel
                                      </Button>,
                                    ]}
                                  >
                                    <Form
                                      onFinish={(values) => {
                                        handleCancelStatus(
                                          selectedAppointmentId,
                                          values.content
                                        );
                                        // console.log('Received values of form: ', reason,selectedAppointmentId);
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
                                          onChange={(e) =>
                                            setReason(e.target.value)
                                          }
                                        />
                                      </Form.Item>
                                      <Form.Item>
                                        <Button
                                          type="primary"
                                          htmlType="submit"
                                        >
                                          Gửi Yêu cầu
                                        </Button>
                                      </Form.Item>
                                    </Form>
                                  </Modal>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboarddoctors;
