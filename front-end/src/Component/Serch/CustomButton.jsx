import { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select } from "antd";
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

    const [fetchedData, setFetchedData] = useState(null);
    useEffect(() => {
        const fetchServiceDoctor = async () => {
            try {
                const response = await axios.post(
                    `http://127.0.0.1:8000/api/doctor-service?doctor_id=${doctorId}`,
                    {}
                );
                console.log(response.data);
                // Lưu trữ dữ liệu vào state nếu response.data không rỗng
                if (response.data) {
                    setFetchedData(response.data);
                }
            } catch (error) {
                console.error("Có lỗi xảy ra khi lấy dữ liệu bác sĩ:", error);
            }
        };

        if (doctorId) {
            fetchServiceDoctor();
        }
    }, [doctorId]);
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
        const selectedServiceData = fetchedData.data[0].services.find(
            (service) => service.id === value
        );
        if (selectedServiceData) {
            setSelectedService(selectedServiceData.id);
        }

    };

    const handleChange = (value) => {
        console.log(`selected ${value}`);
    };

    useEffect(() => {
        if (fetchedData && selectedDate) {
            fetchWorkingHours(doctorId, selectedDate);
        }
    }, [doctorId, selectedDate]);

    const fetchWorkingHours = async (doctorId, selectedDate) => {
        try {
            const response = await BookingApi.getWorkingHours(
                doctorId,
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
            if (!selectedPet) {
                throw new Error("Vui lòng chọn loại thú cưng");
            }
            const bookingData = {
                service_id: selectedService,
                doctor_id: doctorId,
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

            console.log("Đặt lịch thành công");
        } catch (error) {
            console.error("Lỗi khi đặt lịch:", error);
            MySwal.fire({
                title: "Đặt lịch không thành công",
                text: error.message,
                icon: "error",
            });
        } finally {
            resetForm();
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
        return current && current < today.startOf('day');
    };

    const resetForm = () => {
        setIsModalOpen(false);
        setSelectedService([]);
        setDoctorOptions([]);
        setFetchedData(null);
        setSelectedDate(null);
        setSelectedWorkingHours([]);
        setSelectedPet(null);
        setSelectedPhone("");
        setSelectedName("");
        setSelectedDescription("");
        setIsNameEditable(true);
        setIsPhoneEditable(true);

        form.resetFields();
    };

    const buttonStyle = {
        color: 'white', // Màu chữ trắng
        textDecoration: 'none', // Loại bỏ gạch chân dưới
        backgroundColor: '#20c0f3', // Màu nền xanh
        width: '200px', // Độ rộng 200px
        height: '50px', // Chiều cao 50px
        marginTop: '10px', // Khoảng cách trên 10px
    };

    return (
        <>
            <button className="btn btn-link " style={buttonStyle} onClick={showModal}>
                Đặt lịch hẹn
            </button>
            <Modal
                title="Hãy Điền Thông Tin"
                visible={isModalOpen}
                onOk={handleBooking}
                onCancel={handleCancel}
                width={1000}
                okButtonProps={{ style: { display: "none" } }}
                cancelButtonProps={{ style: { display: "none" } }}
            >
                <Form layout="vertical" onFinish={handleBooking} form={form}>
                    <Row gutter={16}>
                        <Col span={12}>
                            {fetchedData && fetchedData.data && fetchedData.data.length > 0 && (
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
                            {fetchedData && fetchedData.data && fetchedData.data[0].services && (
                                <Form.Item
                                    label="Chọn Dịch Vụ"
                                    rules={[{ required: true, message: "Vui lòng nhập dịch vụ" }]}
                                >
                                    <Select
                                        // key={selectedService}
                                        placeholder="Dịch Vụ"
                                        onChange={handleChangeService}
                                        options={fetchedData.data[0].services.map((service) => ({
                                            value: service.id,
                                            label: service.name,
                                        }))}
                                    />
                                </Form.Item>
                            )}
                        </Col>

                    </Row>
                    <Row gutter={16}>
                        <Col span={12}>
                            <Form.Item
                                label="Chọn Ngày"
                                rules={[{ required: true, message: "Vui lòng nhập chọn ngày" }]}
                            >
                                <DatePicker onChange={handleChangeDate} disabledDate={disabledDate} />
                            </Form.Item>
                        </Col>
                        <Col span={12}>
                            <Form.Item
                                label="Chọn Thời Gian"
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
                        </Col>
                        <Col span={12}>
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
                                    value={selectedPhone}
                                    onChange={handleChangePhone}
                                    disabled={!isPhoneEditable}
                                />
                            </Form.Item>
                        </Col>
                    </Row>
                    <Form.Item
                        label="Ghi Chú"
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
