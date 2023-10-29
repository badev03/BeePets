import React from 'react'
import { Link } from 'react-router-dom'
import { useEffect, useState } from 'react'
import billApi from '../../api/bill';


const Bill = () => {
  const [bill, setBill] = useState([]);
  
  const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchUser = async () => {
        try {
         const response = await billApi.getBill(
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setBill(response.bills); 
            console.log(response.bills);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
      fetchUser();
    }, []); 
   }
  return (
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Ngày </th>
                              
                              <th>Giá</th>
                              <th>Tạo bởi</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          {bill.map(bill=>(
                            <tr key={bill.code}>
                            <td><a href="#">{bill.code}</a></td>
                            <td>{bill.order_date}</td>
                            <td>{bill.total_amoun}</td>
                          
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
                                  <Link to={"/user/billdetail"}> <i className="far fa-eye" /> View</Link>
                                 
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
  )
}

export default Bill