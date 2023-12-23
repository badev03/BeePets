import { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select, Result } from "antd";
import BookingApi from "../../api/bookingApi";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { useAuth } from "../../Context/ContextAuth";
import moment from "moment";
import axios from "axios";
const { TextArea } = Input;

const MySwal = withReactContent(Swal);

const CustomButton = ({ doctorId, handleBookingg }) => {
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
  const [fetchedData, setFetchedData] = useState(null);
  useEffect(() => {
    const fetchServiceDoctor = async () => {
      try {
        setLoadingService(true);
        const response = await axios.post(
          `https://beepets.id.vn/api/doctor-service?doctor_id=${doctorId}`,
          {}
        );
        // console.log(response.data);
        // Lưu trữ dữ liệu vào state nếu response.data không rỗng
        if (response.data) {
          setFetchedData(response.data);
        }
      } catch (error) {
        console.error("Có lỗi xảy ra khi lấy dữ liệu bác sĩ:", error);
      } finally {
        setLoadingService(false);
      }
    };

    if (doctorId) {
      fetchServiceDoctor();
    }
  }, [doctorId]);

  //   useEffect(() => {
  //     const fetchServiceDoctor = async () => {
  //       try {
  //         setLoadingService(true);
  //         const response = await BookingApi.getServiceDoctor();
  //         setServiceDoctor(response.data);
  //       } catch (error) {
  //         console.error("Không có dữ liệu:", error);
  //       } finally {
  //         setLoadingService(false)
  //       }
  //     };

  //     fetchServiceDoctor();
  //   }, []);

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

        setFetchedData(doctorId);

        if (!doctorsForService.some((doctor) => doctor.id === selectedDoctor)) {
          setSelectedDoctor(null);
        }
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
    if (fetchedData && selectedDate) {
      fetchWorkingHours(doctorId, selectedDate);
    }
  }, [doctorId, selectedDate]);

  const fetchWorkingHours = async (doctorId, selectedDate) => {
    try {
      setLoadingShift(true);
      const response = await BookingApi.getWorkingHours(doctorId, selectedDate);
      setSelectedWorkingHours(response);
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc:", error);
    } finally {
      setLoadingShift(false);
    }
  };

  const handleChangeDate = async (date, dateString) => {
    setSelectedDate(dateString);

    if (selectedService) {
      try {
        const response = await BookingApi.getWorkingHours(
          fetchedData,
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
        doctor_id: doctorId,
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
  // const handleDoctorChange = (value) => {
  //     setSelectedDoctor(value);
  // };

  const handleChangeService = (value) => {
    setSelectedService(value);
    setSelectedDoctor(null);
    setLoadingDoctors(true);
    const selectedServiceData = fetchedData.data[0].services.find(
      (service) => service.id === value
    );
    if (selectedServiceData) {
      setSelectedService(selectedServiceData.id);
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
  const CustomNotFoundDoctor = (
    <Result
    
    style={{ height: '50px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center' }}
      title="Không tìm thấy bác sĩ"
      icon={null}
      subTitle="Rất tiếc, không có bác sĩ nào khớp với tìm kiếm của bạn."
    />
  );
  const CustomNotFoundService = (
    <Result
    
    style={{ height: '50px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center' }}
      title="Không tìm thấy dịch vụ"
      icon={null}
      subTitle="Rất tiếc, không có dịch vụ nào khớp với tìm kiếm của bạn."
    />
  );
  const CustomNotFoundPets = (
    <Result
    
    style={{ height: '50px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center' }}
      title="Không tìm thấy thú cưng"
      icon={null}
      subTitle="Rất tiếc, không có thú cưng nào khớp với tìm kiếm của bạn."
    />
  );
  const CustomNotFoundTime = (
    <Result
    
    style={{ height: '50px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center' }}
      title="Không tìm thấy ca làm việc"
      icon={null}
      subTitle="Rất tiếc, không có ca làm việc nào khớp với tìm kiếm của bạn."
    />
    )
  const disabledDate = (current) => {
    const today = moment();
    return current && current < today.startOf("day");
  };
  const buttonStyle = {
    color: "white", // Màu chữ trắng
    textDecoration: "none", // Loại bỏ gạch chân dưới
    backgroundColor: "#20c0f3", // Màu nền xanh
    width: "200px", // Độ rộng 200px
    height: "50px", // Chiều cao 50px
    marginTop: "10px", // Khoảng cách trên 10px
  };
  return (
    <>
      <Button className="btn btn-link " style={buttonStyle} onClick={showModal}>
        Đặt Lịch hẹn
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
        {fetchedData &&
                fetchedData.data &&
                fetchedData.data[0].services && (
                  <Form.Item
                  label="Chọn Dịch Vụ"
                  name="Chọn Dịch Vụ"
                  mode="multiple"
          
                  allowClear
                  rules={[{ required: true, message: "Vui lòng nhập dịch vụ" }]}
              >
                    <Select
                      style={{height:33}}
                      notFoundContent={CustomNotFoundService}
                      placeholder="Dịch Vụ"
                      mode="multiple"
                     
                      allowClear
                      value={selectedService}
                      onChange={handleChangeService}
                      options={fetchedData.data[0].services.map((service) => ({
                        value: service.id,
                        label: service.name,
                      }))}
                      loading={loadingService}
                    />
                  </Form.Item>
                )}
          <Row gutter={16}>
            <Col span={12}>
              {fetchedData &&
                fetchedData.data &&
                fetchedData.data.length > 0 && (
                  <Form.Item
                    label="Bác sĩ"
                    rules={[
                      { required: true, message: "Vui lòng nhập chọn bác sĩ" },
                    ]}
                  >
                    <Input
                      value={fetchedData.data[0].name}
                      placeholder={fetchedData.data[0].name}
                      onChange={handleChangeName}
                      disabled
                    />
                  </Form.Item>
                )}
            </Col>
            <Col span={12}>
              <Form.Item
              
                label="Chọn Ngày"
                name="Chọn Ngày"
                rules={[{ required: true, message: "Vui lòng nhập chọn ngày" }]}
              >
                <DatePicker
                style={{width:'100%'}}
                  onChange={handleChangeDate}
                  disabledDate={disabledDate}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
        
            <Col span={12}>
              <Form.Item
                label="Chọn Thời Gian"
                name="Chọn Thời Gian"
                rules={[{ required: true, message: "Vui lòng nhập chọn ca" }]}
              >
                <Select
                      notFoundContent={CustomNotFoundTime}

                  placeholder="Ca làm việc"
                  onChange={(value) => handleChangeShift(value)}
                  options={
                    selectedWorkingHours
                      ? selectedWorkingHours.map((hour) => ({
                          value: hour.shift_name,
                          label: `${hour.shift_name} (${hour.start_time} - ${hour.end_time})`,
                        }))
                      : []
                  }
                  loading={loadingShift}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
                <Form.Item
                    label="Chọn loại thú cưng"
                    name="Chọn loại thú cưng "
                    rules={[
                      { required: true, message: "Vui lòng nhập chọn loại thú cưng" },
                    ]}
                >
                  <Select
               style={{height:33}}
                      notFoundContent={CustomNotFoundPets}
                      placeholder="Thú cưng"
                      mode="multiple"
                
                      allowClear
                      onChange={handleChangePet}
                      options={typePet.map((pet) => ({
                        value: pet.id,
                        label: pet.name,
                      }))}
                  />
                </Form.Item>
              </Col>
          </Row>
         
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                label="Họ và Tên"
                name={user ? undefined : "name"}
                rules={[
                  { required: true, message: "Vui lòng nhập tên của bạn" },
                ]}
              >
                <Input
                  value={selectedName}
                  name="name"
                  onChange={handleChangeName}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                label="Số Điện Thoại"
                name={user ? undefined : "phone"}
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
                  value={selectedPhone}
                  onChange={handleChangePhone}
                />
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

export default CustomButton;
