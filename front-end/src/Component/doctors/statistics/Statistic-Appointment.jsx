import React, { useState, useEffect } from 'react'
import Menudashboard from '../Menu-dashboard';
import { Link } from 'react-router-dom'
import { BarChart, Bar, Rectangle, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';
import axios from 'axios';
import { Form, DatePicker, Button } from 'antd';
import moment from 'moment';
const StatisticAppointment = () => {
    const [appointmentData, setAppointmentData] = useState([]);
    const [date, setDate] = useState(new Date().toISOString().split('T')[0]); // Lấy ngày hiện tại
    const token = localStorage.getItem('token');
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        const fetchDataAndSetLoading = async () => {
            setLoading(true);
            await fetchData(date || getCurrentDate());
        };

        fetchDataAndSetLoading();
    }, [date, token]);




    const getCurrentDate = () => {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Thêm '0' vào đầu nếu tháng chỉ có 1 chữ số
        const day = String(today.getDate()).padStart(2, '0'); // Thêm '0' vào đầu nếu ngày chỉ có 1 chữ số
        return `${year}-${month}-${day}`;
    };

    const fetchData = async (selectedDate) => {
        try {
            setLoading(true);
            console.log('Loading started...');

            const response = await axios.post(
                'http://127.0.0.1:8000/api/filter-appointments-statistics',
                { date: selectedDate },
                {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                }
            );

            const result = response.data;
            console.log('Kết quả:', result);    
            if (result.msg === 'Lọc dữ liệu thành công') {
                setAppointmentData(result.data);
            } else {
                console.error('Lỗi khi lấy dữ liệu thống kê:', result.msg);
                setAppointmentData([])
            }
        } catch (error) {
            console.error('Lỗi khi gọi API:', error);
        } finally {
            setLoading(false);
            console.log('Loading finished...');
        }
    };


    const handleDateChange = (e) => {
        const newDate = e.target.value;
        console.log(newDate);
        setDate(newDate);
    };


    const handleFilterClick = () => {
        // Gọi fetchData với ngày đã chọn hoặc ngày hôm nay nếu chưa có ngày được chọn
        fetchData(date || getCurrentDate());
    };

    const statusLabels = {
        0: 'Chưa xác nhận',
        1: 'Đã xác nhận',
        2: 'Đã xóa',
        3: 'Đã hủy',
        4: 'Đã hoàn thành',
        6: 'Yêu cầu hủy',
        7: 'Yêu cầu đổi lịch',
    };
    const statusColors = {
        'Chưa xác nhận': '#009efb',
        'Đã xác nhận': '#00ff00', // Change this color accordingly
        'Đã xóa': '#ffcc00',       // Change this color accordingly
        'Đã hủy': '#ff0100',
        'Đã hoàn thành': '#9900cc', // Change this color accordingly
        'Yêu cầu hủy': '#ff6600',  // Change this color accordingly
        'Yêu cầu đổi lịch': '#993333' // Change this color accordingly
    };

    const getStatusLabel = (status) => statusLabels[status] || 'Không xác định';

    const prepareChartData = () => {
        if (loading) {
            return [];
        }
        if (appointmentData.length === 0) {
            console.log(appointmentData.length);
            return [
                {
                    status: 'Không có dữ liệu',
                    count: 0,
                },
            ];
        }
        return appointmentData.map((item) => ({
            status: getStatusLabel(item.status),
            count: item.count,
        }));
    };

    return (
        <div>
            {/* Phần breadcrumb */}
            <div className="breadcrumb-bar-two">
                <div className="container">
                    <div className="row align-items-center inner-banner">
                        <div className="col-md-12 col-12 text-center">
                            <h2 className="breadcrumb-title">Bảng điều khiển</h2>
                            <nav aria-label="breadcrumb" className="page-breadcrumb">
                                <ol className="breadcrumb">
                                    <li className="breadcrumb-item">
                                        <Link to="/">Trang chủ</Link>
                                    </li>
                                    <li className="breadcrumb-item" aria-current="page">
                                        Bảng điều khiển
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            {/* Phần nội dung */}
            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                            <Menudashboard />
                        </div>
                        <div className="col-md-7 col-lg-8 col-xl-9">
                            <div className="row">
                                <br />
                                <h2 className="mb-4 ">Thống kê lịch hẹn</h2>
                                <br />
                                <div className="search-container">
                                    <div className="input-group mb-3">
                                        <label className=" rounded-2" htmlFor="datePicker">
                                            Chọn ngày:
                                        </label>
                                        <input
                                            type="date"
                                            id="datePicker"
                                            value={date}
                                            onChange={handleDateChange}
                                            className="input-group-text rounded-1"
                                            max={new Date().toISOString().split('T')[0]} // Chỉ cho phép chọn quá khứ và hiện tại
                                        />
                                        {/* <button className="btn btn-primary rounded-2" onClick={handleFilterClick}>
                                                            Lọc
                                                        </button> */}
                                    </div>
                                    <div className="input-group mb-3">
                                        <label className=" rounded-2" htmlFor="datePicker">
                                            Chọn ngày:
                                        </label>
                                        <input
                                            type="date"
                                            id="datePicker"
                                            className="input-group-text rounded-1"
                                            max={new Date().toISOString().split('T')[0]} // Chỉ cho phép chọn quá khứ và hiện tại
                                        />
                                        {/* <button className="btn btn-primary rounded-2" onClick={handleFilterClick}>
                                                            Lọc
                                                        </button> */}
                                    </div>
                                </div>

                                <div className="card card-table mb-0">

                                    <div className="card-body">
                                        <div className="col-md-12">
                                            <br />
                                            <br />

                                            <div className="appointment-tab">

                                                <div className="tab-content">
                                                    <ResponsiveContainer width="100%" aspect={3}>
                                                        <BarChart
                                                            key={JSON.stringify(prepareChartData())} // Thêm key vào đây
                                                            width={500}
                                                            height={300}
                                                            data={prepareChartData()}
                                                            margin={{
                                                                top: 5,
                                                                right: 30,
                                                                left: 20,
                                                                bottom: 5,
                                                            }}
                                                        >
                                                            <CartesianGrid strokeDasharray="3 3" />
                                                            <XAxis dataKey="status" />
                                                            <YAxis />
                                                            <Tooltip />
                                                            <Legend />
                                                            
                                                            <Bar dataKey="count" fill="#009efb" label={(props) => props.value} />
                                                            <Bar dataKey="count" fill="#ff0100" label={(props) => props.value} />
                                                            
                                                        </BarChart>

                                                    </ResponsiveContainer>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div></div>
    )
}

export default StatisticAppointment