<!DOCTYPE html>
<html>
<head>
    <title>studentDetails</title>
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
     
    <style>
        .active{
            background-color: #3d93ef;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-sm-3">
                <a  onclick="getinfo('1')" target="iframe"><button class="btn btn-info" type="button" id="studentInformation"
                        onclick="Student()" class="btn  active"
                        style="width: 60%;margin-top: 20px;color: white;">StudentInformation</button></a>
            </div>
             <div class="col-sm-2">
                <a href="feeDetails.html" target="iframe"><button btn btn-info type="button" class="btn btn-info" id="feeDetails"
                        onclick="fee()"
                        style="width: 100%;margin-top: 20px;background-color: rgb(190, 189, 189);color: white;">FeeDetails</button></a>
            </div>
            <div class="col-sm-3">
                <a href="attendenceDetails.html" target="iframe"><button class="btn btn-info" type="button" class="btn"
                        id="attendanceDetails" onclick="attendance()"
                        style="width: 60%;margin-top: 20px;background-color: rgb(190, 189, 189);color: white;">AttendanceDetails</button></a>
            </div>
            <div class="col-sm-2">
                <a href="remark.html" target="iframe"><button type="button" class="btn btn-info"
                        id="remark" onclick="remark()"
                        style="width: 100%;margin-top: 20px;background-color: rgb(190, 189, 189);color: white;">Remark</button></a>
            </div>
        </div>
    

       <div  id="stu_info" style="display: none; margin-left: 200px">
        <table style="margin-top:-750px " >
            <tr>
                <td><b>Select State</b></td>
                <td>*</td>
                <td><?php echo $student_info['state']?></td>
                <?php if($student_info['image'] !=''){?>
                <td rowspan="7"><img style="width: 150px;height: 150px;margin-top: -100px;margin-left:50px;margin-right: -100px" src="<?php echo base_url()?><?php echo $student_info['image']?>" ></td>
                <?php }else{?>
                <td rowspan="7"><img style="width: 150px;height: 150px;margin-top: -100px;margin-left:50px;margin-right: -100px" src="<?php echo base_url('storage/no_image.jpg')?>" ></td>
                <?php }?>
            </tr>
            <!-- <tr>
                <th>Select State *</th>
                <td>:</td>
                <td>Telangana</td>
                 <td rowspan="6"><img src="#" alt=""></td> -->
            <!-- </tr> --> 
            <tr>
                <th>Select Organization *</th>
                <td>:</td>
                <td><?php echo $student_info['organisation_name']?></td>
            </tr>
            <tr>
                <th>Center*</th>
                <td>:</td>
                <td><?php echo $student_info['center']?></td>
            </tr>
            <tr>
                <th>Courses*</th>
                <td>:</td>
                <td><?php echo $student_info['course_name']?></td>
            </tr>
            <tr>
                <th>Batch*</th>
                <td>:</td>
                <td><?php echo $student_info['batch']?></td>
            </tr>
            <tr>
                <th>Jion/Vaid From *</th>
                <td>:</td>
                <td><?php echo $student_info['valid_from']?></td>
            </tr>
            <tr>
                <th>Vaid To*</th>
                <td>:</td>
                <td><?php echo $student_info['valid_to']?></td>
            </tr>
        </table>
        <br><br>
        <h3 style="text-align: center;">Student Information</h3>
         <br>
        <div class="row ">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Student Name <span
                        class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['student_name']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -340px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Mobile Number <span
                        class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['student_mobile']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -300px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Gender<span class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['gender']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -260px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Room No</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['room_no']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -220px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Cabin No</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['cabin_no']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -180px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Student Email Id<span
                        class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['student_email']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -140px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Father's/Husband Name</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['father_name']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -100px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Occupation(Guardian)</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['occupation']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -60px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Contact No.(Residence)</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['res_contact_no']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm" style="margin-top: -20px">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Contact No.(Guardian)</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['guardian_contact_no']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Address State</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['state']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Permanent address</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['permanent_address']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">College of MBBS State<span
                        class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['state']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">College of MBBS<span
                        class="red bigger-120">*</span></label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['college_name']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">MBBS Batch</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['mbbs_batch']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Internship College/Hospital </label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['internship_college']?></span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Internship Start Date </label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['internship_join_date']?> </span>
            </div>
        </div>
        <div class="row form-group frm-btm">
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5">
                <label class="input-text" style="font-weight: bold;">Presently Working</label>
            </div>
            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1 input-text"> : </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 word-brk" style="margin-top: 10px">
                <span><?php echo $student_info['presently_working']?> </span>
            </div>
        </div>
    </div>

   
</body>

<script type="text/javascript">
    
    function getinfo(id){
        //alert(id);
        $("#stu_info").show();

    }
</script>