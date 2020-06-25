@extends('frontend.master')
@section('title', 'Employee Dashboard ')
@section('content')
<h4 class="text-center mt-5 mb-5">Welcome back <span style="font-weight: bold;">{{ ucfirst(Auth()->user()->name) }}</span></h4>
<hr>
<div class="row" id="app">
    @include('frontend/layouts/leftbar')
    <div class="col-md-9" style="border-left: 1px solid #ddd;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="basic" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="otherInfo" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Other</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="eduction" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Eduction</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="work" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Work</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="basic">
                <form method="post" @submit.prevent="saveUseInfo()">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" readonly class="form-control" v-model="user.username" name="username" id="username" placeholder="Enter Username" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="user.name" name="name" id="name" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" v-model="user.email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" v-model="user.phone" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success float-right" type="submit">Save</button>
                </form>

            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="otherInfo">
                <form method="post" @submit.prevent="saveBasicInfo()">
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="username">Website</label>
                            <input type="text" class="form-control" v-model="employee_other_info.website" name="username" id="username" placeholder="Enter website">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Career Object</label>
                            <textarea class="form-control" v-model="employee_other_info.career_object" placeholder="Enter Career Object"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success float-right" type="submit">Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="eduction">
                <br>
                <form method="post" @submit.prevent="saveEducationInfo()">
                    <div v-for="education in totalEducationRows">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Exam</label>
                                <select v-model="education.exam_name" class="form-control">
                                    <option value="">Select Exam</option>
                                    <option v-for="exam in exams">@{{ exam }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Institute Name</label>
                                <input type="text" v-model="education.institute" class="form-control" placeholder="Enter institute" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Passing Year</label>
                                <select v-model="education.passing_year" class="form-control">
                                    <option value="">Select Passing Year</option>
                                    <option v-for="year in passingYears">@{{ year }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">GPA</label>
                                <input type="text" v-model="education.grade" class="form-control" placeholder="Enter GPA" required>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <button class="btn btn-sm btn-danger" @click.prevent="addMoreEducation(); ">Add more education</button>
                    <button class="btn btn-sm btn-success float-right" type="submit">Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="work">

                <form method="post" @submit.prevent="saveWorkInfo()">
                    <div v-for="work in totalWorkRows">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" v-model="work.company_name" placeholder="Enter Company Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Position</label>
                                <input type="text" class="form-control" v-model="work.designation" placeholder="Enter Position" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Start Year</label>
                                <input type="date" class="form-control" v-model="work.from_date" required>
                            </div>

                            <div class="form-group col-md-6" v-if="work.is_present == false">
                                <label>End Year</label>
                                <input type="date" class="form-control" v-model="work.to_date">
                            </div>
                        </div>
                        <input type="checkbox" v-model="work.is_present"> Current Job
                        <hr>
                    </div>
                    <button class="btn btn-sm btn-danger" @click.prevent="addMoreWork(); ">Add more Experience</button>
                    <button class="btn btn-sm btn-success float-right" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('bootstrap/js/vue.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/axios.min.js') }}"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            user: {
                id: 0,
                name: '',
                email: '',
                phone: '',
            },
            exams: ["SSC", "Diploma", "BSC"],
            passingYears: [1995, 1996, 1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2011, 2020],
            educations: [],

            employee_other_info: {
                id: 0,
                user_id: 0,
                website: '',
                career_object: '',
            },
            totalEducationRows: [],
            totalWorkRows: [],

        },
        async created() {
            await this.getUser();
            await this.getEducationInfo();
            await this.getWorkInfo();
            this.getBasicInfo();

            if (this.totalEducationRows.length == 0) {
                this.addMoreEducation();
            }

            if (this.totalWorkRows.length == 0) {
                this.addMoreWork();
            }


        },
        methods: {
            addMoreEducation() {
                let education = {
                    id: 0,
                    exam_name: '',
                    institute: '',
                    grade: '',
                    passing_year: ''
                };

                this.totalEducationRows.push(education);

            },

            addMoreWork() {
                let work = {
                    id: 0,
                    company_name: '',
                    designation: '',
                    from_date: new Date(),
                    to_date: new Date(),
                    is_present: false
                };

                this.totalWorkRows.push(work);

            },

            async getUser() {
                await axios.get("/get_user_info").then(res => {
                    let r = res.data;
                    this.user = r;
                })
            },

            saveEducationInfo() {
                if (this.totalEducationRows.length == 0) {
                    alert("Enter Your education");
                    return;
                }
                this.educations = [];
                this.educations = this.totalEducationRows;
                let url = "/save_education_info";
                axios.post("/save_education_info", {
                    education: this.educations
                }).then(res => {
                    alert(res.data);
                })
            },
            async getEducationInfo() {
                await axios.get("/get_education_info").then(res => {
                    let r = res.data;
                    this.totalEducationRows = r;
                })
            },

            saveWorkInfo(){
                if (this.totalWorkRows.length == 0) {
                    alert("Enter Your Work");
                    return;
                }
                axios.post("/save_work_info", {
                    works: this.totalWorkRows
                }).then(res => {
                    alert(res.data);
                })
            },

            async getWorkInfo() {
                await axios.get("/get_work_info").then(res => {
                    let r = res.data;
                    this.totalWorkRows = r;
                })
            },

            saveUseInfo(){
                axios.post("/update_user_info", {sendData: this.user}).then(res => {
                    alert(res.data);
                });
            },

            saveBasicInfo(){
                axios.post("/save_basic_info", {info: this.employee_other_info}).then(res => {
                    alert(res.data);
                })
            },

            getBasicInfo() {
                axios.get("/get_other_info").then(res => {
                    if(res.data.length != 0)
                        this.employee_other_info = res.data;
                })
            },
        }
    })
</script>
@endsection