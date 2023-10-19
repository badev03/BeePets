import React from 'react'
import { Link } from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import billApi from '../../api/bill';

const PatientBill = () => {
    const [bills, setBills] = useState([]);
    const { id } = useParams();
    
    const token = localStorage.getItem('token');
    
     if(token){
       useEffect(() => {
        const fetchUser = async () => {
          try {
           const response = await billApi.getBillPatient(id,
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setBills(response.bills); 
        //   console.log(response.bills);    
          } catch (error) {
            console.error("Không có dữ liệu:", error);
          }
        };
    
        fetchUser();
      }, []); 
     }
  return (
    <div className="tab-pane" id="billing">
    <div>
      <Link className="add-new-btn" to="/doctors/add-bill">Tạo hóa đơn</Link>
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
            <tbody>
            {bills.map(bill=>(
              <tr key={bill} data={bill}>
                <td>
                  <Link to="invoice-view.html">{bill.bill_code}</Link>
                </td>
                <td>
                  <h2 className="table-avatar">
                    <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                      <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                    </Link>
                    <Link to="doctor-profile.html">{bill.doctor_name}
                      </Link>
                  </h2>
                </td>
                <td>{bill.total_amount}</td>
                <td>
                  <div className="table-action">
                    <Link to="#" className="btn btn-sm bg-info-light">
                      <i className="far fa-eye" /> View
                    </Link>
                    <Link to="edit-billing.html" className="btn btn-sm bg-success-light">
                      <i className="fas fa-edit" /> Edit
                    </Link>
                    <Link to="#" className="btn btn-sm bg-danger-light">
                      <i className="far fa-trash-alt" /> Delete
                    </Link>
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

export default PatientBill