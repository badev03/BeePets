import { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select } from "antd";
import BookingApi from "../api/bookingApi";
const { TextArea } = Input;
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
const MySwal = withReactContent(Swal);

const Booking = () => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [typePet, setTypePet] = useState([]);
  const [serviceDoctor, setServiceDoctor] = useState([]);
  const [selectedService, setSelectedService] = useState(null);
  const [doctorOptions, setDoctorOptions] = useState([]);
  const [selectedDate, setSelectedDate] = useState(null);
  const [selectedWorkingHours, setSelectedWorkingHours] = useState([]);
  const [selectedDoctor, setSelectedDoctor] = useState(null);
  const [selectedPet, setSelectedPet] = useState(null);
const [selectedPhone, setSelectedPhone] = useState('');
const [selectedName, setSelectedName] = useState('');
const [selectedDescription, setSelectedDescription] = useState('');

  useEffect(() => {
    const fetchTypePet = async () => {
      try {
        const response = await BookingApi.getTypePet();
        setTypePet(response.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchTypePet();
  }, []);

  useEffect(() => {
    const fetchServiceDoctor = async () => {
      try {
        const response = await BookingApi.getServiceDoctor();
        setServiceDoctor(response.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchServiceDoctor();
  }, []);

  useEffect(() => {
    if (selectedService) {
      const doctorsForService =
        serviceDoctor.find((service) => service.id === selectedService)
          ?.doctors || [];
      setDoctorOptions(doctorsForService);

      const selectedServiceData = serviceDoctor.find(
        (service) => service.id === selectedService
      );
      const doctorId = selectedServiceData?.doctors[0]?.id || null;
      setSelectedDoctor(doctorId);
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
    if (selectedDoctor && selectedDate) {
      fetchWorkingHours(selectedDoctor, selectedDate);
    }
  }, [selectedDoctor, selectedDate]);

  const fetchWorkingHours = async (selectedDoctor, selectedDate) => {
    try {
      const response = await BookingApi.getWorkingHours(
        selectedDoctor,
        selectedDate
      );
      setSelectedWorkingHours(response);
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc:", error);
    }
  };

  const handleChangeDate = async (date, dateString) => {
    setSelectedDate(dateString);

    if (selectedService) {
      try {
        const response = await BookingApi.getWorkingHours(
          selectedDoctor,
          dateString
        );
        setSelectedWorkingHours(response.data);
      } catch (error) {
        console.error("Không có dữ liệu ca làm việc:", error);
      }
    }
  };

  const handleBooking = async () => {
    try {
      const bookingData = {
        service_id: selectedService,
        doctor_id: selectedDoctor,
        date: selectedDate,
        status: 0,
        shift_name: selectedWorkingHours.length > 0 ? selectedWorkingHours[0].shift_name : '', 
        type_pet_id: selectedPet, 
        phone: selectedPhone, 
        name: selectedName, 
        description: selectedDescription, 
      };

      console.log('Booking data:', bookingData);
  
      await BookingApi.saveBooking(bookingData);
      MySwal.fire({
        title: 'Đặt lịch thành công!',
        icon: 'success',
      });

      console.log('Booking successful');
    } catch (error) {
      console.error('Error while booking:', error);
      MySwal.fire({
        title: 'Đặt lịch không thành công',
        text: 'Vui lòng thử lại sau.',
        icon: 'error',
      });
    } finally {
      setIsModalOpen(false);
    }
  };
  
  const handleChangePet = (value) => {
    setSelectedPet(value);
  };
  
  const handleChangePhone = (e) => {
    setSelectedPhone(e.target.value);
  };
  
  const handleChangeName = (e) => {
    setSelectedName(e.target.value);
  };
  
  const handleChangeDescription = (e) => {
    setSelectedDescription(e.target.value);
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
        onOk={handleBooking}
        onCancel={handleCancel}
        width={1000}
        okText="Đặt Lịch"
        cancelText="Hủy"
        // onClick={handleBooking}
      >
        <Form layout="vertical" >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chọn Dịch Vụ">
                <Select
                  placeholder="Dịch Vụ"
                  onChange={handleChangeService}
                  options={serviceDoctor.map((service) => ({
                    value: service.id,
                    label: service.name,
                  }))}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Chọn Bác Sĩ">
                <Select
                  key={selectedService}
                  placeholder="Bác Sĩ"
                  onChange={handleChange}
                  options={doctorOptions.map((doctor) => ({
                    value: doctor.id,
                    label: doctor.name,
                  }))}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chọn Ngày">
                <DatePicker onChange={handleChangeDate} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Chọn Thời Gian">
                <Select
                  placeholder="Ca làm việc"
                  onChange={handleChange}
                  options={
                    selectedWorkingHours
                      ? selectedWorkingHours.map((hour) => ({
                          value: hour.id,
                          label: `${hour.shift_name} (${hour.start_time} - ${hour.end_time})`,
                        }))
                      : []
                  }
                />
              </Form.Item>
            </Col>
          </Row>
          <Form.Item label="Chọn loại thú cưng">
            <Select
              placeholder="Thú cưng"
              onChange={handleChangePet}
              options={typePet.map((pet) => ({
                value: pet.id,
                label: pet.name,
              }))}
            />
          </Form.Item>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Họ và Tên">
                <Input name="name" onChange={handleChangeName}/>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Số Điện Thoại">
                <Input type="" name="phone" onChange={handleChangePhone}/>
              </Form.Item>
            </Col>
          </Row>
          <Form.Item label="Ghi Chú">
            <TextArea rows={3} onChange={handleChangeDescription}/>
          </Form.Item>
        </Form>
      </Modal>
    </>
  );
};

export default Booking;
