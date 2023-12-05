<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
use App\Models\ClientMenu;
use App\Models\Clients;
use App\Models\Invoice;
use App\Models\GoalBuddy;
use App\Models\Benchmarks;
use App\Models\AbClientPlan;
use App\Models\AbClientPlanDate;
use App\Models\PersonalMeasurement;

use App\Http\Traits\Result\HelperTrait;
use App\Http\Traits\StaffEventsTrait;

class DashboardController extends Controller
{
    use HelperTrait, StaffEventsTrait;

    /**
     * Show dashboard
     * @param null
     * @return dashboard view
     **/
    public function show()
    {


        return view('Result.dashboard');
    }

    /**
     * Get appointment, activities and goal data throught ajax
     * @param date, section name
     * @return response
     **/
    public function getAppSectionData(Request $request)
    {
        $response = array();
        $businessId = Auth::user()->business_id;
        $clientId = Auth::user()->account_id;
        $userid = Auth::id();
        $date = $request->date;
        $section_name = $request->section_name;

        if ($section_name == 'appointments') {
            $client = Clients::find($clientId);
            $response['appointments'] = $this->getAppointmentByDate($client, $date);
        } elseif ($section_name == 'activities') {
            $response['activities'] = $this->getActivitiesByDate($clientId, $date);
        } elseif ($section_name == 'goals') {
            $response['goals'] = $this->getGoalBodyByDate($userid, $date);
        } elseif ($section_name == 'all') {
            $client = Clients::find($clientId);
            $response['appointments'] = $this->getAppointmentByDate($client, $date);
            $response['activities'] = $this->getActivitiesByDate($clientId, $date);
            $response['goals'] = $this->getGoalBodyByDate($userid, $date);
        }

        return json_encode($response);
    }

    /**
     * Fatch activities accourding to date and current client
     * @param clientId, date
     * @return activities array 
     **/
    protected function getActivitiesByDate($clientId, $date)
    {
        $activities = array();
        $businessId = Auth::user()->business_id;
        $palnIds = AbClientPlanDate::whereDate('plan_start_date', '=', $date)->distinct()->pluck('client_plan_id')->toArray();
        $plans = AbClientPlan::where('businessId', $businessId)
            ->where('clientId', $clientId)
            ->whereIn('id', $palnIds)
            ->orderBy('id', 'desc')
            ->select('id', 'name', 'discription')
            ->take(10)
            ->get();
        if ($plans->count()) {
            foreach ($plans as $plan) {
                $activities[] = array('date' => dbDateToDateString($date), 'desc' => $plan->name);
            }
        }

        return $activities;
    }

    /**
     * Fatch Goal body accourding to date and current client
     * @param clientId, date
     * @return goal body array 
     **/
    protected function getGoalBodyByDate($clientId, $date)
    {
        //$date = '2018-04-25';
        $goalbody = array();
        // $goals = GoalBuddy::with('goalBuddyMilestones')->where('gb_client_id', $clientId)->whereDate('gb_due_date','=', $date)->orderBy('id','desc')->take(10)->get();
        $goals = GoalBuddy::with('goalBuddyMilestones')->where('gb_client_id', $clientId)->orderBy('id', 'desc')->get();

        if ($goals->count()) {
            $percenteg = 0;
            foreach ($goals as $goal) {
                $milestonesNo = $goal->goalBuddyMilestones->count();
                if ($milestonesNo > 0)
                    $completedMilestone = 0;
                foreach ($goal->goalBuddyMilestones as $milestone) {
                    if ($milestone->gb_milestones_status) {
                        $completedMilestone = $completedMilestone + 1;
                    }
                }
                $percenteg = sprintf("%.2f", ($completedMilestone / $milestonesNo) * 100);;

                $goalbody[] = array('name' => $goal->gb_goal_name, 'due_date' => dbDateToDateString($goal->gb_due_date), 'progress_name' => 'Milestone', 'per' => $percenteg);
            }
        }
        return $goalbody;
    }

    /**
     * Fatch all class and service acording to date and current client
     * @param Client calss object, Date
     * @return appointment array
     **/
    protected function getAppointmentByDate($clientObj, $date)
    {
        $appointments = collect();
        $services = $clientObj->clientEventService($date)->get()->toArray();
        $classes = $clientObj->clientEventClasses($date)->get()->toArray();
        $appointments = array();
        if (count($classes)) {
            foreach ($classes as $cls) {
                $desc = $cls['clas_with_trashed']['cl_name'] . ' with ' . $cls['staff_with_trashed']['first_name'] . ' ' . $cls['staff_with_trashed']['last_name'] . ' at ' . dbTimeToTimeString($cls['eventTime']);
                $appointments[] = array('date' => dbDateToDateString($cls['eventDate']), 'desc' => $desc, 'type' => 'class', 'dateTime' => $cls['eventDate'] . ' ' . $cls['eventTime']);
            }
        }
        if (count($services)) {
            foreach ($services as $service) {
                if ($service['service_with_trashed']['one_on_one_name'] != '')
                    $serviceName = $service['service_with_trashed']['one_on_one_name'];
                elseif ($service['service_with_trashed']['team_name'] != '')
                    $serviceName = $service['service_with_trashed']['team_name'];
                else
                    $serviceName = '';

                $desc = $serviceName . ' with ' . $service['staff_with_trashed']['first_name'] . ' ' . $service['staff_with_trashed']['last_name'] . ' at ' . dbTimeToTimeString($service['eventTime']);
                $appointments[] = array('date' => dbDateToDateString($service['eventDate']), 'desc' => $desc, 'type' => 'service', 'dateTime' => $service['eventDate'] . ' ' . $service['eventTime']);
            }
        }

        usort($appointments, function ($item1, $item2) {
            return $item1['dateTime'] <=> $item2['dateTime'];
        });
        // dd($appointments);
        return $appointments;
    }
}
