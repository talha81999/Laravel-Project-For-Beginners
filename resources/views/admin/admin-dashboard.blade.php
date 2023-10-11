@extends('admin.layouts.main')
@section('main-container')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- order-card start -->
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h5 class="text-white">Total Users</h5>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-user float-left"></i><span>{{ getTotalUsersExceptAdmin() }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h5 class="text-white">Total Projects</h5>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-sidebar float-left"></i><span>{{ getProjectsCount() }}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-body">
                            <h5 class="text-white">Total Tasks</h5>
                            <h2 class="text-right text-white"><i
                                    class="feather icon-sidebar float-left"></i><span>{{ getTasksCount() }}</span></h2>

                        </div>
                    </div>
                </div>

                <!-- order-card end -->
            </div>

            @php

                $pro_array = array();
                $count_array = array();
                $teamLeadProjects = getTeamLeadProjects();
            for ($i=0; $i <count( $teamLeadProjects) ; $i++) {

                array_push($pro_array, $teamLeadProjects[$i]['project_name'] ?? 0);
                array_push($count_array, $teamLeadProjects[$i]['id']);

            }

            $vals = array_count_values($count_array);

            $new_array = array();
            for($i=0; $i<count($pro_array);$i++)
            {
                if($pro_array[$i] != '0')
                {

                    $new_array[$count_array[$i]] = $pro_array[$i];
                }
                else{
                    $new_array[$count_array[$i]] = '0';
                }
            }


                $team_leads = ['John', 'Mary', 'Peter', 'Doe', 'Harry'];
                $projects = [80, 8, 12, 4, 6];


                // Convert arrays to JSON
                $team_leads = json_encode($team_leads, JSON_HEX_QUOT);
                $projects = json_encode($projects, JSON_HEX_QUOT);

            @endphp


            @foreach ($new_array as $key => $value)
                @if ($value == '0')
                @php
                    $vals[$key] = 0;
                @endphp
                @endif

            @endforeach

            @php
                $bb = array();
            @endphp
            @foreach ($teamLeadProjects as $key => $value)

            @php
                $bb[$value['user_first_name'].' '.$value['user_last_name']] = $vals[$value['id']];
            @endphp
            @endforeach
            @php

                $TEAMLEAD = array();
                $PROJECT = array();
            @endphp
                @foreach ($bb as $key => $value)
                @php

                array_push($TEAMLEAD, $key);
                array_push($PROJECT, $value);
                @endphp
                @endforeach

                @php
                $TEAMLEAD = json_encode($TEAMLEAD, JSON_HEX_QUOT);
                $PROJECT = json_encode($PROJECT, JSON_HEX_QUOT);
                @endphp


@php
     // Sample data
     $employees = array("John", "Mary", "Peter", "Doe", "Harry");
    $tasks = array(80, 8, 12, 4, 6);
    $statuses = array("Completed", "In Progress", "New", "Pending", "Cancelled");

    // Convert arrays to JSON
    $employees = json_encode($employees);
    $tasks = json_encode($tasks);
    $statuses = json_encode($statuses);


@endphp
@php

        $employeeName           =     array();
        $employeeProjectsCount  =     array();
        foreach (getEmployeeTasks() as $key => $value) {
            array_push($employeeName, $key);
            array_push($employeeProjectsCount, $value);
        }
        // Convert arrays to JSON
        $employeeName = json_encode($employeeName);
        $employeeProjectsCount = json_encode($employeeProjectsCount);

@endphp
        <div class="row" id="charts-box">
            <div class="col-md-6 col-xl-6 card ml-3" id="team-lead-project-container"></div>

                <div class="col-md-6 col-xl-6 card mr-3" id="employe-task-container">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        var teamLeads = JSON.parse({!! json_encode($TEAMLEAD) !!});
        var projects = JSON.parse({!! json_encode($PROJECT) !!});

        Highcharts.chart('team-lead-project-container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Project Assigns to Team Lead'
            },
            xAxis: {
                title: {
                    text: 'Team Leads'
                },

                categories: teamLeads

            },
            yAxis: {
                title: {
                    text: 'Projects'
                }
            },
            credits: {
                enabled: false
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'bottom',
                x: -40,
                y: -62,
                floating: true,
                borderWidth: 1,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            series: [{
                name: 'Projects Assigned',
                data: projects
            }]
        });
    });
</script>
<script >
 $(document).ready(function() {
    // Create pie chart
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo $employeeName; ?>,
            datasets: [{
                label: 'Number of Tasks Assigned',
                data: <?php echo $employeeProjectsCount; ?>,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#33FF99',
                    '#FF9933'
                ]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Number of Tasks Assigned to Each Employee'
            },
            legend: {
                display: true,
                position: 'bottom'
            },
            responsive: true,
            plugins: {
                datalabels: {
                    formatter: function(value, context) {
                        var label = context.chart.data.labels[context.dataIndex];
                        var text = label + ': ' + value + ' (' + <?php echo $statuses; ?>[context.dataIndex] + ')';
                        return text;
                    },
                    color: '#fff',
                    backgroundColor: '#333',
                    borderRadius: 5,
                    anchor: 'end',
                    align: 'start',
                    offset: 10,
                    font: {
                        size: '14',
                    }
                }
            }
        }
    });
});
</script>
