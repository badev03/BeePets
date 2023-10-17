import React from 'react'
import { Link } from 'react-router-dom'
import Sidebar from './Sidebar'



const BillDetail = () => {
  return (
    <div>    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Chi tiết hóa đơn</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Chi tiết hóa đơn</li>
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
                    <img
                src="../src/assets/img/logo.jpg"
                className="img-fluid"
                alt="Logo"
              />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Mã hóa đơn: MH001</label><br />
                      <label className="mb-2">Ngày: 16-09-2023</label>
                
                    </div>
                  </div>
                  
                </div>
                <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Số thứ tự</th>
                              <th>Tên dịch vụ</th>
                              <th>Số lượng</th>
                              <th>Đơn giá</th>
                     
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                            <td>#1</td>
                              <td>Khám chữa bệnh</td>
                              <td>1</td>
                            
                              <td>300.000 VND</td>
                              
                            </tr>
                            <tr>
                            <td>#2</td>
                              <td>Đơn thuốc</td>
                              <td>1</td>
                            
                              <td>500.000 VND</td>
                              
                            </tr>
                           
                           
                          

                          </tbody>
                        </table>
                      </div>
                      <div className="col-12 col-md-12">
                    
                    <div className="mb-3 pt-5" >
                    <label className="mb-2 " style={{ float:"right" , marginRight:"50px" }} ><th  >Tổng tiền : 800.000 VND</th> </label>
                    
                     
                    
                      
                    </div>
                  </div>
                      <div className="col-12 col-md-12">
                    <div className="mt-5">
                      <label className="mb-2"><th>Ghi chú</th></label>
                     
                        <textarea type="text" className="form-control datetimepicker" />
                      
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

export default BillDetail