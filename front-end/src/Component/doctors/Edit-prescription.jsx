import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import BreadcrumbBar from '../BreadcrumbBar'

const Editprescription = () => {
    return (
        <div>
                       <BreadcrumbBar title="THÊM ĐƠN THUỐC" lable="Thêm đơn thuốc" />

            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                            <div className="card widget-profile pat-widget-profile">
                                <div className="card-body">
                                    <Menudashboard />
                                    {/* <div className="pro-widget-content">
                                        <div className="profile-info-widget">
                                            <Link to="#" className="booking-doc-img">
                                                <img src="/img/patients/patient.jpg" alt="User Image" />
                                            </Link>
                                            <div className="profile-det-info">
                                                <h3>Richard Wilson</h3>
                                                <div className="patient-details">
                                                    <h5><b>Patient ID :</b> PT0016</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="patient-info">
                                        <ul>
                                            <li>SĐT <span>+1 952 001 8563</span></li>
                                        </ul>
                                    </div> */}
                                </div>
                            </div>
                        </div>
                        <div className="col-md-7 col-lg-8 col-xl-9">
                            <div className="card">
                                <div className="card-header">
                                    <h4 className="card-title mb-0">Thêm đơn thuốc</h4>
                                </div>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-sm-6">
                                            <div className="biller-info">
                                                <h4 className="d-block">Dr. Thành Đoàn</h4>
                                            </div>
                                        </div>
                                        <div className="col-sm-6 text-sm-end">
                                            <div className="billing-info">
                                                <h4 className="d-block">1 November 2023</h4>
                                                <span className="d-block text-muted">#INV0001</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="add-more-item text-end">
                                        <Link to="javascript:void(0);" className="add-prescription"><i className="fas fa-plus-circle" /> Thêm thuốc</Link>
                                    </div>
                                    <div className="card card-table">
                                        <div className="card-body">
                                            <div className="table-responsive">
                                                <table className="table table-hover table-center add-table-prescription">
                                                    <thead>
                                                        <tr>
                                                            <th className="table-name">Tên thuốc</th>
                                                            <th>Số lượng</th>
                                                            <th className="table-name">Liều lượng</th>
                                                            <th className="table-name">Hướng dẫn sử dụng</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr className="test">
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <Link to="#" className="btn bg-danger-light trash"><i className="far fa-trash-alt" /></Link>
                                                            </td>
                                                        </tr>
                                                        <tr className="test">
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <Link to="#" className="btn bg-danger-light trash"><i className="far fa-trash-alt" /></Link>
                                                            </td>
                                                        </tr>
                                                        <tr className="test">
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <Link to="#" className="btn bg-danger-light trash"><i className="far fa-trash-alt" /></Link>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">

                                    </div>
                                    <div className="row">
                                        <div className="col-md-12">
                                            <div className="submit-section">
                                                <button type="submit" className="btn btn-primary submit-btn">Save</button>
                                                <Link to="patient-profile" className="btn reg-btn">Quay lại</Link>

                                                {/* <button type="reset" className="btn btn-secondary submit-btn">Clear</button> */}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Editprescription