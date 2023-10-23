import React from 'react'
import { Link } from 'react-router-dom'
import Sidebar from './Sidebar'

const PrescriptionDetails = () => {
  
  return (
    <div>    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Chi tiết đơn thuốc</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Chi tiết đơn thuốc</li>
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
               <hr />
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên loại thuốc</label>
                      <input type="text" className="form-control" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số lượng</label>
                      <input type="text" className="form-control"  />
                    </div>
                  </div>
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <label className="mb-2">Hướng dẫn dử dụng</label>
                     
                        <textarea type="text" className="form-control datetimepicker" />
                      
                    </div>
                  </div>
                 
                  
  
                </div>
                <div className="row">
               <hr />
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên loại thuốc</label>
                      <input type="text" className="form-control" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số lượng</label>
                      <input type="text" className="form-control"  />
                    </div>
                  </div>
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <label className="mb-2">Hướng dẫn dử dụng</label>
                     
                        <textarea type="text" className="form-control datetimepicker" />
                      
                    </div>
                  </div>
                 
                  
  
                </div>
                <div className="row">
               <hr />
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên loại thuốc</label>
                      <input type="text" className="form-control" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số lượng</label>
                      <input type="text" className="form-control"  />
                    </div>
                  </div>
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <label className="mb-2">Hướng dẫn dử dụng</label>
                     
                        <textarea type="text" className="form-control datetimepicker" />
                      
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

export default PrescriptionDetails