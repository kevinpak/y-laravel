
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // base url
    var baseUrl = `${window.location.protocol}//${window.location.host}`

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    var filedropper = $("#upload").dropify();


    //popup
    $(function () {
		  $('[data-toggle="popover"]').popover()
		})


     // if error exist afert submit
     function reshowModal (){
         let errorStatus = $('#employeeForm').data("error")
         if(errorStatus){
            $('#ajax-employee-modal').modal('show');
        }
     }

    reshowModal()

    // datatable on employee list
    $('#list-employer').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: baseUrl +"/employees",
                type: 'POST',
            },
            "columns": [
                    { data: "image", name:"image"},
                    { data: 'name',  name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: "job", name:"job"},
                    { data: "sex", name:"sex"},
                    { data: 'address', name: 'address'},
                    { data: 'action', name: 'action', orderable: false},
            ]

    });


    $('#list-category').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
            url: baseUrl +"/category",
            type: 'POST',
        },
        "columns": [
                { data: "id", name:"id"},
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description'},
                { data: 'action', name: 'action', orderable: false},
        ]
    });
    /*  When user click add user button */
        $('#create-new-emmployee').click(function () {
            $('#empoyeeId').val('');
            $('#employeeForm').trigger("reset");
            $('#employeeCrudTitle').html("Add new employee");
            $('#ajax-employee-modal').modal('show');
        });

    // when user click on update bottom
        $("body").on("click",'a[class*="updateEmployee"]',function(){
            $('#employeeForm').trigger("reset");
            $('#employeeCrudTitle').html("Update employee");
            $('#ajax-employee-modal').modal('show');

            // set employee data in form
            let fisrtName =  $(this).data("firstname");
            let lastName =  $(this).data("lastname");
            let email =  $(this).data("email");
            let address =  $(this).data("address");
            let phone =  $(this).data("phone");
            let sex =  $(this).data("sex");
            let category =  $(this).data("category");
            let birthDay =  $(this).data("birthdate");
            let id =  $(this).data("id");
            let salary =  $(this).data("salary");
            let image = $(this).data("image");

            $("#employeeForm").find("input[name='firstName']").val(fisrtName)
            $("#employeeForm").find("input[name='lastName']").val(lastName);
            $("#employeeForm").find("input[name='email']").val(email);
            $("#employeeForm").find("input[name='phone']").val(phone);
            $("#employeeForm").find("select[name='sex']").val(sex);
            $("#employeeForm").find("input[name='salary']").val(salary);
            $("#employeeForm").find("input[name='address']").val(address);
            $("#employeeForm").find("input[name='birthDate']").val(birthDay);
            $("#employeeForm").find("input[name='employeeId']").val(id);
            $("#employeeForm").find("select[name='employee_categorie_id']")
                              .find(`option[value=${category}]`)
                              .attr('selected', true);


            // change action attribute
            $('#employeeForm').attr("action", baseUrl+"/employee/update/"+id)
        });



    // when user click on add category
        $('#new-category').click(function(){
            $('#employeeForm').trigger("reset");
            $("#ajax-category-modal").modal("show");
            $("#categoryCrudTitle").html("Add new category");
        })

    //when user click on update bottom
        $("body").on('click', 'a[class*="update-new-category"]', function(){
            $('#categoryForm').trigger("reset");
            let name = $(this).data("name")
            let desc = $(this).data("desc")

            $('input[name="name"]').val(name)
            $("textarea").val(desc)
            $('#categoryCrudTitle').html("Update category");
            $('#ajax-category-modal').modal('show');
        })


    //front end validate by js
        $('#employeeForm, #categoryForm').validate({
            rules: {

            },
            submitHandler: function(form) {
                form.submit();
              }
        })


    //delete employee
        $('body').on('click', '#delete-employee', function () {

            let empoyee_id = $(this).data("id");

            if(confirm("Are You sure want to delete !")){
            $.ajax({
                type: "delete",
                url: baseUrl + "/employee/"+empoyee_id,
                success: function (data) {
                showNofication()
                let oTable = $('#list-employer').dataTable();
                oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            }
        });


    //delete category
    $('body').on('click', '.delete-category', function () {

        let category_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
        $.ajax({
            type: "delete",
            url: baseUrl + "/category/"+category_id,
            success: function (data) {
                showNofication()
            let oTable = $('#list-category').dataTable();
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        }
    });
     //function execute after employer is delete in table and db
     function showNofication () {
        let notification = "<div class='notifcation success alert alert-success'>Employee is delete successfuly<div>"
        $(".wrapper").append(notification)
        setTimeout(function(){
            $(".notifcation").fadeOut(500, function(){
                $(this).remove()
            })
        },5000)
    }




});
