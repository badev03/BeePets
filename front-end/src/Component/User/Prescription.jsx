import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import ReactPaginate from 'react-paginate';
import prescriptionUsersApi from '../../api/prescription';
import LoadingSkeleton from '../Loading';

const Prescription = () => {
  const [prescription, setPrescription] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const [pageCount, setPageCount] = useState(0);
  const [isLoading, setIsLoading] = useState(true);
  const itemsPerPage = 5;
  const token = localStorage.getItem('token');

  useEffect(() => {
    if (token) {
      const fetchPrescription = async () => {
        try {
          const response = await prescriptionUsersApi.getPrescription({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setPrescription(response.prescriptions);
          setPageCount(Math.ceil(response.prescriptions.length / itemsPerPage));
          setIsLoading(false);
          console.log(response.prescriptions);
        } catch (error) {
          console.error('Không có dữ liệu:', error);
        }
      };

      fetchPrescription();
    }
  }, [token]);

  function formatDate(dateString) {
    if (dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
      return formattedDate.replace('lúc', '').trim();
    }
    return '';
  }

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

  const displayedPrescriptions = prescription
    .slice(pageNumber * itemsPerPage, (pageNumber + 1) * itemsPerPage)
    .map(prescriptionItem => (
      <tr key={prescriptionItem.prescription_id}>
        <td>{prescriptionItem.prescription_id}</td>
        <td>{formatDate(prescriptionItem.created_at)}</td>
        <td>{prescriptionItem.name}</td>
        <td>
          <h2 className="table-avatar">
            <a href="doctor-profile.html" className="avatar avatar-sm me-2">
              <img className="avatar-img rounded-circle" src={prescriptionItem.doctor_image} alt="User Image" />
            </a>
            <a href="doctor-profile.html">
              {prescriptionItem.created_by}
              <span>{prescriptionItem.created_by}</span>
            </a>
          </h2>
        </td>
        <td>
          <div className="table-action">
            <button className="btn btn-sm bg-info-light">
              <Link to={`/user/prescription/${prescriptionItem.prescription_id}`}>
                <i className="far fa-eye" /> View
              </Link>
            </button>
          </div>
        </td>
      </tr>
    ));

  if (isLoading) {
    return <LoadingSkeleton />;
  }

  if (prescription.length === 0) {
    return <div colSpan="5" className="empty-appointments">Hiện tại chưa có lịch hẹn nào </div>;
  }

  return (
    <div className="tab-pane fade" id="pat_prescriptions">
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã thuốc</th>
                  <th>Ngày</th>
                  <th>Tên đơn thuốc</th>
                  <th>Người tạo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>{displayedPrescriptions}</tbody>
            </table>
          </div>
        </div>
        <ReactPaginate
          nextLabel={'>'}
          previousLabel={'<'}
          pageCount={pageCount}
          onPageChange={changePage}
          containerClassName={'pagination justify-content-end pr-3 pt-2 mr-4'}
          previousLinkClassName={'previousBttn'}
          nextLinkClassName={'nextBttn'}
          activeClassName={'active'}
        />
      </div>
    </div>
  );
};

export default Prescription;
