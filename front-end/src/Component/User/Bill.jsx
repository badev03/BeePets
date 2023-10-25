import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import billApi from '../../api/bill';

const Bill = () => {
  const [bills, setBills] = useState([]);

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
          console.log(response.bills);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
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

  return (
    <div id="pat_medical_records" className="tab-pane fade">
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã hóa đơn</th>
                  <th>Ngày </th>
                  <th>Giá</th>
                  <th>Tạo bởi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {bills.map(bill => (
                  <tr key={bill.code}>
                    <td><a href="#">{bill.code}</a></td>
                    {/* <td>{bill.order_date}</td> */}
                    <td>{formatDate(bill.order_date)}</td>
                    <td>{formatCurrency(bill.total_amount)} </td>
                    <td>
                      <h2 className="table-avatar">
                        <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                          <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                        </a>
                        <a href="doctor-profile.html">{bill.created_by}</a>
                      </h2>
                    </td>
                    <td>
                      <div className="table-action">
                        <button className="btn btn-sm bg-info-light">
                          <Link to={`/user/bill/${bill.id}`}>
                            <i className="far fa-eye" /> View
                          </Link>
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Bill;
