import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import appointmentApi from '../../api/appointmentApi';


const Appointment = () => {
    const { id } = useParams();
    // console.log(id);
    const [bill, setBills] = useState(null);

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await appointmentApi.get(id);
                setBills(response);
                console.log(bill.id)
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };


        fetchBlog();
    }, []);
    if (!bill) {
        return <div>Loading...</div>;
    }

    return (
        <div className="col-md-7 col-lg-8 col-xl-9">

            <div className="card">
                <div className="card-body">
                    <form>

                        <div className="row">

                            <div className="col-12 col-md-6" key={bill.id}>
                                <div className="mb-3">
                                    <label className="mb-2">Tên bác sĩ</label>
                                    <input type="text" className="form-control" defaultValue={bill.name} />
                                </div>
                            </div>
                            <div className="col-12 col-md-6">
                                <div className="mb-3">
                                    <label className="mb-2">Loại thú cưng</label>
                                    <input type="text" className="form-control" defaultValue={bill.type} />
                                </div>
                            </div>
                            <div className="col-12 col-md-6">
                                <div className="mb-3">
                                    <label className="mb-2">Ngày đặt lịch</label>
                                    <input type="text" className="form-control" defaultValue={bill.date} />
                                </div>
                            </div>
                            <div className="col-12 col-md-6">
                                <div className="mb-3">
                                    <label className="mb-2">Lịch khám</label>
                                    <input type="text" className="form-control" defaultValue={bill.schedule} />
                                </div>
                            </div>

                            <div className="col-12 col-md-12">
                                <div className="mb-3">
                                    <label className="mb-2">Ghi chú</label>

                                    <textarea type="text" className="form-control datetimepicker" defaultValue={bill.note} />

                                </div>
                            </div>



                        </div>

                    </form>
                </div>
            </div>

        </div>
    )
}

export default Appointment