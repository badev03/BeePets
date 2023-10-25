import React, { useEffect, useState } from 'react';

import { Link } from 'react-router-dom'
import prescriptionUsersApi from '../../api/prescription';

const Prescription = () => {
  const [prescription, setPrescription] = useState([]);

  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchsetPrescription = async () => {
        try {
          const response = await prescriptionUsersApi.getPrescription({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setPrescription(response.prescriptions);
          // console.log(response.appointments);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };

      fetchsetPrescription();
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
  return (
    <div className="tab-pane fade" id="pat_prescriptions">
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã thuốc </th>
                  <th>Ngày </th>
                  <th>Tên đơn thuốc</th>
                  <th>Người tạo </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {prescription.map(prescription => (
                  <tr key={prescription.prescription_id}>
                    <td>{prescription.prescription_id}</td>

                    <td>{formatDate(prescription.created_at)}</td>
                    <td>{prescription.name}</td>
                    <td>
                      <h2 className="table-avatar">
                        <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                          <img className="avatar-img rounded-circle" src={prescription.doctor_image} alt="User Image" />
                        </a>
                        <a href="doctor-profile.html"> {prescription.created_by}<span>{prescription.created_by}</span></a>
                      </h2>
                    </td>
                    <td>
                      <div className="table-action">

                        <button className="btn btn-sm bg-info-light">
                          <Link to={`/user/prescription/${prescription.prescription_id}`}>
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
  )
}

export default Prescription