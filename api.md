# api Đạt viết 
- chuẩn restFul api
1. http://127.0.0.1:8000/api/service
2. http://127.0.0.1:8000/api/reviews
3. http://127.0.0.1:8000/api/new
- Api về service 
1. http://127.0.0.1:8000/api/service-show  :: lấy ra tối đa 4 dữ liệu ở trang hôm dưới banner
- Api về news
1. http://127.0.0.1:8000/api/new-post/{name}  :: lấy ra bài viết mới nhất
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
1. http://127.0.0.1:8000/api/check-phone  :: case OTP khi send otp :: **POST**
check kiểm tra xem số điện thoaại đã tồn tại hay rồi mới tiến hày verify
2. http://127.0.0.1:8000/api/check-verify  :: case OTP kiểm tra xem nếu verify thay công  **POST**
rồi thì chạy api này để lấy ra tài khoản và token của user để đăng nhập
3. http://127.0.0.1:8000/api/check-login   :: case ko có OTP nhâp phone và password  **POST**

4. http://127.0.0.1:8000/api/check-verify-register  :: case có OTP check xem số điện thoại người dùng  **POST**
đăng ký đã tồn tại ở hệ thống chưa , nếu chưa tạo tài khoản ok chuyển sang tạo mật khẩu

5. http://127.0.0.1:8000/api/create-password  :: case OTP check xem số điện thoại người dùng **POST**
đăng ký đã tồn tại ở hệ thống chưa , nếu chưa tạo mật khẩu cho người dùng

6. http://127.0.0.1:8000/api/forget-password :: case OTP khi send otp **POST**
check kiểm tra xem số điện thoaại đã tồn tại hay rồi mới tiến hành verify

7. http://127.0.0.1:8000/api/check-verify-forget-password :: case OTP khi send otp **POST**
   ăng ký đã tồn tại ở hệ thống chưa , nếu chưa tạo tài khoản ok chuyển sang tạo mật khẩu

8. http://127.0.0.1:8000/api/reset-password :: case không OTP nhập số điện thoại và mật khẩu **POST**

1. http://127.0.0.1:8000/api/doctor/login :: đăng nhập bác sĩ (Post)
2. http://127.0.0.1:8000/api/list-customers :: lấy ra danh sách khách hàng của bác sĩ (Get)
3. http://127.0.0.1:8000/api/list-appiontment/{id} :: lấy ra danh sách lịch hẹn của khách hàng (Get) id là id của khách hàng
4. http://127.0.0.1:8000/api/prescription/{id} :: lấy ra đơn thuốc của khách hàng (Get) id là id của khách hàng
5. http://127.0.0.1:8000/api/bills/{id} :: lấy ra danh sách hóa đơn của khách hàng (Get) id là id của khách hàng

// get info user when login
6. http://127.0.0.1:8000/api/info-user :: lấy ra thông tin của user khi đăng nhập (Get)
//change password user
7. http://127.0.0.1:8000/api/change-password-user :: thay đổi mật khẩu của user (Put)
//logout user
8. http://127.0.0.1:8000/api/logout-user :: đăng xuất user (post)
//get appointment by user
9. http://127.0.0.1:8000/api/appointment-user :: lấy ra danh sách lịch hẹn của user (Get)
//get prescription by user
10. http://127.0.0.1:8000/api/prescription-user :: lấy ra danh sách đơn thuốc của user (Get)
//get bill by user
11. http://127.0.0.1:8000/api/bill-user :: lấy ra danh sách hóa đơn của user (Get)


// api lấy dữ liệu notifications 
1. http://127.0.0.1:8000/api/get-notification





// đạt viêt api đăng ký ko cần otp 
1. http://127.0.0.1:8000/api/register-user-password **POST**
// đạt viết api home 
1. http://127.0.0.1:8000/api/doctor-home-user lất ra 4 Records trang home
2. http://127.0.0.1:8000/api/setting api cho toàn bộ setting