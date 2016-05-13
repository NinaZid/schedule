jQuery(function(){
    $(".glyphicon-eye-open").show();

    // Show/Hide password on holding mouse down
    $(".glyphicon-eye-open").mousedown(function(){
        $("#password").attr('type','text');
    }).mouseup(function(){
        $("#password").attr('type','password');
    }).mouseout(function(){
        $("#password").attr('type','password');
    });

    // Update user info in Admin.html
    $('.user').click(function(){
        var info=JSON.parse($(this).attr('data-data'));
        console.log(info);
        $('#first-name').val(info.first_name);
        $('#last-name').val(info.last_name);
        $('#username').val(info.username);
        $('#password').val(info.password);
        if (info.role_id==1){
            $('#role option[value=1]').attr('selected', 'selected');
            $('#role option[value=2]').removeAttr('selected');
        }else {
            $('#role option[value=2]').attr('selected', 'selected');
            $('#role option[value=1]').removeAttr('selected');
        }

        $('#view-user-tasks').attr('data-id', info.id);
        $('#delete-user').attr('data-id', info.id);
        $('#update-user').attr('data-id', info.id);
    });


    // Update user info in Calendar.html
    $('#update-user-info').click(function(){
        $.post('/schedule/update_user_info.php',
            {
                first_Name: $('#first-name').val(),
                last_Name: $('#last-name').val(),
                password: $('#password'). val(),
            }, function(data){
                console.log('user updated');
                //update on menu
                $('#user-menu').html($('#first-name').val()+' '+$('#last-name').val());
            });
    });


    // Delete user
    $('#delete-user').click(function(){
       var id=$(this).attr('data-id');

        console.log('deleting user '+id);

        $.post('/schedule/delete_user.php',{id: id}, function(){
           console.log('user deleted');
            $('#user_'+id).remove();
        });
    });


    // Update user info in admin.html
    $('#update-user').click(function(){
        var id=$(this).attr('data-id');

        $.post('/schedule/update_user.php',
            {
                id: id,
                first_Name: $('#first-name').val(),
                last_Name: $('#last-name').val(),
                username: $('#username').val(),
                password: $('#password'). val(),
                role_id: $('#role').val()
            }, function(data){
            console.log('user updated');

                if ($('#role').val()==1) {
                    $('#user_' + id + ' h1').html($('#first-name').val() + ' ' + $('#last-name').val() + ' ' + '<img src="img/star.png" alt="Admin Icon" id="admin-icon">');
                } else{
                    $('#user_'+id+' h1').html($('#first-name').val()+' '+$('#last-name').val());
                }
                $('#user_'+id).attr('data-data', data);
        });
    });

   //  View user tasks by admin
    $('#view-user-tasks').click(function(data){
        var id=$(this).attr('data-id');
        window.location="/schedule/user.html?user="+id;
    });

     $('body').on('click','.task', function() {
         var id=$(this).attr('data-id');

         $.get('/schedule/get_task.php?id='+id, function(data){

         });
     });

});