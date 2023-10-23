import React from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useEffect, useState } from "react";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";

import axios from "axios";
import ReactPaginate from "react-paginate";
const Dashboarddoctors = () => {
  const [appointments, setAppointment] = useState([]);
  // const navigate = useNavigate()
  const token = localStorage.getItem("token");
  console.log(appointments);

  const fetchAppointment = async () => {
    try {
      const response = await appointmentsApi.getStatus({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setAppointment(response.data);
      // console.log(response.data);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
      setAppointment([]);
    }
  };

  useEffect(() => {
    fetchAppointment();
  }, []);
  const [pageNumber, setPageNumber] = useState(0);
  const appointmentsPerPage = 5;
  const pagesVisited = pageNumber * appointmentsPerPage;
  const displayAppointments = appointments
    .slice(pagesVisited, pagesVisited + appointmentsPerPage)
    .map((appointment) => (
      <tr key={appointment.id}>
        <td>
          <h2 className="table-avatar">
            <Link to="patient-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src="img/patients/patient.jpg"
                alt="User Image"
              />
            </Link>
            <Link to="patient-profile.html">{appointment.user.name} </Link>
          </h2>
        </td>
        <td>
          {appointment.date}
          <span className="d-block text-info">{appointment.shift_name}</span>
        </td>
        <td>{appointment.service.name}</td>
        <td>{appointment.type_pet.name}</td>
        <td>
          <div className="table-action">
            <Link
              to={`/doctors/detail-appointments/${appointment.id}`}
              className="btn btn-sm bg-info-light"
            >
              <i className="far fa-eye" /> View
            </Link>
            <div
              onClick={() => handleUpdate(appointment.id)}
              className="btn btn-sm bg-success-light"
            >
              <i className="fas fa-check" /> Accept
            </div>
            <div
              onClick={() => handleCancel(appointment.id)}
              className="btn btn-sm bg-danger-light"
            >
              <i className="fas fa-times" /> Cancel
            </div>
          </div>
        </td>
      </tr>
    ));

  const pageCount = Math.ceil(appointments.length / appointmentsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

  const handleUpdate = async (id) => {
    try {
      console.log(id);
      console.log(token);
      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=1`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        },
      );
      console.log(respon);

      fetchAppointment();
    } catch (error) {
      console.log(error);
    }
  };
  const handleCancel = async (id) => {
    try {
      console.log(id);
      console.log(token);
      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=2`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        },
      );
      console.log(respon);

      fetchAppointment();
    } catch (error) {
      console.log(error);
    }
  };

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
                  <div className="card dash-card">
                    <div className="card-body">
                      <div className="row">
                        <div className="col-md-12 col-lg-4">
                          <div className="dash-widget dct-border-rht">
                            <div className="circle-bar circle-bar1">
                              <div className="circle-graph1" data-percent={75}>
                                <img
                                  src="/img/icon-01.png"
                                  className="img-fluid"
                                  alt="patient"
                                />
                              </div>
                            </div>
                            <div className="dash-widget-info">
                              <h6>Tổng số bệnh nhân</h6>
                              <h3>1500</h3>
                              <p className="text-muted">cho đến nay</p>
                            </div>
                          </div>
                        </div>
                        <div className="col-md-12 col-lg-4">
                          <div className="dash-widget dct-border-rht">
                            <div className="circle-bar circle-bar2">
                              <div className="circle-graph2" data-percent={65}>
                                <img
                                  src="/img/icon-02.png"
                                  className="img-fluid"
                                  alt="Patient"
                                />
                              </div>
                            </div>
                            <div className="dash-widget-info">
                              <h6>Bệnh nhân hôm nay</h6>
                              <h3>160</h3>
                              <p className="text-muted">21/06/2003</p>
                            </div>
                          </div>
                        </div>
                        <div className="col-md-12 col-lg-4">
                          <div className="dash-widget">
                            <div className="circle-bar circle-bar3">
                              <div className="circle-graph3" data-percent={50}>
                                <img
                                  src="/img/icon-03.png"
                                  className="img-fluid"
                                  alt="Patient"
                                />
                              </div>
                            </div>
                            <div className="dash-widget-info">
                              <h6>Lịch đặt</h6>
                              <h3>85</h3>
                              <p className="text-muted">21/06/2003</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-12">
                  <h4 className="mb-4">Lịch hẹn của bệnh nhân</h4>
                  <div className="appointment-tab">
                    <ul className="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                      <li className="nav-item">
                        <Link
                          className="nav-link active"
                          to="#upcoming-appointments"
                          data-bs-toggle="tab"
                        >
                          Lịch hẹn sắp tới
                        </Link>
                      </li>
                    </ul>
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
                                    <th>Dịch vụ</th>
                                    <th>Loại thú cưng</th>
                                    <th>Trạng thái</th>
                                  </tr>
                                </thead>
                                <tbody>{displayAppointments}</tbody>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboarddoctors;
