import { useState } from "react";
import {Modal, Button,DatePicker,Form,Input,Row,Col,Radio,Select} from "antd";
const { TextArea } = Input;


const Booking = () => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const showModal = () => {
    setIsModalOpen(true);
  };
  const handleOk = () => {
    setIsModalOpen(false);
  };
  const handleCancel = () => {
    setIsModalOpen(false);
  };

  const handleChange = (value) => {
    console.log(`selected ${value}`);
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
        onOk={handleOk}
        onCancel={handleCancel}
        width={900}
        okText="Đặt Lịch"
        cancelText="Hủy"
      >
        <Form layout="vertical">
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chọn Dịch Vụ">
                <Select
                  defaultValue="Khám Bệnh"
                  onChange={handleChange}
                  options={[
                    { value: "Khám Bệnh", label: "Khám Bệnh" },
                    { value: "Chữa Bệnh", label: "Chữa Bệnh" },
                    { value: "Spa", label: "Spa" },
                  ]}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Chọn Bác Sĩ">
                <Select
                  defaultValue="Thiều"
                  onChange={handleChange}
                  options={[
                    { value: "Thiều", label: "Thiều" },
                    { value: "Anh Bá", label: "Anh Bá" },
                    { value: "Khánh", label: "Khánh" },
                  ]}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={5}>
              <Form.Item label="Chọn Ngày">
                <DatePicker />
              </Form.Item>
            </Col>
            <Col span={19}>
              <Form.Item label="Chọn Thời Gian">
                <Radio.Group defaultValue="a" buttonStyle="solid">
                  <Radio.Button value="a">Ca 1 (08:00 - 12:00)</Radio.Button>
                  <Radio.Button value="b">Ca 2 (13:00 - 17:00)</Radio.Button>
                  <Radio.Button value="c">Ca 3 (08:00 - 20:00)</Radio.Button>
                </Radio.Group>
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label=" Họ và Tên">
                <Input />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label=" Số Điện Thoại">
                <Input type="" />
              </Form.Item>
            </Col>
          </Row>
          <Form.Item label="Chọn loại thú cưng">
            <Select
              defaultValue="Chim"
              onChange={handleChange}
              options={[
                { value: "Chim", label: "Chim" },
                { value: "Chó", label: "Chó" },
                { value: "Mèo", label: "Mèo" },
              ]}
            />
          </Form.Item>
          <Form.Item label="Ghi Chú">
            <TextArea rows={3} />
          </Form.Item>
        </Form>
      </Modal>
    </>
  );
};

export default Booking;
