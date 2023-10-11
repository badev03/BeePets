# api Đạt viết 
- chuẩn restFul api
1. http://127.0.0.1:8000/api/service
2. http://127.0.0.1:8000/api/reviews
3. http://127.0.0.1:8000/api/new
- Api về service 
1. http://127.0.0.1:8000/api/service-show  :: lấy ra tối đa 4 dữ liệu ở trang hôm dưới banner
- Api về news
1. http://127.0.0.1:8000/api/new-post  :: lấy ra bài viết mới nhất 
2. http://127.0.0.1:8000/api/new-categories :: lấy ra danh mục bài viết 
3. http://127.0.0.1:8000/api/new-search/{name} :: name là giá trị được gửi lên tìm kiếm tên bài viết 
4. http://127.0.0.1:8000/api/new-home/ :: lấy ra tối đa 3 dữ liệu ở trang home 
- Api về Authentication
1. http://127.0.0.1:8000/api/new-post  :: check số điện thoại 
2. http://127.0.0.1:8000/api/new-post  :: quên mật khẩu
3. http://127.0.0.1:8000/api/new-post  :: đăng ký
4. http://127.0.0.1:8000/api/new-post  :: đăng nhập bằng otp hoặc đăng ký 
- Api viết cho thiều 
1. http://127.0.0.1:8000/api/doctors-clients  :: lấy ra tất cả bác sĩ ở trang clients , lấy ra detail bác sĩ và đánh giá 
2. http://127.0.0.1:8000/api/service-filter-doctor :: phương thức sử dung là post thêm checkbox
sumbit để lọc dữ liệu dữ liệu gửi lên là tn là service