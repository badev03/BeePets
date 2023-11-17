import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import ReactPaginate from "react-paginate";
import appointmentUsersApi from "../../api/appoinmentsUse";
import BookingApi from "../../api/bookingApi";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import LoadingSkeleton from "../Loading";

const Appointments = () => {
  const [appointments, setAppointments] = useState([]);
  const [typePets, setTypePets] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [pageCount, setPageCount] = useState(0);
  const [isLoading, setIsLoading] = useState(true);
  const itemsPerPage = 5;
  const token = localStorage.getItem("token");

  // const [searchName, setSearchName] = useState("");
  const [typePet, setTypePet] = useState("");
  const [shift, setShift] = useState("");
  const [status, setStatus] = useState("");
  const [selectedDate, setSelectedDate] = useState("");
  const [filteredAppointments, setFilteredAppointments] = useState([]);

  useEffect(() => {
    const fetchAppointments = async () => {
      try {
        const response = await appointmentUsersApi.getHistoryAppoinments({
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
  
        setAppointments(response.appointments);
  
        if (typePet || shift || status || selectedDate) {
          setFilteredAppointments(response.appointments);
        } else {
          setFilteredAppointments(response.appointments);
        }
  
        setPageCount(Math.ceil(response.appointments.length / itemsPerPage));
      } catch (error) {
        console.error("Lỗi lấy dữ liệu:", error);
      } finally {
        setIsLoading(false);
      }
    };
  
    fetchAppointments();
  
  }, [token, typePet, shift, status, selectedDate]);
  

  useEffect(() => {
    const fetchTypePet = async () => {
      try {
        const response = await BookingApi.getTypePet();
        setTypePets(response.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchTypePet();
  }, []);

  const filterAppointments = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      const response = await appointmentUsersApi.filterAppoinment({
        headers: {
          Authorization: `Bearer ${token}`,
        },
        params: {
          typePet,
          shift_name: shift,
          status,
          date: selectedDate,
        },
      });

      setFilteredAppointments(response);
      setPageCount(Math.ceil(response.length / itemsPerPage));
      setIsLoading(false);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }finally {
      setIsLoading(false);
    }
  };

  const resetFilters = () => {
    setTypePet("");
    setShift("");
    setStatus("");
    setSelectedDate("");
  };

  if (isLoading) {
    return <LoadingSkeleton />;
  }
  if (appointments.length === 0) {
    return (
      <div colSpan="5" className="empty-appointments">
        Hiện tại chưa có lịch hẹn nào{" "}
      </div>
    );
  }

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

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
      return formattedDate.replace("lúc", "").trim();
    }
    return "";
  }

  const displayedAppointments = filteredAppointments
    .slice(pageNumber * itemsPerPage, (pageNumber + 1) * itemsPerPage)
    .map((appointment) => (
      <tr key={appointment.appointment_id}>
        <td>
          <h2 className="table-avatar">
            <a href="doctor-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src={appointment.image}
                alt="User Image"
              />
              <span>{appointment.doctor_name}</span>
            </a>
            <a href="doctor-profile.html">{appointment.doctor_id}</a>
          </h2>
        </td>
        <td>
          <span className="d-block text-info">{appointment.shift_name}</span>
          <span className="d-block ">
            {formatShiftTime(appointment.shift_name)}
          </span>
        </td>
        <td>{formatDate(appointment.date)}</td>
        <td>
          {appointment.status == 1 ? (
            <span className="badge rounded-pill bg-success-light">
              Xác nhận
            </span>
          ) : appointment.status == 2 ? (
            <span className="badge rounded-pill bg-danger-light">Đã xóa</span>
          ) : appointment.status == 3 ? (
            <span className="badge rounded-pill bg-primary-light">
              Đã hoàn thành
            </span>
          ) : appointment.status == 4 ? (
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
        <td>
          <div className="table-action">
            <button className="btn btn-sm bg-info-light">
              <Link to={`/user/appointment/${appointment.appointment_id}`}>
                <i className="far fa-eye" /> View
              </Link>
            </button>
          </div>
        </td>
      </tr>
    ));

  return (
    <div id="pat_appointments" className="tab-pane fade show active">
      <div className="card card-table mb-0">
        <div className="card-body">
          <form className="filter-form" onSubmit={filterAppointments}>
            <div className="filter-section">
              {/* <div className="filter-item">
                <label htmlFor="searchName" className="label-text">
                  Lọc theo tên :
                </label>
                <input type="text" id="searchName" className="input-text" />
              </div> */}

              <div className="filter-item">
                <label htmlFor="typePet" className="label-text">
                  Lọc theo loại thú cưng :
                </label>
                <select
                  className="select-dropdown"
                  value={typePet}
                  onChange={(e) => setTypePet(e.target.value)}
                >
                  <option></option>
                  {typePets.map((typePet) => (
                    <option key={typePet.id} value={typePet.name}>
                      {typePet.name}
                    </option>
                  ))}
                </select>
              </div>

              <div className="filter-item">
                <label htmlFor="shift" className="label-text">
                  Lọc theo ca :
                </label>
                <select
                  className="select-dropdown"
                  value={shift}
                  onChange={(e) => setShift(e.target.value)}
                >
                  <option></option>
                  <option value="Ca 1">Ca 1</option>
                  <option value="Ca2">Ca 2</option>
                  <option value="Ca 3">Ca 3</option>
                </select>
              </div>

              <div className="filter-item">
                <label htmlFor="status" className="label-text">
                  Lọc theo trạng thái:
                </label>
                <select
                  className="select-dropdown"
                  value={status}
                  onChange={(e) => setStatus(e.target.value)}
                >
                  <option></option>
                  <option value="1">Xác nhận</option>
                  <option value="2">Đã xóa</option>
                  <option value="3">Đã hoàn thành</option>
                  <option value="4">Đã hủy</option>
                  <option value="6">Yêu cầu hủy</option>
                  <option value="7">Yêu cầu đổi lịch</option>
                  <option value="8">Không xác định</option>
                </select>
              </div>
              <div className="filter-item">
                <label htmlFor="date" className="label-text">
                  Chọn ngày:
                </label>
                <input
                  type="date"
                  id="date"
                  className="input-text"
                  value={selectedDate}
                  onChange={(e) => setSelectedDate(e.target.value)}
                />
              </div>
            </div>

            <button
              type="submit"
              className="btn btn-sm bg-success-light"
              style={{ marginRight: "10px" }}
            >
              Lọc dữ liệu
            </button>
            <button
              type="button"
              className="btn btn-sm bg-danger-light"
              onClick={resetFilters}
            >
              Làm mới dữ liệu
            </button>
          </form>
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Bác sĩ</th>
                  <th>Lịch khám</th>
                  <th> Ngày đặt lịch</th>
                  <th>Trạng thái</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {displayedAppointments.length > 0 ? (
                  displayedAppointments
                ) : (
                  <tr>
                    <td colSpan="5">Không có kết quả phù hợp</td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>
        <ReactPaginate
          nextLabel={<FaChevronRight />}
          previousLabel={<FaChevronLeft />}
          pageCount={pageCount}
          onPageChange={changePage}
          containerClassName={"pagination justify-content-end pr-3 pt-2 mr-4"}
          previousLinkClassName={"previousBttn"}
          activeClassName={"active"}
        />
      </div>
    </div>
  );
};

export default Appointments;
