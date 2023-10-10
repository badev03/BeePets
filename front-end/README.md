# React + Vite

This template provides a minimal setup to get React working in Vite with HMR and some ESLint rules.

Currently, two official plugins are available:

- [@vitejs/plugin-react](https://github.com/vitejs/vite-plugin-react/blob/main/packages/plugin-react/README.md) uses [Babel](https://babeljs.io/) for Fast Refresh
- [@vitejs/plugin-react-swc](https://github.com/vitejs/vite-plugin-react-swc) uses [SWC](https://swc.rs/) for Fast Refresh


Route::get('api/service-show', [ServiceController::class , 'showHome']);

Route::post('api/form', [BookingController::class, 'showForm']);
Route::post('api/save', [BookingController::class, 'save']);
Route::post('api/doctor/login', [DoctorController::class, 'login']);

 'api/reviews' 