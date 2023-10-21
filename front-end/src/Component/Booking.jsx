import { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select } from "antd";
import BookingApi from "../api/bookingApi";
const { TextArea } = Input;
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { useAuth } from "../Context/ContextAuth";
const MySwal = withReactContent(Swal);
import moment from "moment";

const Booking = () => {
  const { user } = useAuth();
  const [form] = Form.useForm();
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [typePet, setTypePet] = useState([]);
  const [serviceDoctor, setServiceDoctor] = useState([]);
  const [selectedService, setSelectedService] = useState(null);
  const [doctorOptions, setDoctorOptions] = useState([]);
  const [selectedDate, setSelectedDate] = useState(null);
  const [selectedWorkingHours, setSelectedWorkingHours] = useState([]);
  const [selectedDoctor, setSelectedDoctor] = useState(null);
  const [selectedPet, setSelectedPet] = useState(null);
  const [selectedPhone, setSelectedPhone] = useState("");
  const [selectedName, setSelectedName] = useState("");
  const [selectedDescription, setSelectedDescription] = useState("");
  const [isNameEditable, setIsNameEditable] = useState(true);
  const [isPhoneEditable, setIsPhoneEditable] = useState(true);

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
      const selectedServiceData = serviceDoctor.find(
        (service) => service.id === selectedService
      );

      if (selectedServiceData) {
        const doctorsForService = selectedServiceData.doctors || [];
        setDoctorOptions([...doctorsForService]);

        const doctorId =
          doctorsForService.length > 0 ? doctorsForService[0].id : null;

        setSelectedDoctor(doctorId);
     
      }
    }
  }, [selectedService, serviceDoctor]);

  const showModal = () => {
    setIsModalOpen(true);
  };

  const handleCancel = () => {
    setIsModalOpen(false);
  };

  const handleChangeService = (value) => {
    setSelectedService(value);
    setDoctorOptions([]);
    setSelectedDoctor(null);
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
        shift_name:
          selectedWorkingHours.length > 0
            ? selectedWorkingHours[0].shift_name
            : "",
        type_pet_id: selectedPet,
        phone: selectedPhone,
        name: selectedName,
        description: selectedDescription,
      };

      await BookingApi.saveBooking(bookingData);
      MySwal.fire({
        title: "Đặt lịch thành công!",
        icon: "success",
      });

      console.log("Booking successful");
      console.log(bookingData);
    } catch (error) {
      console.error("Error while booking:", error);
      MySwal.fire({
        title: "Đặt lịch không thành công",
        text: "Vui lòng thử lại sau.",
        icon: "error",
      });
    } finally {
      // resetForm();
      setIsModalOpen(false);
    }
  };
  const handleDoctorChange = (value) => {
    setSelectedDoctor(value);
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

  useEffect(() => {
    if (user) {
      setSelectedName(user.name);
      setSelectedPhone(user.phone);

      setIsNameEditable(!user.name);
      setIsPhoneEditable(!user.phone);
    }
  }, [user]);

  const disabledDate = (current) => {
    const today = moment();
    return current && current < today.startOf("day");
  };

  // const resetForm = () => {
  //   setIsModalOpen(false);
  //   setSelectedService([]);
  //   setDoctorOptions([]);
  //   setSelectedDoctor(null);
  //   setSelectedDate(null);
  //   setSelectedWorkingHours([]);
  //   setSelectedPet(null);
  //   // setSelectedPhone("");
  //   // setSelectedName("");
  //   setSelectedDescription("");
  //   setIsNameEditable(true);
  //   setIsPhoneEditable(true);

  //   form.resetFields();
  // };

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
        okButtonProps={{ style: { display: "none" } }}
        cancelButtonProps={{ style: { display: "none" } }}
      >
        <Form layout="vertical" onFinish={handleBooking}>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                label="Chọn Dịch Vụ"
                name="Chọn Dịch Vụ"
                rules={[{ required: true, message: "Vui lòng nhập dịch vụ" }]}
              >
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
              <Form.Item
                label="Chọn Bác Sĩ"
                name="Chọn Bác Sĩ"
                rules={[
                  { required: true, message: "Vui lòng nhập chọn bác sĩ" },
                ]}
              >
                <Select
                  key={selectedService}
                  placeholder="Bác Sĩ"
                  onChange={handleDoctorChange}
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
              <Form.Item
                label="Chọn Ngày"
                name="Chọn Ngày"
                rules={[{ required: true, message: "Vui lòng nhập chọn ngày" }]}
              >
                <DatePicker
                  onChange={handleChangeDate}
                  disabledDate={disabledDate}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label="Chọn Thời Gian"
                name="Chọn Thời Gian"
                rules={[{ required: true, message: "Vui lòng nhập chọn ca" }]}
              >
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
          <Form.Item
            label="Chọn loại thú cưng"
            name="Chọn loại thú cưng "
            rules={[
              { required: true, message: "Vui lòng nhập chọn loại thú cưng" },
            ]}
          >
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
              {user ? (
                <Form.Item
                  label="Họ và Tên"
                  initialValue={user.name}
                  rules={[
                    { required: true, message: "Vui lòng nhập tên của bạn" },
                  ]}
                >
                  <Input
                    value={selectedName}
                    onChange={handleChangeName}
                    disabled={!isNameEditable}
                  />
                </Form.Item>
              ) : (
                <Form.Item
                  label="Họ và Tên"
                  name=""
                  rules={[
                    { required: true, message: "Vui lòng nhập tên của bạn" },
                  ]}
                >
                  <Input
                    name="name"
                    value={selectedName}
                    onChange={handleChangeName}
                    disabled={!isNameEditable}
                  />
                </Form.Item>
              )}
            </Col>
            <Col span={12}>
              {user ? (
                <Form.Item
                  label="Số Điện Thoại"
                  rules={[
                    { required: true, message: "Vui lòng nhập số điện thoại" },
                    {
                      pattern: /^[0-9]{10}$/,
                      message: "Số điện thoại phải có 10 chữ số",
                    },
                  ]}
                >
                  <Input
                    type=""
                    name="phone"
                    value={selectedPhone}
                    onChange={handleChangePhone}
                    disabled={!isPhoneEditable}
                  />
                </Form.Item>
              ) : (
                <Form.Item
                  label="Số Điện Thoại"
                  name=""
                  rules={[
                    { required: true, message: "Vui lòng nhập số điện thoại" },
                    {
                      pattern: /^[0-9]{10}$/,
                      message: "Số điện thoại phải có 10 chữ số",
                    },
                  ]}
                >
                  <Input
                    type=""
                    name="phone"
                    value={selectedPhone}
                    onChange={handleChangePhone}
                    disabled={!isPhoneEditable}
                  />
                </Form.Item>
              )}
            </Col>
          </Row>
          <Form.Item
            label="Ghi Chú"
            name="Ghi Chú"
            rules={[{ required: true, message: "Vui lòng nhập ghi chú" }]}
          >
            <TextArea rows={3} onChange={handleChangeDescription} />
          </Form.Item>
          <Button type="primary" htmlType="submit">
            Đặt lịch
          </Button>
        </Form>
      </Modal>
    </>
  );
};

export default Booking;
