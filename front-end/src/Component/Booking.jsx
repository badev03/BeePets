// import { useEffect, useState } from "react";
// import { Modal, Button, DatePicker, Form, Input, Row, Col, Radio, Select } from "antd";
// import BookingApi from "../api/bookingApi";
// const { TextArea } = Input;

// const Booking = () => {
//   const [isModalOpen, setIsModalOpen] = useState(false);
//   const [typePet, setTypePet] = useState([]);
//   const [serviceDoctor, setServiceDoctor] = useState([]);
//   const [selectedService, setSelectedService] = useState(null);
//   const [doctorOptions, setDoctorOptions] = useState([]);
//   const [selectedDate, setSelectedDate] = useState(null);
//   const [workingHours, setWorkingHours] = useState([]);

//   useEffect(() => {
//     const fetchTypePet = async () => {
//       try {
//         const response = await BookingApi.getTypePet();
//         setTypePet(response.data);
//       } catch (error) {
//         console.error("Không có dữ liệu:", error);
//       }
//     };

//     fetchTypePet();
//   }, []);

//   useEffect(() => {
//     const fetchServiceDoctor = async () => {
//       try {
//         const response = await BookingApi.getServiceDoctor();
//         setServiceDoctor(response.data);
//       } catch (error) {
//         console.error("Không có dữ liệu:", error);
//       }
//     };

//     fetchServiceDoctor();
//   }, []);

//   useEffect(() => {
//     if (selectedService) {
//       const doctorsForService = serviceDoctor.find(service => service.id === selectedService)?.doctors || [];
//       setDoctorOptions(doctorsForService);
//     }
//   }, [selectedService, serviceDoctor]);

//   const showModal = () => {
//     setIsModalOpen(true);
//   };

//   const handleOk = () => {
//     setIsModalOpen(false);
//   };

//   const handleCancel = () => {
//     setIsModalOpen(false);
//   };

//   const handleChangeService = (value) => {
//     setSelectedService(value);
//     setDoctorOptions([]);
//   };

//   const handleChange = (value) => {
//     console.log(`selected ${value}`);
//   };

//   useEffect(() => {
//     if (selectedService && selectedDate) {
//       fetchWorkingHours(selectedService, selectedDate);
//     }
//   }, [selectedService, selectedDate]);

//   const fetchWorkingHours = async (selectedService, selectedDate) => {
//     try {
//       const response = await BookingApi.getWorkingHours(selectedService, selectedDate);
//       // setWorkingHours(response.data);
//       console.log(response);
//     } catch (error) {
//       console.error("Không có dữ liệu ca làm việc:", error);
//     }
//   };

//   const handleChangeDate = (date, dateString) => {
//     setSelectedDate(dateString);
//   };

//   return (
//     <>
//       <Button
//         size="large"
//         type="primary"
//         style={{ width: 250, height: 60, fontSize: 28 }}
//         onClick={showModal}
//       >
//         Đặt Lịch Nhanh
//       </Button>
//       <Modal
//         title="Hãy Điền Thông Tin"
//         visible={isModalOpen} 
//         onOk={handleOk}
//         onCancel={handleCancel}
//         width={1000}
//         okText="Đặt Lịch"
//         cancelText="Hủy"
//       >
//         <Form layout="vertical">
//           <Row gutter={16}>
//             <Col span={12}>
//               <Form.Item label="Chọn Dịch Vụ">
//                 <Select
//                   placeholder="Dịch Vụ"
//                   onChange={handleChangeService}
//                   options={serviceDoctor.map(service => ({ value: service.id, label: service.name }))}
//                 />
//               </Form.Item>
//             </Col>
//             <Col span={12}>
//               <Form.Item label="Chọn Bác Sĩ">
//                 <Select
//                 key={selectedService} 
//                   placeholder="Bác Sĩ"
//                   onChange={handleChange}
//                   options={doctorOptions.map(doctor => ({ value: doctor.id, label: doctor.name }))}
//                 />
//               </Form.Item>
//             </Col>
//           </Row>
//           <Row gutter={16}>
//             <Col span={12}>
//               <Form.Item label="Chọn Ngày">
//                 <DatePicker onChange={handleChangeDate}/>
//               </Form.Item>
//             </Col>
//             <Col span={12}>
//               <Form.Item label="Chọn Thời Gian">
//                 {/* <Radio.Group buttonStyle="solid">
//                   <Radio.Button value="a">Ca 1 (08:00 - 12:00)</Radio.Button>
//                   <Radio.Button value="b">Ca 2 (13:00 - 17:00)</Radio.Button>
//                   <Radio.Button value="c">Ca 3 (08:00 - 20:00)</Radio.Button>
//                 </Radio.Group> */}
//                 <Select
//                   placeholder="Ca làm việc"
//                   onChange={handleChange}
//                   options={workingHours.map(hour => ({ value: hour.id, label: `${hour.shift_name} (${hour.start_time} - ${hour.end_time})` }))}
//                 />
//               </Form.Item>
//             </Col>
//           </Row>
//           <Form.Item label="Chọn loại thú cưng">
//             <Select
//               placeholder="Thú cưng"
//               onChange={handleChange}
//               options={typePet.map(pet => ({ value: pet.id, label: pet.name }))}
//             />
//           </Form.Item>
//           <Row gutter={16}>
//             <Col span={12}>
//               <Form.Item label="Họ và Tên">
//                 <Input />
//               </Form.Item>
//             </Col>
//             <Col span={12}>
//               <Form.Item label="Số Điện Thoại">
//                 <Input type="" />
//               </Form.Item>
//             </Col>
//           </Row>
//           <Form.Item label="Ghi Chú">
//             <TextArea rows={3} />
//           </Form.Item>
//         </Form>
//       </Modal>
//     </>
//   );
// };

// export default Booking;

import React, { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select } from "antd";
import BookingApi from "../api/bookingApi";
const { TextArea } = Input;

const Booking = () => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [typePet, setTypePet] = useState([]);
  const [serviceDoctor, setServiceDoctor] = useState([]);
  const [selectedService, setSelectedService] = useState(null);
  const [doctorOptions, setDoctorOptions] = useState([]);
  const [selectedDate, setSelectedDate] = useState(null);
  const [workingHours, setWorkingHours] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const typePetResponse = await BookingApi.getTypePet();
        const serviceDoctorResponse = await BookingApi.getServiceDoctor();
        
        setTypePet(typePetResponse.data);
        setServiceDoctor(serviceDoctorResponse.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchData();
  }, []);

  useEffect(() => {
    if (selectedService) {
      const doctorsForService = serviceDoctor.find(service => service.id === selectedService)?.doctors || [];
      if (doctorsForService.length > 0) {
        setDoctorOptions(doctorsForService);
      } else {
        setDoctorOptions([]);
      }
    }
  }, [selectedService, serviceDoctor]);

  const showModal = () => {
    setIsModalOpen(true);
  };

  const handleOk = () => {
    setIsModalOpen(false);
  };

  const handleCancel = () => {
    setIsModalOpen(false);
  };

  const handleChangeService = (value) => {
    setSelectedService(value);
    setDoctorOptions([]);
  };

  const handleChange = (value) => {
    console.log(`selected ${value}`);
  };

  useEffect(() => {
    if (selectedService && selectedDate) {
      fetchWorkingHours(selectedService, selectedDate);
    }
  }, [selectedService, selectedDate]);

  const fetchWorkingHours = async (selectedService, selectedDate) => {
    try {
      const response = await BookingApi.getWorkingHours(selectedService, selectedDate);
      const workingHoursData = response.data;

      console.log("workingHoursData:", workingHoursData);

      setWorkingHours(workingHoursData);
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc:", error);
    }
  };

  const handleChangeDate = (date, dateString) => {
    setSelectedDate(dateString);
    fetchWorkingHours(selectedService, dateString);
  };

  return (
    <>
      <Button
        size="large"
        type="primary"
        style={{ width: 250, height: 60, fontSize: 28 }}
        onClick={showModal}
      >
        Đặt Lịch Nhanh
      </Button>
      <Modal
        title="Hãy Điền Thông Tin"
        visible={isModalOpen} 
        onOk={handleOk}
        onCancel={handleCancel}
        width={1000}
        okText="Đặt Lịch"
        cancelText="Hủy"
      >
        <Form layout="vertical">
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chọn Dịch Vụ">
                <Select
                  placeholder="Dịch Vụ"
                  onChange={handleChangeService}
                  options={serviceDoctor.map(service => ({ value: service.id, label: service.name }))}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Chọn Bác Sĩ">
                <Select
                  key={selectedService} 
                  placeholder="Bác Sĩ"
                  onChange={handleChange}
                  options={doctorOptions.map(doctor => ({ value: doctor.id, label: doctor.name }))}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chọn Ngày">
                <DatePicker onChange={handleChangeDate}/>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Chọn Thời Gian">
                <Select
                  placeholder="Ca làm việc"
                  onChange={handleChange}
                  options={workingHours.map(hour => ({ value: hour.id, label: `${hour.shift_name} (${hour.start_time} - ${hour.end_time})` }))}
                />
              </Form.Item>
            </Col>
          </Row>
          {/* Các Form.Item khác ở đây */}
        </Form>
      </Modal>
    </>
  );
};

export default Booking;

