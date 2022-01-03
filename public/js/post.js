/**
 * To go back post create view with form data
 * 
 * @return  
 */
 function backCreateProcess() {
    $("#postCreateForm").attr('action', "/post/create").submit();
}

/**
 * To clear form data
 * 
 * @return  
 */
 function clearFormData() {
    $('#title').val('');  
    $('#description').val(''); 
}

/**
 * To clear file
 * 
 * @return  
 */
 function clearFile() {
    $('#postFile').val(''); 
}

var postTable;
/**
 * To use dataTable library, limit searchable column, hide default search box
 * 
 * @return  
 */
$(function() {
    if ($('#postTable').length) {
        let targetArray = [];
        colCount = $("#postTable thead tr th").length;
        for (let i = 2; i < colCount; i++) {
            targetArray.push(i);
        }
        postTable = $('#postTable').DataTable({
            "order": [],
            'columnDefs'        : [
            { 
                'searchable'    : false, 
                'targets'       : targetArray 
            },
        ]});
        $('#postTable_filter').css('visibility', 'hidden');
    }
});

/**
 * To search posts
 * 
 * @return  
 */
function searchPosts() {
     let searchValue = $('#search').val();
     postTable.search(searchValue).draw();
}

/**
 * To add post data to post detail modal
 * 
 * @param id post id
 * @return  
 */
function showPostDetail(id) {
    $.ajax({
        url: "/api/post/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let status = (data.post.status == 0) ? "Inactive" : "Active";
            let created_at = moment(data.post.created_at,"YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");
            let updated_at = moment(data.post.updated_at,"YYYY-MM-DD HH:mm:ss").format("YYYY/M/D");
            let created_user, updated_user;
            data.users.forEach((user) => {
                if(user.id == data.post.created_user_id) {
                    created_user = user.name;
                }
                if(user.id == data.post.updated_user_id) {
                    updated_user = user.name;
                }
            });
            $("#postDetailModal #post-title").html(data.post.title);
            $("#postDetailModal #post-description").html(data.post.description);
            $("#postDetailModal #post-status").html(status);
            $("#postDetailModal #created-date").html(created_at);
            $("#postDetailModal #created-user").html(created_user);
            $("#postDetailModal #updated-date").html(updated_at);
            $("#postDetailModal #updated-user").html(updated_user);
        }
    });
}

/**
 * To add post data to post delete Confirm modal
 * 
 * @param id post id
 * @return  
 */
function showDeleteConfirmModal(id) {
    $.ajax({
        url: "/api/post/" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let status = (data.post.status == 0) ? "Inactive" : "Active";
            $("#postDeleteConfirmModal #post-id").html(data.post.id);
            $("#postDeleteConfirmModal #post-title").html(data.post.title);
            $("#postDeleteConfirmModal #post-description").html(data.post.description);
            $("#postDeleteConfirmModal #post-status").html(status);
            $("#postDeleteConfirmModal #deleteBtn").attr("href","/post/delete/" + data.post.id);
        }
    });
}