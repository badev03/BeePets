import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom'
import Sidebar from './Sidebar'
import axios from 'axios';

const PrescriptionDetails = () => {
  const [prescriptions, setPrescriptions] = useState([]);
  const { id } = useParams();
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchPrescriptionDetail = async () => {
        try {
          const response = await axios.get(`http://127.0.0.1:8000/api/detail-prescription/${id}`, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setPrescriptions(response.data.products);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };
      fetchPrescriptionDetail();
    }
  }, [id, token]);
  return (
    <div>    <div><div className="breadcrumb-bar-two">
      <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">Chi tiết đơn thuốc</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
              <ol className="breadcrumb">
                <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li className="breadcrumb-item" aria-current="page">Chi tiết đơn thuốc</li>
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
              {prescriptions.length === 0 ? (
                <div className="card">
                  <div className="card-body">
                    <p>Đơn thuốc trống</p>
                  </div>
                </div>
              ) : (
                prescriptions.map((prescription, index) => (
                  <div className="card" key={index}>
                    <div className="card-body">
                      <form>
                      <div className="row">
                          <hr />
                          <div className="col-12 col-md-6">
                            <div className="mb-3">
                              <label className="mb-2">Tên loại thuốc</label>
                              <input type="text" className="form-control" value={prescription.product_name} readOnly />
                            </div>
                          </div>
                          <div className="col-12 col-md-6">
                            <div className="mb-3">
                              <label className="mb-2">Số lượng</label>
                              <input type="text" className="form-control" value={prescription.quantity} readOnly />
                            </div>
                          </div>
                          <div className="col-12 col-md-12">
                            <div className="mb-3">
                              <label className="mb-2">Hướng dẫn sử dụng</label>
                              <textarea type="text" className="form-control datetimepicker" value={prescription.instructions} readOnly />
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                ))
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  )
}

export default PrescriptionDetails