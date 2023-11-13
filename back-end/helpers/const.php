<?php

const FIELD_IMAGE =["image" , "avatar"];





const FIELD_DESC =["description" , 'content'];

const BUTTON_HEADER_ADMIN_LINK = 'admin.components.button.button-header';

const IMAGES_FIELD ="image";

const DESC_FIELD ="description";
const FIELD_DESCS="reason";

const FIELD_CHECK_FOR = ['service_categorie_id' , 'role_id', 'product_categorie_id'];

const FIELD_DATE = ['birthday'];
/**
 * Huy Đạt writter
 * Dữ liệu được select trong admin
 * */
const FIELD_SELECT_CUSTOM = [
    'gender' => [
        1 => 'Nam',
        2 => 'Nữ'
    ],
    'status' => [
        1 => 'Kích hoạt',
        2 => 'Chưa kích hoạt'
    ]
];
/**
 * Huy Đạt writter
 * Khai báo hằng số để bắt giá trị
 * */

const admin_403 = 'admin.components.errors.403';


const errors_notification = 'admin.components.errors.errors_notification';


const SMS_TYPE_QC = 1; // loai tin nhan quang cao
const SMS_TYPE_CSKH = 2; // loai tin nhan cham soc khach hang
const SMS_TYPE_BRANDNAME = 3; // loai tin nhan brand name cskh
const SMS_TYPE_NOTIFY = 4; // sms gui bang brandname Notify
const SMS_TYPE_GATEWAY = 5; // sms gui bang so di dong ca nhan tu app android, download app tai day: https://speedsms.vn/sms


const status_wait_confirm = 0;
const status_have_confirm = 1;
const status_have_delete = 2;
const status_have_cancel = 3;
const status_have_finish = 4;
const status_request_cancel = 6;
const status_request_change_work = 7;
