# api Đạt viết 
- chuẩn restFul api
1. http://127.0.0.1:8000/api/service
2. http://127.0.0.1:8000/api/reviews
3. http://127.0.0.1:8000/api/new
- Api về service 
1. http://127.0.0.1:8000/api/service-show  :: lấy ra tối đa 4 dữ liệu ở trang hôm dưới banner
- Api về news
1. http://127.0.0.1:8000/api/new-post  :: lấy ra bài viết mới nhất
2. http://127.0.0.1:8000/api/new-post/id  :: lấy ra chi tiết bài viết theo id
3. http://127.0.0.1:8000/api/new-categories :: lấy ra danh mục bài viết
4. http://127.0.0.1:8000/api/new-search/{name} :: name là giá trị được gửi lên tìm kiếm tên bài viết
5. http://127.0.0.1:8000/api/new-home/ :: lấy ra tối đa 3 dữ liệu ở trang home 
- Api về Authentication
1. http://127.0.0.1:8000/api/new-post  :: check số điện thoại 
2. http://127.0.0.1:8000/api/new-post  :: quên mật khẩu
3. http://127.0.0.1:8000/api/new-post  :: đăng ký
4. http://127.0.0.1:8000/api/new-post  :: đăng nhập bằng otp hoặc đăng ký 
- Api viết cho thiều 
1. http://127.0.0.1:8000/api/doctors-clients  :: lấy ra tất cả bác sĩ ở trang clients , lấy ra detail bác sĩ và đánh giá 
2. http://127.0.0.1:8000/api/service-filter-doctor :: phương thức sử dung là post thêm checkbox
sumbit để lọc dữ liệu dữ liệu gửi lên là tn là service
- Api Authentication user Đạt Writter
1. http://127.0.0.1:8000/api/checkerPhone  :: case OTP khi send otp :: **POST**
check kiểm tra xem số điện thoaại đã tồn tại hay rồi mới tiến hày verify
2. http://127.0.0.1:8000/api/CheckVerify  :: case OTP kiểm tra xem nếu verify thay công  **POST**
rồi thì chạy api này để lấy ra tài khoản và token của user để đăng nhập
3. http://127.0.0.1:8000/api/CheckLogin   :: case ko có OTP nhâp phone và password  **POST**
4. http://127.0.0.1:8000/api/CheckVerifyRegister  :: case ko OTP check xem số điện thoại người dùng  **POST**
đăng ký đã tồn tại ở hệ thống chưa , nếu chưa tạo tài khoản auto cho người dùng luôn
5. http://127.0.0.1:8000/api/RegisterUser  :: case OTP check xem số điện thoại người dùng **POST**
đăng ký đã tồn tại ở hệ thống chưa , nếu chưa thì cho đăng ký và gửi OTP
6. http://127.0.0.1:8000/api/ForgetPassWord :: case OTP khi send otp **POST**
check kiểm tra xem số điện thoaại đã tồn tại hay rồi mới tiến hày verify
7. http://127.0.0.1:8000/api/CheckVerifyForgetPassword :: case OTP khi send otp **POST**
lập tức update lại mật khẩu có người dùng luôn
8. http://127.0.0.1:8000/api/ResetPassword :: case không OTP  nhập số điện thoại và mật khẩu **POST**

1. http://127.0.0.1:8000/api/doctor/login :: đăng nhập bác sĩ (Post)
2. http://127.0.0.1:8000/api/list-customers :: lấy ra danh sách khách hàng của bác sĩ (Get)
3. http://127.0.0.1:8000/api/list-appiontment/{id} :: lấy ra danh sách lịch hẹn của khách hàng (Get) id là id của khách hàng
4. http://127.0.0.1:8000/api/prescription/{id} :: lấy ra đơn thuốc của khách hàng (Get) id là id của khách hàng
5. http://127.0.0.1:8000/api/bills/{id} :: lấy ra danh sách hóa đơn của khách hàng (Get) id là id của khách hàng