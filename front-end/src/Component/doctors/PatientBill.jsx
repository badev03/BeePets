import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { useParams } from "react-router-dom";
import billApi from "../../api/bill";
import ReactPaginate from "react-paginate";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import LoadingSkeleton from '../Loading';

const PatientBill = () => {
  const [bills, setBills] = useState([]);
  const [loading, setLoading] = useState(true);

  const { id } = useParams();
  const [pageNumber, setPageNumber] = useState(0);
  const billsPerPage = 5;
  const pagesVisited = pageNumber * billsPerPage;

  const token = localStorage.getItem("token");
  const formatCurrency = (value) => {
    const numberValue = parseFloat(value);
    return numberValue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
  };
  useEffect(() => {
    const fetchBills = async () => {
      try {
        const response = await billApi.getBillPatient(id, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setBills(response.bills);
        setLoading(false);

        // console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    if (token) {
      fetchBills();
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
  // if (loading) {
  //   return <LoadingSkeleton />
  // }
  const displayBills = bills
    .slice(pagesVisited, pagesVisited + billsPerPage)
    .map((bill) => (
      <tr key={bill.id} data={bill}>
        <td>
          <Link to="invoice-view.html">{bill.bill_code}</Link>
        </td>
        <td>{formatDate(bill.bill_created_at)}</td>
        <td>
          <h2 className="table-avatar">
            <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
              <img
                className="avatar-img rounded-circle"
                src="/img/doctors/doctor-thumb-02.jpg"
                alt="User Image"
              />
            </Link>
            <Link to="doctor-profile.html">{bill.doctor_name}</Link>
          </h2>
        </td>
        <td>{formatCurrency(bill.total_amount)}</td>
        <td>
          <div className="table-action">
            <Link to={`/doctors/detail-bill/${bill.id}`} className="btn btn-sm bg-info-light">
              <i className="far fa-eye" /> Hóa Đơn
            </Link>
            <Link
              to={`/doctors/edit-bill/${bill.id}`}
              className="btn btn-sm bg-success-light"
            >
              <i className="fas fa-edit" /> Sửa Hóa Đơn
            </Link>
            {/* <Link to="#" className="btn btn-sm bg-danger-light">
              <i className="far fa-trash-alt" /> Delete
            </Link> */}
          </div>
        </td>
      </tr>
    ));

  const pageCount = Math.ceil(bills.length / billsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

  return (
    <div className="tab-pane" id="billing">
      {/* <div>
        <Link className="add-new-btn" to="/doctors/add-bill">
          Tạo hóa đơn
        </Link>
      </div> */}
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã hóa đơn</th>
                  <th>Ngày</th>
                  <th>Người tạo</th>
                  <th>Tổng tiền</th>
                  <th>Hoạt động</th>
                </tr>
              </thead>
              <tbody>{displayBills}</tbody>
            </table>
          </div>
        </div>
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
  );
};

export default PatientBill;
