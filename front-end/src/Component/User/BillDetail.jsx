import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import Sidebar from './Sidebar';
import axios from 'axios';

const BillDetail = () => {
  const [bill, setBill] = useState({});
  const [products, setProducts] = useState([]);
  const { id } = useParams();
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchBillDetail = async () => {
        try {
          const response = await axios.get(`http://127.0.0.1:8000/api/detail-bill-user/${id}`, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setBill(response.data.bill);
          setProducts(response.data.products);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };
      fetchBillDetail();
    }
  }, [id, token]);
  function formatDate(dateString) {
    if (dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace('lúc', '').trim();
    }
    return '';
  }

  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Chi tiết hóa đơn</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                  <li className="breadcrumb-item" aria-current="page">Chi tiết hóa đơn</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div className="content">
        <div className="container">
          <div className="row">
            <Sidebar />
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="card">
                <div className="card-body">
                  <form>
                    <div className="row align-items-center mb-4">
                      <div className="col-6">
                        <img src="../../src/assets/img/logo.jpg" className="img-fluid" style={{ width: '100px', height: 'auto' }} alt="Logo" />
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3" style={{ marginLeft: '140px' }}>
                          <label className="mb-2">Mã hóa đơn: {bill.code}</label><br />
                          <label className="mb-2">Thời gian tạo: {formatDate(bill.created_at)}</label>
                        </div>
                      </div>
                    </div>
                    <div className="table-responsive">
                      <table className="table table-hover table-center mb-0" style={{marginTop: '20px'}}>
                        <thead>
                          <tr>
                            <th>Số thứ tự</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>{bill.services_name}</td>
                            <td>1</td>
                            <td>{bill.services_price} VND</td>
                          </tr>
                          {products.map((product, index) => (
                            <tr key={index}>
                              <td>{index + 2}</td>
                              <td>{product.product_name}</td>
                              <td>{product.quantity}</td>
                              <td>{product.product_price} VND</td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                    <div className="col-12 col-md-12 text-end mt-4">
                      <label className="mb-2">
                        <strong>Tổng tiền: {bill.total_amount} <span className="text-danger fw-bold">VNĐ</span></strong>
                      </label>
                    </div>
                    <div className="col-12 col-md-12 mt-5">
                      <div className="mb-3">
                        <label className="mb-2"><strong>Ghi chú</strong></label>
                        <textarea className="form-control" rows="4" />
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BillDetail;
