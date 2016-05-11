jQuery(function(){
    $('.user').click(function(){
        var info=$(this).data('data');
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


        $('#delete-user').attr('data-id', info.id);
        $('#update-user').attr('data-id', info.id);
    });

    //delete user
    $('#delete-user').click(function(){
       var id=$(this).attr('data-id');

        console.log('deleting user '+id);

        $.post('/schedule/delete_user.php',{id: id}, function(){
           console.log('user deleted');
            $('#user_'+id).remove();
        });
    });


    //update user info
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
            }, function(){
            console.log('user updated');
                $('#user_'+id+' h1').html($('#first-name').val()+' '+$('#last-name').val());
        });
    });

});