import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import ReactPaginate from 'react-paginate';
import LoadingSkeleton from '../Loading'; // Import your Loading component
import billApi from '../../api/bill';

const Bill = () => {
  const [bills, setBills] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [isLoading, setIsLoading] = useState(true);
  const itemsPerPage = 5; // số mục trên mỗi trang
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchUser = async () => {
        try {
          const response = await billApi.getBill({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setBills(response.bills);
          setIsLoading(false); // Khi dữ liệu đã được tải xong, set isLoading thành false
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };
      fetchUser();
    }
  }, [token]);
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace('lúc', '').trim();
    }
    return '';
  }
  const formatCurrency = (value) => {
    const numberValue = parseFloat(value);
    return numberValue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
  };
  
  

  // Kiểm tra trạng thái isLoading và render component tương ứng
  if (isLoading) {
    return <LoadingSkeleton />;
  }
  if (bills.length === 0) {
    return (
      <div className="empty-appointments" colSpan="5">
        Hiện tại chưa có hóa đơn nào
      </div>
    );
  }

  const pageCount = Math.ceil(bills.length / itemsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

  // Thay đổi mảng bills thành mảng bills trang hiện tại
  // ... (existing code)

const displayedBills = bills
.slice(pageNumber * itemsPerPage, (pageNumber + 1) * itemsPerPage)
.map(bill => (
  <tr key={bill.code}>
    <td className="text-start">
      <a href="#">{bill.code}</a>
    </td>
    <td className="text-start">{formatDate(bill.order_date)}</td>
    <td className="text-start">{formatCurrency(bill.total_amount)} </td>
    <td className="text-start">
      <h2 className="table-avatar">
        <a href="doctor-profile.html" className="avatar avatar-sm me-2">
          <img
            className="avatar-img rounded-circle"
            src="../src/assets/img/doctors/doctor-thumb-01.jpg"
            alt="User Image"
          />
        </a>
        <a href="doctor-profile.html">{bill.created_by}</a>
      </h2>
    </td>
    <td className="text-start">
      <div className="table-action">
        <button className="btn btn-sm bg-info-light">
          <Link to={`/user/bill/${bill.id}`}>
            <i className="far fa-eye" /> View
          </Link>
        </button>
      </div>
    </td>
  </tr>
));

// ... (existing code)


  return (
    <div className="card card-table mb-0">
      <div className="card-body">
        <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã hóa đơn</th>
                  <th>Ngày</th>
                  <th>Giá</th>
                  <th>Tạo bởi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>{displayedBills}</tbody>
            </table>
          </div>
          <ReactPaginate
            nextLabel={'>'}
            previousLabel={'<'}
            pageCount={pageCount}
            onPageChange={changePage}
            containerClassName={'pagination justify-content-end pr-3 pt-2 mr-4'}
            previousLinkClassName={'previousBttn'}
            activeClassName={'active'}
          />
        </div>
      </div>
  );
};

export default Bill;
