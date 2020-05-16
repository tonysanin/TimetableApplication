<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Api;
use App\Department;
use App\University;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    var $facultyController;
    var $departmentController;
    var $typeController;
    var $auditoryController;
    var $teacherController;
    var $timeController;
    var $groupController;
    var $subjectController;
    var $classController;

    function __construct()
    {
        $this->facultyController = new FacultyController();
        $this->departmentController = new DepartmentController();
        $this->typeController = new TypeController();
        $this->auditoryController = new AuditoryController();
        $this->teacherController = new TeacherController();
        $this->timeController = new TimeController();
        $this->groupController = new GroupController();
        $this->subjectController = new SubjectController();
        $this->classController = new ClassController();
    }

    private function check_api($api)
    {
        $check = new Api();
        $key = $check->key_exists($api);
        if (!$key)
            return false;

        return true;
    }


    // University start
    private function get_api_university_id($api)
    {
        $check = new Api();

        return $check->get_university_id($api);
    }


    public function create_university($api, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        if ($this->get_api_university_id($api))
            return 'Error #api0';
        $university_id = (new UniversityController)->create($full_name, $short_name);
        (new \App\Api)->set_university($api, $university_id);

        return 'Success';
    }


    public function get_university($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api0';

        return University::where('id', $university_id)->first();
    }


    public function delete_university($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        $university = University::where('id', $university_id)->first();
        if (!$university)
            return 'Error #api1';
        $this->departmentController->delete_all_departments($university_id);
        $this->facultyController->delete_all_faculties($university_id);

        $university->delete();
        (new \App\Api)->set_university($api, null);

        return 'Success';
    }


    public function rename_university($api, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!(new UniversityController)->rename($university_id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }
    // University end


    // Faculty start
    public function create_faculty($api, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->facultyController->create($university_id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }


    public function get_faculties($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        return $this->facultyController->get_all_university_faculties($university_id);
    }


    public function delete_faculty($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->facultyController->faculty_exists($id, $university_id))
            return 'Error #api2';
        $this->departmentController->delete_faculty_departments($id);
        $this->facultyController->delete($id, $university_id);

        return 'Success';
    }


    public function rename_faculty($api, $id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->facultyController->rename($university_id, $id, $full_name, $short_name))
            return 'Error #api2';

        return 'Success';
    }
    // Faculty end


    // Department start
    public function get_departments($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        return $this->departmentController->get_all_university_departments($university_id);
    }


    public function create_department($api, $faculty_id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        $faculty = $this->facultyController->get_faculty($university_id, $faculty_id);
        if (!$faculty)
            return 'Error #api2';
        if (!$this->departmentController->create($faculty_id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }


    public function delete_department($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->departmentController->delete($id, $university_id))
            return 'Error #api3';

        return 'Success';
    }


    public function rename_department($api, $id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->departmentController->rename($university_id, $id, $full_name, $short_name))
            return 'Error #api3';

        return 'Success';
    }
    // Department end


    // Types start
    public function create_type($api, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->typeController->create($university_id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }


    public function get_types($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        return $this->typeController->get_types($university_id);
    }


    public function delete_type($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->typeController->type_exists($id, $university_id))
            return 'Error #api4';
        $this->typeController->delete_type($id);

        return 'Success';
    }


    public function rename_type($api, $id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->typeController->rename($university_id, $id, $full_name, $short_name))
            return 'Error #api4';

        return 'Success';
    }
    // Types end


    // Auditories
    public function create_auditory($api, $name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->auditoryController->create($university_id, $name))
            return 'Error';

        return 'Success';
    }


    public function get_auditories($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        return $this->auditoryController->get_auditories($university_id);
    }


    public function delete_auditory($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->auditoryController->auditory_exists($id, $university_id))
            return 'Error #api5';
        $this->auditoryController->delete($id);

        return 'Success';
    }


    public function rename_auditory($api, $id, $name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->auditoryController->rename($university_id, $id, $name))
            return 'Error #api5';

        return 'Success';
    }
    // Auditories end


    // Teachers
    public function create_teacher($api, $full_name, $short_name, $department_id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->departmentController->is_department_in_university($department_id, $university_id))
            return 'Error #api3';

        if (!$this->teacherController->create($full_name, $short_name, $department_id))
            return 'Error';

        return 'Success';
    }


    public function get_teachers($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        return $this->teacherController->get_university_teachers($university_id);
    }


    public function delete_teacher($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->teacherController->teacher_exists($university_id, $id))
            return 'Error #api6';
        if (!$this->teacherController->delete($id))
            return 'Error';

        return 'Success';
    }


    public function rename_teacher($api, $id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->teacherController->teacher_exists($university_id, $id))
            return 'Error #api6';
        if (!$this->teacherController->rename($id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }
    // Teacher end


    // Time start
    public function create_time($api, $time_start, $time_end)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        $time_start = date("H:i:s", strtotime($time_start));
        $time_end = date("H:i:s", strtotime($time_end));

        if (!$this->timeController->create($time_start, $time_end, $university_id))
            return 'Error';

        return 'Success';
    }


    public function get_time($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        return $this->timeController->get_all($university_id);
    }


    public function delete_time($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->timeController->time_exists($university_id, $id))
            return 'Error #api7';
        if (!$this->timeController->delete($id))
            return 'Error';

        return 'Success';
    }
    // Time end

    // Group
    public function create_group($api, $name, $faculty_id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';
        if (!$this->facultyController->faculty_exists($faculty_id, $university_id))
            return 'Error #api2';

        if (!$this->groupController->create($name, $faculty_id))
            return 'Error';

        return 'Success';
    }


    public function get_groups($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        return $this->groupController->get_all($university_id);
    }


    public function delete_group($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        if (!$this->groupController->group_exists($university_id, $id))
            return 'Error #api8';

        if (!$this->groupController->delete($id))
            return 'Error';

        return 'Success';
    }


    public function rename_group($api, $id, $name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        if (!$this->groupController->group_exists($university_id, $id))
            return 'Error #api8';

        if (!$this->groupController->rename($id, $name))
            return 'Error';

        return 'Success';
    }
    // Group end


    // Subject
    public function create_subject($api, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        if (!$this->subjectController->create($full_name, $short_name, $university_id))
            return 'Error';

        return 'Success';
    }


    public function get_subjects($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        return $this->subjectController->get_all($university_id);
    }


    public function delete_subject($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        if (!$this->subjectController->subject_exists($university_id, $id))
            return 'Error #api9';

        if (!$this->subjectController->delete($id))
            return 'Error';

        return 'Success';
    }


    public function rename_subject($api, $id, $full_name, $short_name)
    {
        if (!$this->check_api($api))
            return 'Error #api404';
        $university_id = $this->get_api_university_id($api);
        if (!$university_id)
            return 'Error #api1';

        if (!$this->subjectController->subject_exists($university_id, $id))
            return 'Error #api9';

        if (!$this->subjectController->rename($id, $full_name, $short_name))
            return 'Error';

        return 'Success';
    }
    // Subject end

    // Classes
    public function create_class($api, $subject_id, $auditory_id, $class_time_id, $group_id, $teacher_id, $type_id, $date)
    {
        if (!$this->check_api($api))
            return 'Error #api404';

        $university_id = $this->get_api_university_id($api);
        $date = date("Y-m-d", strtotime($date));

        if (!$university_id)
            return 'Error #api1';
        if (!$this->subjectController->subject_exists($university_id, $subject_id))
            return 'Error #api9';
        if (!$this->auditoryController->auditory_exists($auditory_id, $university_id))
            return 'Error #api5';
        if (!$this->timeController->time_exists($university_id, $class_time_id))
            return 'Error #api7';
        if (!$this->groupController->group_exists($university_id, $group_id))
            return 'Error #api8';
        if (!$this->teacherController->teacher_exists($university_id, $teacher_id))
            return 'Error #api6';
        if (!$this->typeController->type_exists($type_id, $university_id))
            return 'Error #api4';

        if (!$this->classController->create($subject_id, $auditory_id, $class_time_id, $group_id, $teacher_id, $type_id, $date))
            return 'Error';

        return 'Success';
    }


    public function get_classes($api)
    {
        if (!$this->check_api($api))
            return 'Error #api404';

        $university_id = $this->get_api_university_id($api);

        if (!$university_id)
            return 'Error #api1';

        return $this->classController->get_all($university_id);
    }


    public function delete_class($api, $id)
    {
        if (!$this->check_api($api))
            return 'Error #api404';

        $university_id = $this->get_api_university_id($api);

        if (!$university_id)
            return 'Error #api1';

        if (!$this->classController->class_exists($university_id, $id))
            return 'Error #api10';

        if (!$this->classController->delete($id))
            return 'Error';

        return 'Success';
    }
    // Classes end
}
