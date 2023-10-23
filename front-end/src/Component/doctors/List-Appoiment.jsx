import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useParams } from "react-router-dom";
import ReactPaginate from "react-paginate";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";

const AppoimentList = () => {
  const [appointments, setAppointmentsApi] = useState([]);
  const { id } = useParams();
  const [pageNumber, setPageNumber] = useState(0);
  const appointmentsPerPage = 5;
  const pagesVisited = pageNumber * appointmentsPerPage;

  const token = localStorage.getItem("token");

  useEffect(() => {
    const fetchAppointments = async () => {
      try {
        const response = await appointmentsApi.getAppoinmentsUser(id, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setAppointmentsApi(response.appointments);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    if (token) {
      fetchAppointments();
    }
  }, [id, token]);

  const displayAppointments = appointments
    .slice(pagesVisited, pagesVisited + appointmentsPerPage)
    .map((appointment) => (
      <tr key={appointment} data={appointment}>
        <td>
          <h2 className="table-avatar">
            <a href="doctor-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src={appointment.image}
                alt="User Image"
              />
            </a>
            <a href="doctor-profile.html">{appointment.name} </a>
          </h2>
        </td>
        <td>
          {appointment.date}{" "}
          <span className="d-block text-info">{appointment.shift_name}</span>
        </td>
        <td>{appointment.appointment_created_at}</td>
        <td>
          {appointment.status == 1 ? (
            <span className="badge rounded-pill bg-success-light">
              Xác nhận
            </span>
          ) : appointment.status == 2 ? (
            <span class="badge rounded-pill bg-danger-light">Đã hủy</span>
          ) : (
            // Optional default case
            <span className="badge rounded-pill bg-info-light">
              Không xác định
            </span>
          )}
        </td>

        <td>
          <div className="table-action">
            <button className="btn btn-sm bg-info-light">
              <Link
                to={`/doctors/accept-detail-appointments/${appointment.id}`}
              >
                {" "}
                <i className="far fa-eye" /> View
              </Link>
            </button>
          </div>
        </td>
      </tr>
    ));

  const pageCount = Math.ceil(appointments.length / appointmentsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };
  return (
    <div id="pat_appointments" className="tab-pane fade show active">
      <div className="card card-table mb-0">
        <div className="card-body">
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
  );
};

export default AppoimentList;
