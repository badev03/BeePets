import React from 'react'
import { Link } from 'react-router-dom'

const Bill = () => {
  return (
    <div id="pat_medical_records" className="tab-pane fade">
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
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
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
  )
}

export default Bill