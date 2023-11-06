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
  // const [isNameEditable, setIsNameEditable] = useState(true);
  // const [isPhoneEditable, setIsPhoneEditable] = useState(true);
  const [selectedShift, setSelectedShift] = useState("");

  const [loadingService, setLoadingService] = useState(false);
  const [loadingShift, setLoadingShift] = useState(false);
  const [loadingDoctors, setLoadingDoctors] = useState(false);

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
        setLoadingService(true);
        const response = await BookingApi.getServiceDoctor();
        setServiceDoctor(response.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      } finally {
        setLoadingService(false);
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
      }
    }
  }, [selectedService, serviceDoctor, selectedDoctor]);

  const showModal = () => {
    setIsModalOpen(true);
  };

  const handleCancel = () => {
    form.resetFields();
    setIsModalOpen(false);
  };

  useEffect(() => {
    if (selectedDoctor && selectedDate) {
      fetchWorkingHours(selectedDoctor, selectedDate);
    }
  }, [selectedDoctor, selectedDate]);

  const fetchWorkingHours = async (selectedDoctor, selectedDate) => {
    try {
      setLoadingShift(true);
      const response = await BookingApi.getWorkingHours(
        selectedDoctor,
        selectedDate
      );
      setSelectedWorkingHours(response);
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc:", error);
    } finally {
      setLoadingShift(false);
    }
  };

  const handleChangeDate = async (date, dateString) => {
    setSelectedDate(dateString);
    setSelectedShift(null);
    form.setFieldValue('Chọn Thời Gian', 'Ca làm việc')

    if (selectedService && selectedDoctor) {
      try {
        const response = await BookingApi.getWorkingHours(
          selectedDoctor,
          dateString
        );
        setSelectedWorkingHours(response);
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
        shift_name: selectedShift,
        type_pet_id: selectedPet,
        phone: selectedPhone,
        name: selectedName,
        description: selectedDescription,
      };

      await BookingApi.saveBooking(bookingData);

      form.resetFields();

      MySwal.fire({
        title: "Đặt lịch thành công!",
        icon: "success",
      });

      console.log("Booking successful");
    } catch (error) {
      console.error("Error while booking:", error);
      MySwal.fire({
        title: "Đặt lịch không thành công",
        text: "Vui lòng thử lại sau.",
        icon: "error",
      });
    } finally {
      setIsModalOpen(false);
    }
  };
  const handleDoctorChange = (value) => {
    setSelectedDoctor(value);
    setSelectedShift(null);
    form.setFieldValue('Chọn Thời Gian', 'Ca làm việc')
  };

  const handleChangeService = (value) => {
    setSelectedService(value);
    setSelectedDoctor(null);
    setLoadingDoctors(true);
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

  const handleChangeShift = (value) => {
    setSelectedShift(value);
  };

  const handleChangeDescription = (e) => {
    setSelectedDescription(e.target.value);
  };

  useEffect(() => {
    if (user) {
      setSelectedName(user.name);
      setSelectedPhone(user.phone);
    }
  }, [user]);

  const disabledDate = (current) => {
    const today = moment();
    const oneWeekFromNow = today.clone().add(1, "week");

    return (
      current && (current < today.startOf("day") || current >= oneWeekFromNow)
    );
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
        open={isModalOpen}
        onOk={handleBooking}
        onCancel={handleCancel}
        width={1000}
        okButtonProps={{ style: { display: "none" } }}
        cancelButtonProps={{ style: { display: "none" } }}
      >
        <Form layout="vertical" form={form} onFinish={handleBooking}>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                label="Chọn Dịch Vụ"
                name="Chọn Dịch Vụ"
                rules={[{ required: true, message: "Vui lòng nhập dịch vụ" }]}
              >
                <Select
                  placeholder="Dịch Vụ"
                  value={selectedService}
                  onChange={handleChangeService}
                  options={serviceDoctor.map((service) => ({
                    value: service.id,
                    label: service.name,
                  }))}
                  loading={loadingService}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label="Chọn Bác Sĩ"
                // name="Chọn Bác Sĩ"
                rules={[
                  { required: true, message: "Vui lòng nhập chọn bác sĩ" },
                ]}
                loading={loadingDoctors}
              >
                <Select
                  placeholder="Bác Sĩ"
                  value={selectedDoctor}
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
                rules={[
                  { required: true, message: "Vui lòng nhập chọn ngày" },
                ]}
              >
                <DatePicker
                  placeholder="Ngày"
                  onChange={handleChangeDate}
                  disabledDate={disabledDate}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label="Chọn Thời Gian"
                name="Chọn Thời Gian"
                rules={[
                  { required: true, message: "Vui lòng nhập chọn ca" },
                  {
                    validator: (_, value) => {
                      if (value === 'Ca làm việc') { 
                        return Promise.reject(new Error("Vui lòng chọn ca"));
                      }
                      return Promise.resolve();
                    },
                  },
                ]}
              >
                <Select
                  placeholder="Ca làm việc"
                  onChange={(value) => handleChangeShift(value)} 
                  options={
                    selectedWorkingHours
                      ? selectedWorkingHours.map((hour) => ({
                          value: hour.shift_name,
                          label: loadingShift
                            ? ""
                            : `${hour.shift_name} (${hour.start_time} - ${hour.end_time})`,
                        }))
                      : []
                  }
                  loading={loadingShift}
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
              <Form.Item
                label="Họ và Tên"
                name="name"
                initialValue={user ? user.name : selectedName}
                rules={[
                  { required: true, message: "Vui lòng nhập tên của bạn" },
                  { min: 5, message: "Tên phải lớn hơn 5 kí tự" },
                ]}
              >
                <Input name="name" onChange={handleChangeName} />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label="Số Điện Thoại"
                name="phone"
                initialValue={user ? user.phone : selectedPhone}
                rules={[
                  { required: true, message: "Vui lòng nhập số điện thoại" },
                  {
                    validator: (_, value) => {
                      if (/^\d+$/.test(value)) {
                        if (value.length === 10) {
                          return Promise.resolve();
                        }
                        return Promise.reject(
                          "Số điện thoại phải có 10 chữ số"
                        );
                      }
                      return Promise.reject("Số điện thoại phải là chữ số");
                    },
                  },
                ]}
              >
                <Input name="phone" onChange={handleChangePhone} />
              </Form.Item>
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
