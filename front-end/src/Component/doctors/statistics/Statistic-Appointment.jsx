import React, { useState, useEffect, useRef } from 'react';
import Menudashboard from '../Menu-dashboard';
import { Link } from 'react-router-dom';
import { BarChart, Bar, CartesianGrid, XAxis, YAxis, Tooltip, Legend, ResponsiveContainer } from 'recharts';
import axios from 'axios';
import { Form, DatePicker, Button } from 'antd';
import moment from 'moment';
import LoadingSkeleton from '../../Loading';

const StatisticAppointment = () => {
    const [appointmentData, setAppointmentData] = useState([]);
    const [date, setDate] = useState(new Date().toISOString().split('T')[0]);
    const token = localStorage.getItem('token');
    const [loading, setLoading] = useState(false);
    const [selectedDuration, setSelectedDuration] = useState(0);
    const [isSelectOpen, setIsSelectOpen] = useState(false);
    const selectRef = useRef(null);

    useEffect(() => {
        const fetchDataAndSetLoading = async () => {
            setLoading(true);
            await fetchData(date || getCurrentDate());
        };
    
        fetchDataAndSetLoading();
    }, [date, token, selectedDuration]);
    

    const getCurrentDate = () => {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };

    const fetchData = async (selectedDate) => {
        try {
            setLoading(true);
            console.log('Loading started...');
    
            const response = await axios.post(
                'http://127.0.0.1:8000/api/filter-appointments-statistics',
                { date: selectedDate, period: selectedDuration }, // Thêm selectedDuration vào body
                {
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: `Bearer ${token}`,
                    },
                }
            );
    
            const result = response.data;
            console.log(result);
            if (result.msg === 'Lọc dữ liệu thành công') {
                setAppointmentData(result.data);
            } else {
                console.error('Lỗi khi lấy dữ liệu thống kê:', result.msg);
                setAppointmentData([]);
            }
        } catch (error) {
            console.error('Lỗi khi gọi API:', error);
        } finally {
            setLoading(false);
            console.log('Loading finished...');
        }
    };
    

    const handleDateChange = (e) => {
        const { value } = e.target;
        console.log(value);
        setDate(value);
    };

    useEffect(() => {
        const handleBodyClick = (e) => {
            if (isSelectOpen && selectRef.current && !selectRef.current.contains(e.target)) {
                resetDurationSelect();
            }
        };

        document.body.addEventListener('click', handleBodyClick);

        return () => {
            document.body.removeEventListener('click', handleBodyClick);
        };
    }, [isSelectOpen]);

    const handleSelectClick = () => {
        setIsSelectOpen(!isSelectOpen);
    };

    const handleDurationChange = (e) => {
        const newDuration = e.target.value;
        setSelectedDuration(isNaN(newDuration) ? 0 : Number(newDuration));
    };

    const resetDurationSelect = () => {
        setSelectedDuration(0);
        setIsSelectOpen(false);
    };


    const handleFilterClick = () => {
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
        'Đã xác nhận': '#00ff00',
        'Đã xóa': '#ffcc00',
        'Đã hủy': '#ff0100',
        'Đã hoàn thành': '#9900cc',
        'Yêu cầu hủy': '#ff6600',
        'Yêu cầu đổi lịch': '#993333',
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
                            <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                            <br />
                                <h2 className="mb-4 ">Thống kê lịch hẹn</h2>
                                <br />
                                <div className="search-container ">
                                    <div className="input-group mb-3 row">
                                        <div className="col-md-6">
                                            <label className=" mb-2" htmlFor="datePicker">
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
                                    </div>
                                    <div className="input-group mb-3 row">
                                        <div className="col-md-6">
                                            <label className="mb-2" htmlFor="datePicker">
                                                Chọn khoảng thời gian:
                                            </label>
                                            <select
                                                id="datePicker"
                                                className="form-select rounded-1"
                                                onChange={handleDurationChange}
                                                value={selectedDuration}
                                                ref={selectRef}
                                                onClick={handleSelectClick}
                                            >
                                                <option value="0" disabled hidden>
                                                    Chọn khoảng thời gian
                                                </option>
                                                <option value="3">3 ngày trước</option>
                                                <option value="5">5 ngày trước</option>
                                                <option value="7">7 ngày trước</option>
                                                <option value="9">9 ngày trước</option>
                                                <option value="15">15 ngày trước</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                                

                                <div className="card card-table mb-0">

                                    <div className="card-body">
                                        <div className="col-md-12">
                                            <br />
                                            <br />

                                            <div className="appointment-tab">

                                                <div className="tab-content">
                                                    {loading ? (
                                                        <LoadingSkeleton />
                                                    ) : (
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
                                                                {/* <Bar dataKey="count" fill="#ff0100" label={(props) => props.value} /> */}

                                                            </BarChart>

                                                        </ResponsiveContainer>
                                                    )}
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