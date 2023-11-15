import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useEffect, useState } from "react";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import ReactPaginate from "react-paginate";
import LoadingSkeleton from "../Loading";
import axios from "axios";
import { FaSpinner } from 'react-icons/fa';
import { Modal, Form, Input, Button} from 'antd';
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);


const Appointments = () => {
  const [appointments, setAppointment] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [loading, setLoading] = useState(true);
  const [loadingIddd, setLoadingIddd] = useState(null);
  const [loadingIdd, setLoadingIdd] = useState(null);
  const [loadingId, setLoadingId] = useState(null);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [reason, setReason] = useState("");
  const [error, setError] = useState(false);
  const [selectedAppointmentId, setSelectedAppointmentId] = useState(null);
  const appointmentsPerPage = 5;
  const pagesVisited = pageNumber * appointmentsPerPage;
  const token = localStorage.getItem("token");

  const DataSet = [
    {
      columns: [
        {
          title: "Tên khách hàng",
          style: { font: { sz: "18", bold: true } },
          width: { wpx: 125 },
        },
        {
          title: "Ca",
          style: { font: { sz: "18", bold: true } },
          width: { wch: 30 },
        },
        {
          title: "Ngày",
          style: { font: { sz: "18", bold: true } },
          width: { wpx: 100 },
        },
        {
          title: "Số điện thoại",
          style: { font: { sz: "18", bold: true } },
          width: { wpx: 125 },
        },
        {
          title: "Trạng thái",
          style: { font: { sz: "18", bold: true } },
          width: { wpx: 100 },
        },
      ],
      data: appointments.map((data) => [
        { value: data.user.name, style: { font: { sz: "14" } } },
        { value: data.shift_name, style: { font: { sz: "14" } } },
        {
          value: data.date,
          style: {
            font: { color: { rgb: "ffffff" } },
            fill: { patternType: "solid", fgColor: { rgb: "3461eb" } },
          },
        },
        {
          value: data.user.phone,
          style: {
            font: { color: { rgb: "ffffff" } },
            fill: { patternType: "solid", fgColor: { rgb: "eb1207" } },
          },
        },
        {
          value: data.status,
          style: {
            font: { color: { rgb: "ffffff" } },
            fill: { patternType: "solid", fgColor: { rgb: "4bd909" } },
          },
        },
      ]),
    },
  ];

  const fetchAppointment = async () => {
    try {
      const response = await appointmentsApi.getAll({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setAppointment(response.data);
      console.log(response.data);
      setLoading(false);
      setError(false);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
      setAppointment([]);
      setLoading(false);
      setError(true);
    }
  };
  // console.log(appointments);
  useEffect(() => {
    fetchAppointment();
  }, []);

  const handleUpdate = async (id) => {
    setLoadingId(id);
    console.log(id);
    try {
      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=4`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      MySwal.fire({
        title: "Cuộc hẹn đã hoàn thành!",
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
    setSelectedAppointmentId(id);
    setIsModalVisible(true);
  };

  const handleCancelStatus = async (id, reason) => {
    try {
      setLoadingIdd(id);

      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=4&reason_cancel=${reason}`,
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
  const handleRescheduleStatus = async (id, reason) => {
    try {
      setLoadingIddd(id);

      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=7&reason_change=${reason}`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      setIsModalVisible(false);

      MySwal.fire({
        title: "Yêu cầu đổi lịch đã được gửi đi!",
        icon: "success",
      });
      fetchAppointment();
    } catch (error) {
      console.log(error);
    } finally {
      setLoadingIddd(null);
    }
  };
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "vi-VN",
        options
      );
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
        <td>
          <span className="d-block text-info">{appointment.shift_name}</span>
          <span className="d-block ">
            {formatShiftTime(appointment.shift_name)}
          </span>
          <span className="d-block ">{formatDate(appointment.date)}</span>
        </td>

        <td>{appointment.user.phone}</td>
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
          ) : appointment.status == 7 ? (
            <span className="badge rounded-pill bg-info-light">
              Yêu cầu đổi lịch
            </span>
          ) : (
            <span className="badge rounded-pill bg-info-light">
              Không xác định
            </span>
          )}
        </td>
        {appointment.status == 1 && (
          <td>
            <div className="table-action">
              <Link
                to={`/doctors/accept-detail-appointments/${appointment.id}`}
                className="btn btn-sm bg-info-light"
              >
                <i className="far fa-eye" /> Lịch Hẹn
              </Link>
              <Link
                to={
                  appointment.bill[0]?.id
                    ? `/doctors/detail-bill/${appointment.bill[0].id}`
                    : "#"
                }
                className="btn btn-sm bg-info-light"
              >
                <i className="far fa-eye" /> Hóa Đơn
              </Link>
              <Link
                to={
                  appointment.bill[0]?.id
                    ? `/doctors/edit-bill/${appointment.bill[0].id}`
                    : "#"
                }
                className="btn btn-sm bg-success-light"
              >
                <i className="fas fa-edit" /> Sửa Hóa Đơn
              </Link>

              <Link>
                <div
                  onClick={() => showModal(appointment.id)}
                  className="btn btn-sm bg-danger-light position-relative"
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
              </Link>
              <Link>
                <div
                  onClick={() => showModal(appointment.id)}
                  className="btn btn-sm bg-success-light"
                >
                  {loadingIddd === appointment.id ? (
                    <div className="loading-spinner">
                      <FaSpinner className="spinner" /> Y/C Đổi Lịch
                    </div>
                  ) : (
                    <>
                      <i className="fas fa-edit" /> Y/C Đổi Lịch
                    </>
                  )}
                </div>
              </Link>
              <Link>
                <div
                  className="btn btn-sm bg-success-light"
                  onClick={() => handleUpdate(appointment.id)}
                >
                  {loadingId === appointment.id ? (
                    <div className="loading-spinner">
                      <FaSpinner className="spinner" /> Hoàn thành
                    </div>
                  ) : (
                    <>
                      <i className="fas fa-check me-2" /> Hoàn thành
                    </>
                  )}
                </div>
              </Link>
            </div>
            <Modal
              title="Yêu cầu Hủy Lịch"
              visible={isModalVisible}
              onCancel={() => setIsModalVisible(false)}
              footer={[
                <Button key="cancel" onClick={() => setIsModalVisible(false)}>
                  Cancel
                </Button>,
              ]}
            >
              <Form
                onFinish={(values) => {
                  handleCancelStatus(selectedAppointmentId, values.content);
                }}
              >
                <Form.Item
                  name="content"
                  rules={[
                    {
                      required: true,
                      message: "Vui lòng nhập lí do hủy cuộc hẹn!",
                    },
                    {
                      min: 6,
                      message: "Lí do hủy phải có ít nhất 6 ký tự!",
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
            <Modal
              title="Yêu cầu Đổi Lịch"
              visible={isModalVisible}
              onCancel={() => setIsModalVisible(false)}
              footer={[
                <Button key="cancel" onClick={() => setIsModalVisible(false)}>
                  Cancel
                </Button>,
              ]}
            >
              <Form
                onFinish={(values) => {
                  handleRescheduleStatus(selectedAppointmentId, values.content);
                }}
              >
                <Form.Item
                  name="content"
                  rules={[
                    {
                      required: true,
                      message: "Vui lòng nhập lí do đổi lịch!",
                    },
                    {
                      min: 6,
                      message: "Lí do đổi lịch phải có ít nhất 6 ký tự!",
                    },
                  ]}
                >
                  <Input.TextArea
                    placeholder="Nhập lí do đổi lịch tại đây"
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
          </td>
        )}

        {appointment.status != 1 && (
          <td>
            <div className="table-action">
              <Link
                to={`/doctors/accept-detail-appointments/${appointment.id}`}
                className="btn btn-sm bg-info-light"
              >
                <i className="far fa-eye" /> Lịch Hẹn
              </Link>

              <Link
                to={
                  appointment.bill[0]?.id
                    ? `/doctors/detail-bill/${appointment.bill[0].id}`
                    : "#"
                }
                className="btn btn-sm bg-info-light"
              >
                <i className="far fa-eye" /> Hóa Đơn
              </Link>
            </div>
          </td>
        )}
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
                        ) : error ? (
                          <tr>
                            <td colSpan="5" className="empty-appointments">
                              Hiện tại chưa có lịch hẹn nào đã xác nhận
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
