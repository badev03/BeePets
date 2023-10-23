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
                    <div className="row">
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <img src="../src/assets/img/logo.jpg" className="img-fluid" alt="Logo" />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Mã hóa đơn: {bill.code}</label><br />
                          <label className="mb-2">Ngày: {bill.created_at}</label>
                        </div>
                      </div>
                    </div>
                    <div className="table-responsive">
                      <table className="table table-hover table-center mb-0">
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
                    <div className="col-12 col-md-12">
                      <div className="mb-3 pt-5">
                        <label className="mb-2" style={{ float: "right", marginRight: "50px" }}>
                          <th>Tổng tiền : {bill.total_amount} VND</th>
                        </label>
                      </div>
                    </div>
                    <div className="col-12 col-md-12">
                      <div className="mt-5">
                        <label className="mb-2"><th>Ghi chú</th></label>
                        <textarea type="text" className="form-control datetimepicker" />
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
