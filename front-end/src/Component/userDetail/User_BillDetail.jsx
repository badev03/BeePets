import React from 'react'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import userBillDetailApi from '../../api/userBillDetailApi';

const User_BillDetail = () => {
    const { id } = useParams();
    // console.log(id);
    const [bills, setBills] = useState(null);

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await userBillDetailApi.get(id);
                setBills(response);
                // console.log(bill.id)
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };


        fetchBlog();
    }, []);
    if (!bills) {
        return <div>Loading...</div>;
    }


    return (
        <div className="card">
            <div className="card-body">
                <form>
                    <div className="row">

                        <div className="col-12 col-md-6">
                            <div className="mb-3">
                                <img
                                    src="../../../src/assets/img/logo.jpg"
                                    className="img-fluid"
                                    alt="Logo"
                                />
                            </div>
                        </div>
                        <div className="col-12 col-md-6">
                            <div className="mb-3">
                                <label className="mb-2">Mã hóa đơn: {bills.id}</label><br />
                                <label className="mb-2">Ngày: {bills.date}</label>
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



                            <tbody >
                                {bills.bills.map(bill => (
                                    <tr key={bill.id}>
                                        <td>{bill.number}</td>
                                        <td>{bill.service_name}</td>
                                        <td>{bill.quantity}</td>

                                        <td>{bill.price} VNĐ</td>

                                    </tr>


                                ))}

                                {/* lỗi vòng lặp map, hàm tổng tiền */}

                            </tbody>


                        </table>
                    </div>

                    <div className="col-12 col-md-12">

                        <div className="mb-3 pt-5" >
                            <label className="mb-2 " style={{ float: "right", marginRight: "50px" }} ><th  >Tổng tiền : 800.000 VND </th> </label>




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

    )
}


export default User_BillDetail