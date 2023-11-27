// src/components/PetStatsChart.js
import React, { useEffect, useState } from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import {
  BarChart,
  Bar,
  CartesianGrid,
  XAxis,
  YAxis,
  Tooltip,
  Legend,
  ResponsiveContainer,
} from "recharts";
import axios from "axios";
import { DatePicker, Button } from "antd";
import moment from "moment";

const StatisticalPet = () => {
  const [petData, setPetData] = useState({});
  const [date, setDate] = useState(new Date().toISOString().split("T")[0]);

  useEffect(() => {
    fetchData();
  }, [date]);

  const fetchData = () => {
    axios
      .post(`http://127.0.0.1:8000/api/statistic-type-pet?date=${date}`)
      .then((response) => {
        const data = response.data;
        console.log(data);
        const petDataObject = {};
        data.forEach((item) => {
          petDataObject[item.name] = item.total;
        });
        setPetData(petDataObject);
      })
      .catch((error) => {
        console.error("Lỗi khi truy vấn dữ liệu thú cưng:", error);
      });
  };

  const handleDateChange = (value) => {
    setDate(value.format("YYYY-MM-DD"));
  };

  const handleFilterClick = () => {
    fetchData();
  };

  const prepareChartData = () => {
    return Object.keys(petData).map((name) => ({
      name,
      total: petData[name],
    }));
  };

  return (
    <div>
      {/* Phần breadcrumb */}
      {/* ... (Giả sử phần breadcrumb là đúng) */}

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
                      <h4 className="mb-4">Thống kê thú cưng</h4>
                      <div className="appointment-tab">
                        <div className="search-container">
                          <div className="input-group mb-3">
                            <label className=" rounded-2" htmlFor="datePicker">
                              Chọn ngày:
                            </label>
                            <DatePicker
                              id="datePicker"
                              value={moment(date, "YYYY-MM-DD")}
                              onChange={handleDateChange}
                              className="input-group-text rounded-2"
                              max={moment().format("YYYY-MM-DD")}
                            />
                            <Button
                              className="btn btn-primary rounded-2"
                              onClick={handleFilterClick}
                            >
                              Lọc
                            </Button>
                          </div>
                        </div>
                        <div className="tab-content">
                          <ResponsiveContainer width="100%" aspect={3}>
                            <BarChart
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
                              <XAxis dataKey="name" />
                              <YAxis />
                              <Tooltip />
                              <Legend />
                              <Bar
                                dataKey="total"
                                fill="#009efb"
                                label={(props) => props.value}
                              />
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
