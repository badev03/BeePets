import React from 'react'
import { Link } from 'react-router-dom'
import Sidebar from './Sidebar'



const AppointmentDetail = () => {
  return (
    <div>    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Chi tiết lịch khám</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Chi tiết lịch khám</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <Sidebar/>
        <div className="col-md-7 col-lg-8 col-xl-9">
       
        <div className="card">
            <div className="card-body">
              <form>
              
                <div className="row">
               
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên bác sĩ</label>
                      <input type="text" className="form-control" defaultValue={"Vũ Anh Pá"}/>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Loại thú cưng</label>
                      <input type="text" className="form-control" defaultValue={"Vũ Anh Pá"} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Ngày đặt lịch</label>
                      <input type="text" className="form-control" defaultValue={"28/09/2003"}/>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Lịch khám</label>
                      <input type="text" className="form-control" defaultValue={"8:00 - 9:00"}  />
                    </div>
                  </div>
                 
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <label className="mb-2">Ghi chú</label>
                     
                        <textarea type="text" className="form-control datetimepicker" defaultValue={"Vũ Anh Pá"} />
                      
                    </div>
                  </div>
                 
                  
  
                </div>
                
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div></div>
  )
}

export default AppointmentDetail