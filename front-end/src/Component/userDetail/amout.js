// Đọc dữ liệu từ tệp JSON
import JSON from 'db.json'; // For Node.js, if you're using it in a Node.js environment
import { billdetails as _billdetails } from './db.json'; // Replace with the actual path to your JSON file

// Lấy mảng các bản ghi từ JSON
const billdetails = _billdetails;

// Tính tổng tiền
let totalAmount = 0;

billdetails.forEach((bill) => {
    totalAmount += bill.bills.price;
});

// In tổng tiền
console.log(`Tổng tiền: ${totalAmount} VNĐ`);
