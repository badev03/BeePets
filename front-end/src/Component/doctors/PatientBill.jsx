import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { useParams } from "react-router-dom";
import billApi from "../../api/bill";
import ReactPaginate from "react-paginate";
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";

const PatientBill = () => {
  const [bills, setBills] = useState([]);
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
        // console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    if (token) {
      fetchBills();
    }
  }, [id, token]);

  const displayBills = bills
    .slice(pagesVisited, pagesVisited + billsPerPage)
    .map((bill) => (
      <tr key={bill.id} data={bill}>
        <td>
          <Link to="invoice-view.html">{bill.bill_code}</Link>
        </td>
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
              <i className="far fa-eye" /> View
            </Link>
            <Link
              to={`/doctors/edit-bill/${bill.id}`}
              className="btn btn-sm bg-success-light"
            >
              <i className="fas fa-edit" /> Edit
            </Link>
            <Link to="#" className="btn btn-sm bg-danger-light">
              <i className="far fa-trash-alt" /> Delete
            </Link>
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
      <div>
        <Link className="add-new-btn" to="/doctors/add-bill">
          Tạo hóa đơn
        </Link>
      </div>
      <div className="card card-table mb-0">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-center mb-0">
              <thead>
                <tr>
                  <th>Mã hóa đơn</th>
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
