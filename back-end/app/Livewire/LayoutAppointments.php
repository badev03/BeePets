<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Traits\QueryCommon;
use Livewire\Component;

class LayoutAppointments extends Component
{
    use QueryCommon;
    public $model = Appointment::class;
    public $urlbase = 'appointment.';
    public $pathView = 'admin.appointments.';
    public $title = 'Cuộc hẹn';
    protected $permissionCheckCrud = 'appointment';
    public $listIndex = ['Doctor' , 'User' , 'TypePet' , 'Service'];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER= ['doctor_id' , 'user_id','type_pet_id' , 'service_id' ];
    public $colums = [];
    protected $special = ['start_time' , 'end_time'];
    public $dataService;
    public $service_id;
    public $dataFilterService;

    public function QuerySpecialIndex()
    {
        $appointments = $this->queryCommon()
            ->orderByDesc('id')
            ->whereNull('appointments.deleted_at')
            ->orderBy('id', 'DESC')
            ->addSelect('w.start_time' , 'w.end_time')
            ->addSelect('appointments.status')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            });
        return $appointments;
    }
    public function render()
    {
        $data = $this->QuerySpecialIndex()
            ->whereIn('appointments.status' , [1 , 6])
            ->get();;
        $dataDoctor = $this->tableSelectCommon('doctors')->get();
        $this->dataService = $this->tableSelectCommon('services')->get();
        $dataTypePet = $this->tableSelectCommon('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view('livewire.layout-appointments' , compact('data' , 'permission_crud'
            ,'dataTypePet' , 'dataDoctor'))->with([
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
        ]);;
    }

    public function updatedService($value)
    {
        dd($value);
        $this->dataFilterService = $value;
    }
}
