import { useEffect, useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Select } from "antd";
const { TextArea } = Input;
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { useAuth } from "../../Context/ContextAuth";
const MySwal = withReactContent(Swal);
import moment from 'moment';
import BookingApi from "../../api/bookingApi";



const BookingUser = () => {
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
                setLoadingService(false)
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

            setIsNameEditable(!user.name);
            setIsPhoneEditable(!user.phone);
        }
    }, [user]);

    const disabledDate = (current) => {
        const today = moment();
        return current && current < today.startOf("day");
    };

    return (
        <>
            <a
                onClick={showModal}
            >
                ĐẶT LỊCH NHANH
            </a>
            <Modal
                title="Hãy Điền Thông Tin"
                open={isModalOpen}
                onOk={handleBooking}
                onCancel={handleCancel}
                width={1000}
                okButtonProps={{ style: { display: "none" } }}
                cancelButtonProps={{ style: { display: "none" } }}
            >
                <Form layout="vertical" form={form} onFinish={handleBooking} >
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
                                name="Chọn Bác Sĩ"
                                rules={[
                                    { required: true, message: "Vui lòng nhập chọn bác sĩ" },
                                ]}
                                loading={loadingDoctors}
                            >
                                <Select
                                    key={selectedService}
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
                                name={user ? undefined : "name"}
                                rules={[
                                    { required: true, message: "Vui lòng nhập tên của bạn" },
                                ]}
                            >
                                <Input
                                    value={selectedName}
                                    name="name"
                                    onChange={handleChangeName}
                                    disabled={!isNameEditable}
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
                                    disabled={!isPhoneEditable}
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

export default BookingUser;