<script>
import moment from 'moment';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
    Head
} from '@inertiajs/inertia-vue3';
import {
    computed
} from '@vue/runtime-core';

export default {
    props: {
        attendancies: {
            type: Object
        },
    },

    data() {
        return {
            totalPresent: 0,
        }
    },
    components: {
        AuthenticatedLayout,
        Head
    },
    mounted() {
        this.daysInMonth;
    },

    methods: {
        range(min, max) {
            var array = [],
                j = 0;
            for (var i = min; i <= max; i++) {
                array[j] = i;
                j++;
            }
            return array;
        },

        day(date) {
            const mydate = date;
            console.log(mydate)
            let weekday = moment(mydate).format('dd');
            console.log(weekday);
            return weekday;

        },

        userId(key){
            return key.split('#');
        }
    },
    computed: {
        daysInMonth() {
            // console.log(this.$props.attendancies.daysInMonth);
        },

    }
}
</script>

<style scoped>
.filter-box {
    box-shadow: 0 1px 0 0 #e8eef3;
    width: 100%;
    top: 63px;
    position: sticky;
    z-index: 1;
}

.client-list-filter.filter-box {
    padding: 0px 28px;
}

.client-list-filter .select-box {
    width: auto;
}

select {
    position: absolute !important;
    bottom: 0;
    left: 50%;
    display: block !important;
    width: 0.5px !important;
    height: 100% !important;
    padding: 0 !important;
    opacity: 0 !important;
    border: none;
    z-index: 0 !important;
}

.form-control {
    border: 1px solid #e8eef3;
    box-shadow: none;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
    background-color: #fff;
    color: #28313C;
    font-weight: 400;
    position: relative;
    padding: 0px 6px 0px;
    height: auto;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
}

.btn-primary {
    text-transform: capitalize;
    padding: 9px 11px;
    background-color: #1d82f5 !important;
    color: #fff !important;
    border: 1px solid #1d82f5 !important;
    position: relative;
}
</style>

<template>
<Head title="Attandacies" />

<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Attendancies
        </h2>
    </template>

    <div class="py-5">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="filter-box">
                <!-- FILTER START -->
                <form action="" id="filter-form">
                    <div class="lg:flex md:flex block flex-wrap  filter-box bg-white client-list-filter">
                        <div class="select-box flex items-baseline py-2 pr-2 border-r border-r-gray-400">
                            <p class="mb-0 pr-3 text-sm text-gray-500 flex items-center">Employee</p>
                            <div class="select-status">
                                <div class="dropdown bootstrap-select form-control select-picker">
                                    <select class="form-control select-picker" name="user_id" id="user_id" data-live-search="true" data-size="8" tabindex="null">
                                        <option value="all">All</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-full'
                                src='https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.png?s=200&amp;d=mp'></div> Bennett Jenkins" value="1">Bennett Jenkins</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/24d8c3b489d5ff25dccbda1c024f5b9a.png?s=200&amp;d=mp'></div> Carlo Cassin" value="10">Carlo Cassin</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/e81219f8f5a274912bda48a7168e9655.png?s=200&amp;d=mp'></div> Javonte Hamill" value="13">Javonte Hamill</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/0500b2ab42f89e6307060d3f45458c97.png?s=200&amp;d=mp'></div> Jedediah McDermott" value="2">Jedediah McDermott</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/b7ff72f928aa9d63dfc9277376efacac.png?s=200&amp;d=mp'></div> Mr. Gino Schmeler" value="11">Mr. Gino Schmeler</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/53a98db2561cd2a34fa579a12205aa81.png?s=200&amp;d=mp'></div> Mr. Ulices Larkin MD" value="12">Mr. Ulices Larkin MD</option>
                                        <option data-content="<div class='d-inline-block mr-1'><img class='taskEmployeeImg rounded-circle'
                                src='https://www.gravatar.com/avatar/2ee9b5d027a5f946ad46317b909769b3.png?s=200&amp;d=mp'></div> Shanon Weber" value="9">Shanon Weber</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="user_id" title="All">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">All</div>
                                            </div>
                                        </div>
                                    </button>

                                    <div class="dropdown-menu" style="overflow: hidden; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 24px, 0px);" x-placement="bottom-start">
                                        <div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-0"></div>
                                        <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" style="overflow-y: auto;">
                                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="selected active"><a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0" aria-setsize="8" aria-posinset="1" aria-selected="true"><span class="text">All</span></a></li>
                                                <li>
                                                    <a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1">
                                                                <img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.png?s=200&amp;d=mp">
                                                            </div> Bennett Jenkins
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0">
                                                        <span class="text">
                                                            <div class="d-inline-block mr-1">
                                                                <img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/24d8c3b489d5ff25dccbda1c024f5b9a.png?s=200&amp;d=mp">
                                                            </div> Carlo Cassin
                                                        </span>
                                                    </a>
                                                </li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-3" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1"><img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/e81219f8f5a274912bda48a7168e9655.png?s=200&amp;d=mp"></div> Javonte Hamill
                                                        </span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-4" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1"><img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/0500b2ab42f89e6307060d3f45458c97.png?s=200&amp;d=mp"></div> Jedediah McDermott
                                                        </span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-5" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1"><img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/b7ff72f928aa9d63dfc9277376efacac.png?s=200&amp;d=mp"></div> Mr. Gino Schmeler
                                                        </span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-6" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1"><img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/53a98db2561cd2a34fa579a12205aa81.png?s=200&amp;d=mp"></div> Mr. Ulices Larkin MD
                                                        </span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-1-7" tabindex="0"><span class="text">
                                                            <div class="d-inline-block mr-1"><img class="taskEmployeeImg rounded-circle" src="https://www.gravatar.com/avatar/2ee9b5d027a5f946ad46317b909769b3.png?s=200&amp;d=mp"></div> Shanon Weber
                                                        </span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="select-box flex items-baseline py-2 lg:px-2 md:px-2 px-1 border-r border-r-gray-400">
                            <p class="mb-0 pr-3 text-base text-dark-grey flex items-center">Department</p>
                            <div class="select-status">
                                <div class="dropdown bootstrap-select form-control select-picker"><select class="form-control select-picker" name="department" id="department" data-live-search="true" data-size="8">
                                        <option value="all">All</option>
                                        <option value="1">Marketing</option>
                                        <option value="2">Sales</option>
                                        <option value="3">Human Resources</option>
                                        <option value="4">Public Relations</option>
                                        <option value="5">Research</option>
                                        <option value="6">Finance</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" data-id="department" title="All">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">All</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu ">
                                        <div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-2" aria-autocomplete="list"></div>
                                        <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="select-box flex items-baseline py-2 px-lg-2 px-md-2 px-1 border-r border-r-gray-400">
                            <p class="mb-0 pr-3 text-base text-dark-grey flex items-center">Month</p>
                            <div class="select-status">
                                <div class=" bootstrap-select form-control select-picker">
                                    <select class="form-control select-picker" name="month" id="month" data-live-search="true" data-size="8">
                                        <option value="01">
                                            January</option>
                                        <option value="02">
                                            February</option>
                                        <option value="03">
                                            March</option>
                                        <option value="04">
                                            April</option>
                                        <option value="05">
                                            May</option>
                                        <option value="06">
                                            June</option>
                                        <option value="07">
                                            July</option>
                                        <option value="08">
                                            August</option>
                                        <option value="09">
                                            September</option>
                                        <option selected="" value="10">
                                            October</option>
                                        <option value="11">
                                            November</option>
                                        <option value="12">
                                            December</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" data-id="month" title="October">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">October</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu ">
                                        <div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-3" aria-autocomplete="list"></div>
                                        <div class="inner show" role="listbox" id="bs-select-3" tabindex="-1">
                                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="select-box flex items-baseline py-2 px-lg-2 px-md-2 px-1 border-r border-r-gray-400">
                            <p class="mb-0 pr-3 text-base text-dark-grey flex items-center">Year</p>
                            <div class="select-status">
                                <div class="dropdown bootstrap-select form-control select-picker"><select class="form-control select-picker" name="year" id="year" data-live-search="true" data-size="8">
                                        <option selected="" value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-4" aria-haspopup="listbox" aria-expanded="false" data-id="year" title="2022">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">2022</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu ">
                                        <div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-4" aria-autocomplete="list"></div>
                                        <div class="inner show" role="listbox" id="bs-select-4" tabindex="-1">
                                            <ul class="dropdown-menu inner show" role="presentation"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="select-box flex items-baseline py-2 px-lg-2 px-md-2 px-1 border-r border-r-gray-400">
                            <p class="mb-0 pr-3 text-base text-dark-grey flex items-center">Late</p>
                            <div class="select-status">
                                <div class="dropdown bootstrap-select form-control select-picker"><select class="form-control select-picker" name="late" id="late" tabindex="null">
                                        <option value="all">All</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-5" aria-haspopup="listbox" aria-expanded="false" data-id="late" title="All">
                                        <div class="filter-option">
                                            <div class="filter-option-inner">
                                                <div class="filter-option-inner-inner">All</div>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-menu" style="max-height: 242px; overflow: hidden; min-height: 0px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 24px, 0px);" x-placement="bottom-start">
                                        <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" aria-activedescendant="bs-select-5-0" style="max-height: 224px; overflow-y: auto; min-height: 0px;">
                                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="selected active"><a role="option" class="dropdown-item active selected" id="bs-select-5-0" tabindex="0" aria-setsize="3" aria-posinset="1" aria-selected="true"><span class="text">All</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-5-1" tabindex="0"><span class="text">Yes</span></a></li>
                                                <li><a role="option" class="dropdown-item" id="bs-select-5-2" tabindex="0"><span class="text">No</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RESET START -->
                        <div class="select-box flex items-baseline py-1 lg:px-2 px-md-2 px-0">
                            <button type="button" class="btn-secondary rounded text-base p-2 btn-xs flex-none" id="reset-filters">
                                <!-- <svg class="svg-inline--fa fa-times-circle fa-w-16 mr-1" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
                                </svg> -->
                                <!-- <i class="fa fa-times-circle mr-1"></i> Font Awesome fontawesome.com -->
                                Clear
                            </button>
                        </div>
                        <!-- RESET END -->
                    </div>
                </form>

            </div>

            <div class="flex">
                <div id="table-actions" class="flex-grow items-center">

                    <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm
                     px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 mr-2 mb-2">
                        <svg aria-hidden="true" class="mr-2 -ml-1 w-6 h-5" viewBox="0 0 2405 2501" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>

                        </svg>
                        Mark Attendance
                    </a>
                </div>

                <div class="btn-group" role="group">
                    <a href="https://demo.worksuite.biz/account/attendances" class="btn btn-secondary f-14 btn-active" data-toggle="tooltip" data-original-title="Summary"><i class="side-icon bi bi-list-ul"></i></a>

                    <a href="https://demo.worksuite.biz/account/attendances/by-member" class="btn btn-secondary f-14" data-toggle="tooltip" data-original-title="Attendance by Member"><i class="side-icon bi bi-person"></i></a>

                    <a href="https://demo.worksuite.biz/account/attendances/by-hour" class="btn btn-secondary f-14" data-toggle="tooltip" data-original-title="Attendance by Hour"><svg class="svg-inline--fa fa-clock fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path>
                        </svg><!-- <i class="fa fa-clock"></i> Font Awesome fontawesome.com --></a>

                </div>
            </div>

            <!-- {{attendancies.employeeAttendence}} / -->
            {{day('su' + '-' + attendancies.month + attendancies.year)}}
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-2">
                                Employee
                            </th>
                            <th scope="col" class="py-3 px-0" v-for="d in range(1, attendancies.daysInMonth) " :key="d">
                                {{d}}

                                <span class="text-dark-grey"><br>

                                    <!-- {{ $weekMap[\Carbon\Carbon::parse(\Carbon\Carbon::parse($i . '-' . $month . '-' . $year))->dayOfWeek] }} -->
                                    {{attendancies.weekMap[day(d + '-' + attendancies.month + '-' + attendancies.year)]}}
                                </span>
                            </th>

                            <th class="text-right px-2">Total</th>
                        </tr>
                    </thead>

                    <tbody v-for="(a,attendance) in attendancies.employeeAttendence" :key="a">
                        <!-- {{attendance}} -->

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="w-[200px] px-2"> {{attendance}} </td>

                            <td scope="row" class="py-4 px-2 font-medium text-gray-900 whitespace-nowrap
                             dark:text-white" v-for="(day,t) in a" :key="t">
                                <!-- {{day}} -->
                                <span data-toggle="tooltip" data-original-title="leave" v-if="day == 'Leave'">
                                    L
                                </span>

                                <a href="javascript:;" class="edit-attendance" data-user-id="1" data-attendance-date="t" v-else-if="day == 'Absent'">
                                    x
                                </a>

                                <a href="javascript:;" class="edit-attendance" data-user-id="1" data-attendance-date="t" v-else-if="day == 'Holiday'">
                                    H
                                </a>

                                <div v-else>
                                    <span v-if="day !== '-'">
                                        {{totalPresent === totalPresent + 1}}
                                    </span>
                                    {{day}}
                                </div>
                            </td>

                            <td class="text-dark text-right attendance-total px-2 w-25">
                                <!-- {{ totalPresent +  (attendance.length - 1) }} -->
                                {{ totalPresent }}   / {{(attendancies.daysInMonth) +1}}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</AuthenticatedLayout>
</template>
