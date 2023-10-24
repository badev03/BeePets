import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import ReactPaginate from 'react-paginate';
import appointmentUsersApi from '../../api/appoinmentsUse';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import LoadingSkeleton from '../Loading';

const Appointments = () => {
  const [appointments, setAppointments] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [pageCount, setPageCount] = useState(0);
  const [isLoading, setIsLoading] = useState(true); // Thêm state để theo dõi trạng thái loading
  const itemsPerPage = 5; // số mục trên mỗi trang
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchUser = async () => {
        try {
          const response = await appointmentUsersApi.getHistoryAppoinments({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setAppointments(response.appointments);
          setPageCount(Math.ceil(response.appointments.length / itemsPerPage));
          setIsLoading(false); // Khi dữ liệu đã được tải xong, set isLoading thành false
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };

      fetchUser();

      const interval = setInterval(async () => {
        try {
          const response = await appointmentUsersApi.getHistoryAppoinments({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setAppointments(response.appointments);
        } catch (error) {
          console.error('Lỗi lấy dữ liệu:', error);
        }
      }, 5000); // cập nhật mỗi 5 giây, bạn có thể điều chỉnh thời gian theo ý muốn

      return () => clearInterval(interval); // Xóa interval khi component unmounts
    }
  }, [token]);

  // ...Phần còn lại của useEffect

  // Kiểm tra trạng thái isLoading và render component tương ứng
  if (isLoading) {
    return <LoadingSkeleton />;
  }

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };


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
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace('lúc', '').trim();
    }
    return '';
  }

  const displayedAppointments = appointments
    .slice(pageNumber * itemsPerPage, (pageNumber + 1) * itemsPerPage)
    .map(appointment => (
      <tr key={appointment.appointment_id}>
        <td>
          <h2 className="table-avatar">
            <a href="doctor-profile.html" className="avatar avatar-sm me-2">
              <img className="avatar-img rounded-circle" src={appointment.image} alt="User Image" />
              <span>{appointment.doctor_name}</span>
            </a>
            <a href="doctor-profile.html">{appointment.doctor_id}</a>
          </h2>
        </td>
        <td>
          {/* <span className="d-block text-info">
            {appointment.time ? formatTime(appointment.time) : ''}
          </span> */}
          <span className="d-block text-info">
            {appointment.shift_name}
          </span>
          <span className="d-block ">
            {formatShiftTime(appointment.shift_name)}
          </span>
        </td>
        <td>{formatDate(appointment.date)}</td>
        <td>
          <span className={`badge rounded-pill ${parseInt(appointment.status) === 1 ? 'bg-success-light' : parseInt(appointment.status) === 0 ? 'bg-warning-light' : parseInt(appointment.status) === 2 ? 'bg-danger-light' : ''}`}>
            {parseInt(appointment.status) === 1 ? 'Confirm' : parseInt(appointment.status) === 0 ? 'Pending' : parseInt(appointment.status) === 2 ? 'Cancel' : ''}
          </span>

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
                {displayedAppointments}
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
