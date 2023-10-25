import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import appointmentsApi from "../../api/appointmentsApi";
import { useParams } from "react-router-dom";
import ReactPaginate from "react-paginate";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import LoadingSkeleton from '../Loading';
import axios from "axios";
const Prescription = () => {
    const [loading, setLoading] = useState(true);
    const [appointments, setAppointmentsApi] = useState([]);
    const { id } = useParams();
    const [pageNumber, setPageNumber] = useState(0);
    const appointmentsPerPage = 5;
    const pagesVisited = pageNumber * appointmentsPerPage;
  
    const token = localStorage.getItem("token");
  
    useEffect(() => {
      const fetchAppointments = async () => {
        try {
            const response = await appointmentsApi.getPres(id, {
                headers: {
                  Authorization: `Bearer ${token}`,
                },
              });
          setAppointmentsApi(response.prescriptions);
        //   console.log(appointments)
          setLoading(false);
  
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      if (token) {
        fetchAppointments();
      }
    }, [id, token]);
    if (loading) {
      return <LoadingSkeleton />
    }
    const formatCurrency = (value) => {
        const numberValue = parseFloat(value);
        return numberValue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
      };
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace('lúc', '').trim();
    }
    return '';
  }
  const formatShiftTime = (shiftName) => {
    switch (shiftName) {
      case 'Ca 1':
        return ' 8:00h-12:00h';
      case 'Ca 2':
        return '13:00h-17:00h';
      case 'Ca 3':
        return '18:00h-20:00h';
      default:
        return '';
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
                  src={appointment.doctor_image}
                  alt="User Image"
                />
              </a>
              <a href="doctor-profile.html">{appointment.doctor_name} </a>
            </h2>
          </td>
          <td>
            {appointment.prescription_name }
          </td>
          <td>{formatDate(appointment.prescription_created_at)}</td>
          <td>
            {formatCurrency(appointment.prescription_price) }
          </td>
          
          <td>
            <div className="table-action">
              <button className="btn btn-sm bg-info-light">
                <Link
                  to={`/doctors/detail-prescription/${appointment.id}`}
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
        <div className="tab-pane fade" id="pres">
        <div>
          <Link to="/doctors/add-prescription" className="add-new-btn">Thêm đơn thuốc</Link>
        </div>
        <div className="card card-table mb-0">
          <div className="card-body">
            <div className="table-responsive">
              <table className="table table-hover table-center mb-0">
                <thead>
                  <tr>
                  <th>Tạo bởi </th>
                    <th>Tên</th>
                    <th>Ngày </th>

                    <th>Giá </th>
                    <th>Hoạt động</th>
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
export default Prescription