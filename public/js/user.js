/**
 * To go back post create view with form data
 * 
 * @return  
 */
 function backRegisterProcess() {
    $("#userRegisterForm").attr('action', "/user/create").submit();
}

/**
 * To clear form data
 * 
 * @return  
 */
 function clearCreateFormData() {
    $('#name').val('');
    $('#email').val('');
    $('#type').val('1');
    $('#phone').val('');
    $('#dob').val('');
    $('#address').val('');
    $('#profile').val('');
}

/**
 * To clear form data
 * 
 * @return  
 */
 function clearEditFormData() {
    $('#name').val('');
    $('#email').val('');
    $('#password').val('');
    $('#confirmPwd').val('');
    $('#type').val('1');
    $('#phone').val('');
    $('#dob').val('');
    $('#address').val('');
    $('#profile').val('');
}

var userTable;
/**
 * To use dataTable library and hide default search filter
 * 
 * @return  
 */
$(function() { 
    if ($('#userTable').length) {
        userTable = $('#userTable').DataTable( {
            "scrollX": true,
        } );
        $('#userTable_filter').css('visibility', 'hidden');
    }
});

/**
 * To search users
 * 
 * @return  
 */
 function searchUsers() {
    let searchNameValue = $('#searchName').val();
    let searchEmailValue = $('#searchEmail').val();
    let fromDateValue = $('#fromDate').val();
    let toDateValue = $('#toDate').val();

    if( fromDateValue != "" || toDateValue != "" ) {
        $.fn.dataTable.ext.search.pop();
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                let min = moment($('#fromDate').val(),"YYYY/MM/D").format("YYYY/MM/D");
                let max = moment($('#toDate').val(),"YYYY/MM/D").format("YYYY/MM/D");
                let date = moment(new Date( data[8] ),"YYYY/MM/D").format("YYYY/MM/D");
                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );
    }
    else {
        $.fn.dataTable.ext.search.pop();
    }

    if( searchNameValue != null && searchEmailValue != null) {
        userTable.column(1).search(searchNameValue).column(2).search(searchEmailValue).draw();
    }
    else if( searchNameValue != null ) {
        userTable.columns(1).search(searchNameValue).draw();
    }
    else if( searchEmailValue != null ) {
        userTable.columns(2).search(searchEmailValue).draw();
    } else {
        userTable.draw();
    }
}

/**
 * To add user data to user detail modal
 * 
 * @param id user id
 * @return  
 */
 function showUserDetail(id) {
    $.ajax({
        url: "/api/user/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let profile = "/images/profile/" + data.user.profile;
            let type = (data.user.type == 0) ? 'Admin' : 'User';
            let dob = moment(data.user.dob, "YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");
            let created_at = moment(data.user.created_at, "YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");
            let updated_at = moment(data.user.updated_at, "YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");            
            let created_user, updated_user;
            data.users.forEach((user) => {
                if(user.id == data.user.created_user_id) {
                    created_user = user.name;
                }
                if(user.id == data.user.updated_user_id) {
                    updated_user = user.name;
                }
            });
            $("#userDetailModal #user-profile").attr("src", profile);
            $("#userDetailModal #user-name").html(data.user.name);
            $("#userDetailModal #user-type").html(type);
            $("#userDetailModal #user-email").html(data.user.email);
            $("#userDetailModal #user-phone").html(data.user.phone);
            $("#userDetailModal #user-dob").html(dob);
            $("#userDetailModal #user-addr").html(data.user.address);
            $("#userDetailModal #created-date").html(created_at);
            $("#userDetailModal #created-user").html(created_user);
            $("#userDetailModal #updated-date").html(updated_at);
            $("#userDetailModal #updated-user").html(updated_user);
        }
    });
}

/**
 * To add user data to post delete Confirm modal
 * @param id user id
 * @return  
 */
 function showDeleteConfirmModal(id) {
    $.ajax({
        url: "/api/user/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let type = (data.user.type == 0) ? 'Admin' : 'User';
            let dob = moment(data.user.dob, "YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");
            $("#userDeleteConfirmModal #user-id").html(data.user.id);
            $("#userDeleteConfirmModal #user-name").html(data.user.name);
            $("#userDeleteConfirmModal #user-type").html(type);
            $("#userDeleteConfirmModal #user-email").html(data.user.email);
            $("#userDeleteConfirmModal #user-phone").html(data.user.phone);
            $("#userDeleteConfirmModal #user-dob").html(dob);
            $("#userDeleteConfirmModal #user-addr").html(data.user.address);
            $("#userDeleteConfirmModal #deleteBtn").attr("href","/user/delete/" + data.user.id);
        }
    });
}
