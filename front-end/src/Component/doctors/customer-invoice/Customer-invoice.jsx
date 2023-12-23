import React, { useState } from 'react';
import Menudashboard from '../Menu-dashboard'
import BillUser from './Bill-user';
import CancellationInvoice from './Cancellation-invoice';
import BreadcrumbBar from '../../BreadcrumbBar';

const CustomerInvoice = () => {
    const [activeTab, setActiveTab] = useState('bill');
    const handleTabChange = (tab) => {
        setActiveTab(tab);
    };
    return (
        <div>
                     <BreadcrumbBar title="HÓA ĐƠN KHÁCH HÀNG" lable="Hóa đơn khách hàng" />

            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                            <Menudashboard />
                        </div>
                        <div className="col-md-7 col-lg-8 col-xl-9">
                            <div className="card">
                                <div className="card-body pt-0">
                                    <nav className="user-tabs mb-4">
                                        <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
                                            <li className="nav-item">
                                                <a className={`nav-link ${activeTab === 'bill' ? 'active' : ''}`}
                                                    onClick={() => handleTabChange('bill')} data-bs-toggle="tab">Lịch sử hóa đơn</a>
                                            </li>
                                            <li className="nav-item">
                                                <a className={`nav-link ${activeTab === 'cancellationInvoice' ? 'active' : ''}`}
                                                    onClick={() => handleTabChange('cancellationInvoice')} href="#pat_prescriptions" data-bs-toggle="tab">Hóa đơn đã hủy</a>
                                            </li>


                                        </ul>
                                    </nav>
                                    <div className="tab-content pt-0">
                                        {activeTab === 'bill' && <BillUser />}
                                        {activeTab === 'cancellationInvoice' && <CancellationInvoice />}

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

export default CustomerInvoice