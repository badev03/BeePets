import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer,
} from 'recharts';
import axios from 'axios';
import { Form, DatePicker, Button } from 'antd';
import moment from 'moment';
import Menudashboard from './Menu-dashboard';

const StatisticalPet = () => {
  const [appointmentData, setAppointmentData] = useState([]);
  const [date, setDate] = useState(new Date().toISOString().split('T')[0]);
  const token = localStorage.getItem('token');
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const fetchDataAndSetLoading = async () => {
      setLoading(true);
      await fetchData(date || getCurrentDate());
      setLoading(false);
    };

    fetchDataAndSetLoading();
  }, [date, token]);

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
      console.log('Bắt đầu tải dữ liệu...');

      const response = await axios.post(
        'http://127.0.0.1:8000/api/statistic-type-pet',
        { date: selectedDate },
        {
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${token}`,
          },
        }
      );

      console.log('Toàn bộ phản hồi:', response); // In toàn bộ đối tượng phản hồi

      const result = response.data;
      console.log('Kết quả:', result);
      console.log(result.msg);

      if (result.msg === 'Lọc dữ liệu thành công') {
        setAppointmentData(result.data);
      } else {
        console.error('Lỗi khi lấy dữ liệu thống kê:', result ? result.msg : 'Không xác định');
      }
    } catch (error) {
      console.error('Lỗi khi gọi API:', error);
    } finally {
      setLoading(false);
      console.log('Kết thúc tải dữ liệu...');
    }
  };


  const handleDateChange = (e) => {
    const newDate = e.target.value;
    console.log(newDate);
    setDate(newDate);
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

  const getStatusLabel = (status) => statusLabels[status] || 'Không xác định';

  const prepareChartData = () => {
    if (loading) {
      return [];
    }
    if (appointmentData.length === 0) {
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
      {/* ... (Assuming the breadcrumb part is correct) */}

      {/* Phần nội dung */}
      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
              <Menudashboard />
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="row">
                <div className="card card-table mb-0">
                  <div className="card-body">
                    <div className="col-md-12">
                      <br />
                      <h4 className="mb-4">Thống kê lịch hẹn</h4>
                      <div className="appointment-tab">
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
                              className="input-group-text rounded-2"
                              max={new Date().toISOString().split('T')[0]}
                            />
                            <button
                              className="btn btn-primary rounded-2"
                              onClick={handleFilterClick}
                            >
                              Lọc
                            </button>
                          </div>
                        </div>
                        <div className="tab-content">
                          <ResponsiveContainer width="100%" aspect={3}>
                            <BarChart
                              key={JSON.stringify(prepareChartData())}
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
        </div>
      </div>
    </div>
  );
};

export default StatisticalPet;