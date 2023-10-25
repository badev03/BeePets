import React from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useEffect, useState } from "react";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import { Select } from 'antd';
import axios from "axios";
import ReactPaginate from "react-paginate";
import { FaSpinner } from 'react-icons/fa';
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);
const OPTIONS = ['Ca 1', 'Ca 2', 'Ca 3'];

const handleChange = (value) => {
  console.log(`selected ${value}`);
};
const Dashboarddoctors = () => {
  const [appointments, setAppointment] = useState([]);
  const [searchName, setSearchName] = useState('');
  const [searchDate, setSearchDate] = useState('');
  const [searchShift, setSearchShift] = useState('');
  const [searchService, setSearchService] = useState('');
  // const navigate = useNavigate()
  const [selectedItems, setSelectedItems] = useState([]);
  const [loadingId, setLoadingId] = useState(null);
  const [loadingIdd, setLoadingIdd] = useState(null);
  const filteredOptions = OPTIONS.filter((o) => !selectedItems.includes(o));
  const token = localStorage.getItem("token");

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
  const filteredAppointments = appointments.filter((appointment) => {
    return (
      appointment.user.name.toLowerCase().includes(searchName.toLowerCase()) &&
      appointment.date.toLowerCase().includes(searchDate.toLowerCase()) &&
      appointment.shift_name.toLowerCase().includes(searchShift.toLowerCase()) &&
      appointment.service.name.toLowerCase().includes(searchService.toLowerCase())
    );
  });
  const displayAppointments = filteredAppointments
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
                className="btn btn-sm bg-success-light position-relative"
              >
                {loadingId === appointment.id ? (
                  <div className="loading-spinner">
                  <FaSpinner className="spinner" /> Accept
                </div>
                ) : (
                  <>
                    <i className="fas fa-check me-2" /> Accept
                  </>
                )}
              </div>
            <div
              onClick={() => handleCancel(appointment.id)}
              className="btn btn-sm bg-danger-light position-relative"
            >
               {loadingIdd === appointment.id ? (
                  <div className="loading-spinner">
                  <FaSpinner className="spinner" /> Cancel
                </div>
                ) : (
                  <>
                  <i className="fas fa-times" /> Cancel

                  </>
                )}
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
    }finally {
      setLoadingId(null);
    }
  };
  const handleCancel = async (id) => {
    try {
      setLoadingIdd(id);

      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=2`,
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
    }finally {
      setLoadingIdd(null);
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
                    <Select
                        mode="multiple"
                        placeholder="Inserted are removed"
                        value={selectedItems}
                        onChange={setSelectedItems}
                        style={{ width: '100%' }}
                        options={filteredOptions.map((item) => ({
                          value: item,
                          label: item,
                        }))}
                      />
                      {/* <input
                        type="text"
                        id="searchShift"
                        placeholder="Lọc theo ca"
                        onChange={(e) => setSearchShift(e.target.value)}
                        className="input-group-item"
                      /> */}
                    </div>

                    <div className="input-group">
                      
                      <input
                        type="text"
                        id="searchService"
                        placeholder="Lọc theo dịch vụ"
                        onChange={(e) => setSearchService(e.target.value)}
                        className="input-group-item"
                      />
                    </div>
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
